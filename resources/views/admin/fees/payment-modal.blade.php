      {{-- MODAL START --}}
      <div x-show="isOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto " aria-labelledby="modal-title"
        role="dialog" aria-modal="true">

        {{-- Backdrop --}}
        <div class="fixed inset-0 transition-opacity" style="background-color: rgba(0, 0, 0, 0.5);" @click="closeModal()">
        </div>

        <div class="flex items-center justify-center min-h-screen px-4 py-6 text-center sm:p-0 min-w-4xl">
          <div x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative inline-block align-middle bg-white dark:bg-gray-800 rounded-xl text-left shadow-2xl transform transition-all sm:my-8 sm:max-w-3xl sm:w-full">

            <form :action="actionUrl" method="POST">
              @csrf
              {{-- <input type="hidden" name="received_by" value="{{ Auth::id() }}"> --}}
              <input type="hidden" name="fee_id" :value="feeId">
              <input type="hidden" name="payment_date" :value="formData.payment_date">
              <input type="hidden" name="transaction_id" :value="formData.transaction_id">
              <input type="hidden" name="amount" :value="formData.amount">

              <template x-if="isEdit">
                @method('PUT')
              </template>

              <div class="px-6 py-4 bg-green-600 dark:bg-green-800 rounded-t-xl text-white">
                <h3 class="text-xl font-bold mb-1" id="modal-title" x-text="modalTitle"></h3>

                <div class="flex justify-between gap-4 text-sm mt-2 text-green-100 dark:text-green-300">
                  <div>
                    <p class="font-light">{{ __('message.fee_amount') }}</p>
                    <p class="font-extrabold text-5xl text-red-300"
                      x-text="'$' + parseFloat(formData.fee_amount).toFixed(2)"></p>
                  </div>
                  <div class="flex flex-col me-10">
                    <div>
                      <p class="font-light">{{ __('message.fee_due_date') }}</p>
                      <p class="font-semibold text-white" x-text="formData.payment_date_view"></p>
                    </div>
                    <div>
                      <p class="font-light">{{ __('message.fee_id') }}</p>
                      <p class="font-semibold text-white" x-text="feeId"></p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="px-6 py-6 space-y-6">

                <div class="grid grid-cols-2 gap-4">

                  <div class="p-3 bg-gray-100 dark:bg-gray-700 rounded-lg">
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">{{ __('message.transaction_id') }}</label>
                    <p class="font-mono text-gray-800 dark:text-gray-100 font-semibold text-base"
                      x-text="formData.transaction_id"></p>
                  </div>

                  <div class="p-3 bg-gray-100 dark:bg-gray-700 rounded-lg">
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">{{ __('message.payment_date') }}</label>
                    <p class="text-gray-800 dark:text-gray-100 font-semibold text-base" x-text="formData.payment_date">
                    </p>
                  </div>
                </div>

                <hr class="border-gray-200 dark:border-gray-700">

                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      {{ __('message.amount_being_registered') }}
                    </label>
                    <p class="text-xl font-bold text-green-700 dark:text-green-400 p-2.5 bg-green-50 dark:bg-gray-700/50 rounded-lg border border-green-200 dark:border-green-800"
                      x-text="'$' + parseFloat(formData.amount).toFixed(2)">
                    </p>
                  </div>

                  <div>
                    <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      {{ __('message.payment_method') }}
                    </label>
                    <select id="payment_method" name="payment_method" x-model="formData.payment_method"
                      class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg shadow-sm p-2.5 text-gray-900 dark:text-gray-100 focus:ring-green-500 focus:border-green-500 text-base transition duration-150">
                      <option value="Cash">Cash</option>
                      <option value="Bank Transfer">{{ __('message.bank_transfer') }}</option>
                      <option value="Card">Card</option>
                      <option value="Mobile Payment">{{ __('message.mobile_payment') }}</option>
                      <option value="Other">{{ __('message.other') }}</option>
                    </select>
                  </div>
                </div>

                <div>
                  <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('message.remarks') }} <span class="text-gray-500 text-xs">{{ __('message.(optional)') }}</span>
                  </label>
                  <textarea id="remarks" name="remarks" x-model="formData.remarks" rows="3"
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg shadow-sm p-2.5 text-gray-900 dark:text-gray-100 focus:ring-green-500 focus:border-green-500 text-base transition duration-150"></textarea>
                </div>
              </div>

              <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 rounded-b-xl flex justify-end gap-3">
                <button type="button" @click="closeModal()"
                  class="inline-flex justify-center rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm transition duration-150">
                  {{ __('message.cancel') }}
                </button>
                <button type="submit"
                  class="inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm transition duration-150"
                  x-text="isEdit ? 'Update Payment' : 'Save Payment'">
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      {{-- MODAL END --}}

      <script>
        document.addEventListener('alpine:init', () => {
          Alpine.data('paymentsModal', () => ({
            isOpen: false,
            isEdit: false,
            modalTitle: 'Add New Payment',
            feeId: null,
            actionUrl: '',
            paymentId: null,

            formData: {
              fee_amount: '',
              payment_date_view: '',
              amount: '',
              payment_date: new Date().toISOString().substring(0, 10),
              payment_method: 'Cash',
              transaction_id: '',
              remarks: '',
            },

            generateTransactionId() {
              const segment = () => Math.random().toString(36).substring(2, 7).toUpperCase();
              return `SCMS:G2-${segment()}-${segment()}-${segment()}-${segment()}`;
            },

            openModal(fee, feeType, student, storeRoute) {
              this.feeId = fee.id;
              this.isEdit = false;
              this.actionUrl = storeRoute;
              this.formData.fee_amount = fee.amount;
              this.formData.payment_date_view = fee.due_date;
              this.modalTitle = `${feeType.name} - Payment for - (${student.name})`;
              this.formData.amount = fee.amount;
              this.formData.transaction_id = this.generateTransactionId();
              this.formData.payment_date = new Date().toISOString().substring(0, 10);
              this.formData.payment_method = 'Cash';
              this.formData.remarks = '';
              this.isOpen = true;
            },

            closeModal() {
              this.isOpen = false;
            }
          }));
        });
      </script>
