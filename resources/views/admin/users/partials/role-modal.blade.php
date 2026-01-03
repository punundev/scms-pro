    <div x-show="showRoleModal" x-cloak x-transition.opacity
      class="fixed inset-0 flex items-center justify-center backdrop-blur-sm bg-black/10  z-50 p-4">
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-xl">
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-4 py-2 text-white rounded-[1px_12px_0px_12px]">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
              <i class="fas fa-user-tag text-white"></i>
            </div>
            <div>
              <h2 class="text-xl font-bold">Assign Roles</h2>
              <p class="text-indigo-100 text-sm font-bold" x-text="user.name"></p>
            </div>
          </div>
        </div>

        <form :action="'/admin/users/role/' + user.id + ''" method="POST" class="p-4">
          @csrf
          @method('PUT')

          <!-- Role Selection -->
          <div class="mb-6">
            <div class="mb-4 flex justify-between items-center">
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Select Role(s) <span class="text-red-500">*</span>
              </label>
              <!-- Selection Status -->
              <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500 dark:text-gray-400">
                  Selected:
                  <span x-text="selectedRoles.length" class="font-semibold text-indigo-600 dark:text-indigo-400"></span>
                  role(s)
                </span>
              </div>
            </div>

            <!-- Role Cards Grid -->
            <div class=" gap-2 grid grid-cols-1 xl:grid-cols-2 max-h-80 overflow-y-auto pr-2">
              @foreach ($roles as $role)
                <label class="block cursor-pointer group">
                  <input type="checkbox" name="role_names[]" value="{{ $role->name }}"
                    :checked="selectedRoles.includes('{{ $role->name }}')" x-model="selectedRoles"
                    class="hidden peer">

                  <!-- Role Card -->
                  <div
                    class="border-1 border-gray-200 dark:border-gray-600 rounded-lg p-2
                                    transition-all duration-200
                                    peer-checked:border-indigo-500 peer-checked:bg-indigo-200
                                    peer-checked:dark:bg-indigo-800/50 peer-checked:dark:border-indigo-500
                                    group-hover:border-gray-300 dark:group-hover:border-gray-500
                                    group-hover:shadow-md ">

                    <div class="flex items-center justify-between">
                      <div class="flex items-center gap-2">
                        <!-- Role Icon -->
                        <div
                          class="flex-shrink-0 size-8 rounded-lg
                                                bg-gradient-to-br from-indigo-100 to-purple-100
                                                dark:from-gray-700 dark:to-gray-600
                                                peer-checked:from-indigo-200 peer-checked:to-purple-200
                                                dark:peer-checked:from-indigo-900 dark:peer-checked:to-purple-900
                                                flex items-center justify-center
                                                transition-all duration-200">
                          <i
                            class="fas text-lg
                                            {{ $role->name === 'admin' ? 'fa-crown text-yellow-500' : '' }}
                                            {{ $role->name === 'teacher' ? 'fa-chalkboard-user text-blue-500' : '' }}
                                            {{ $role->name === 'student' ? 'fa-graduation-cap text-green-500' : '' }}
                                            {{ !in_array($role->name, ['admin', 'teacher', 'student']) ? 'fa-user-gear text-gray-500' : '' }}">
                          </i>
                        </div>

                        <!-- Role Info -->
                        <div>
                          <span class="font-semibold text-gray-900 dark:text-white capitalize block">
                            {{ $role->name }}
                          </span>
                          <span class="text-xs text-gray-500 dark:text-gray-400 block mt-1">
                            @if ($role->name === 'admin')
                              Full system access
                            @elseif($role->name === 'teacher')
                              Teaching access
                            @elseif($role->name === 'student')
                              Learning access
                            @else
                              Custom role permissions
                            @endif
                          </span>
                        </div>
                      </div>

                      <!-- Checkbox Indicator -->
                      <div
                        class="flex-shrink-0 w-6 h-6 border-1 border-gray-500  dark:border-gray-500 rounded
                                flex items-center justify-center transition-all duration-200"
                        :class="{
                            'bg-indigo-600 border-indigo-500 dark:border-indigo-400 dark:bg-indigo-500': selectedRoles
                                .includes('{{ $role->name }}')
                        }">
                        <i class="ri-checkbox-circle-line text-xl transition-opacity duration-200"
                          :class="{
                              'text-white': selectedRoles.includes('{{ $role->name }}'),
                              'text-transparent': !selectedRoles.includes(
                                  '{{ $role->name }}')
                          }"></i>
                      </div>
                    </div>
                  </div>
                </label>
              @endforeach
            </div>

            <span x-show="selectedRoles.length === 0" class="text-red-500 text-xs font-medium">
              <i class="fas fa-exclamation-circle mr-1"></i>
              Please select at least one role
            </span>
          </div>

          <!-- Action Buttons -->
          <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
            <button @click.prevent="closeModals()" type="button"
              class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300
                               bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600
                               rounded-lg transition-colors duration-200 flex items-center gap-2">
              <i class="fas fa-arrow-left"></i>
              Cancel
            </button>

            <button type="submit" :disabled="selectedRoles.length === 0"
              class="px-5 py-2.5 text-sm font-medium text-white
                               bg-gradient-to-r from-green-500 to-emerald-600
                               hover:from-green-600 hover:to-emerald-700 shadow-lg shadow-green-500/30
                               disabled:from-gray-400 disabled:to-gray-500 disabled:cursor-not-allowed
                               rounded-lg transition-all duration-200 flex items-center gap-2">
              <i class="fas fa-check-circle"></i>
              Update Roles
            </button>
          </div>
        </form>
      </div>
    </div>
