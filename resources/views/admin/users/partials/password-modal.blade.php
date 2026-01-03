    <div x-show="showPasswordModal" x-cloak x-transition.opacity
      class="fixed inset-0 backdrop-blur-sm bg-black/40 flex items-center justify-center z-50">
      <div x-transition.scale
        class="bg-white dark:bg-gray-800 p-6 w-80 rounded-xl shadow-2xl border border-white/20
               dark:border-gray-700/40 relative min-w-lg">
        <!-- Header -->
        <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200 flex items-center gap-2">
          <i class="fa-solid fa-key text-amber-500"></i>
          Reset Password: <span x-text="user.name"></span>
        </h2>
        <!-- Form -->
        <form :action="'/admin/users/password/' + user.id" method="POST">
          @csrf
          @method('PUT')
          <!-- Input -->
          <div class="relative mb-5">
            <input type="text" name="password"
              class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600
                           rounded-lg bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white
                           shadow-inner focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                           transition-all duration-200"
              placeholder="Enter new password">

            <i class="fa-solid fa-lock absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
          </div>
          <!-- Buttons -->
          <div class="flex justify-end gap-2">
            <button @click.prevent="closeModals()" type="button"
              class="px-3 py-2 text-sm font-medium rounded-lg
                           bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300
                           hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-200
                           flex items-center gap-2">
              <i class="fa-solid fa-xmark"></i> Close
            </button>
            <button type="submit"
              class="px-4 py-2 text-sm font-semibold text-white rounded-lg
                           bg-gradient-to-r from-green-500 to-emerald-600
                           hover:from-green-600 hover:to-emerald-700
                           shadow-lg shadow-green-500/30
                           transition-all duration-200 flex items-center gap-2">
              <i class="fa-solid fa-check-circle"></i> Update
            </button>
          </div>
        </form>
      </div>
    </div>
