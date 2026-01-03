@extends('layouts.admin')
@section('title', 'Create Role')
@section('content')
  <div class="mb-10">
    {{-- Page Header --}}
    <div class="flex items-center justify-between px-3 md:px-0 mb-6">
      <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
        <div
          class="size-10 p-2 flex justify-center items-center rounded-full bg-indigo-50 text-indigo-600 border border-indigo-300 dark:border-indigo-800 dark:text-indigo-50 dark:bg-slate-800">
          <i class="ri-shield-flash-fill text-2xl"></i>
        </div>
        Create New Role
      </h3>
      <a href="{{ route('admin.roles.index') }}"
        class="group relative inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out overflow-hidden">
        <span
          class="absolute inset-0 bg-gradient-to-r from-purple-600 to-indigo-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
        <span class="relative flex items-center">
          <i class="ri-arrow-left-line mr-2"></i>
          Back to Roles
        </span>
      </a>
    </div>

    <form action="{{ route('admin.roles.store') }}" method="POST"
      class="bg-white dark:bg-gray-800 shadow-xl rounded-lg p-6">
      @csrf

      <div class="space-y-6">
        {{-- Role Basic Info Section --}}
        <div class="pb-4 border-b border-slate-300 dark:border-slate-700">
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">🔑 Role Identification</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Name --}}
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Role Name <span class="text-red-500">*</span>
              </label>
              <input type="text" id="name" name="name" value="{{ old('name') }}" required
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('name') border-red-500 @enderror"
                placeholder="e.g. administrator, teacher, student">
              @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            {{-- Search --}}
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search Permissions</label>
              <div class="relative">
                <input type="text" id="searchInput" placeholder="Filter permissions..."
                  class="w-full px-3 py-2 pl-10 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300">
                <i class="ri-search-line absolute left-3 top-2.5 text-gray-400"></i>
              </div>
            </div>
          </div>
        </div>

        {{-- Permissions Section --}}
        <div>
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">🛡️ Permissions Access</h3>

            {{-- Master Toggle --}}
            <label class="inline-flex items-center cursor-pointer group">
              <span class="me-3 text-sm font-medium text-gray-600 dark:text-gray-400 group-hover:text-indigo-600">Select
                All Visible</span>
              <input type="checkbox" id="checkAllPermissions" class="sr-only peer">
              <div
                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600">
              </div>
            </label>
          </div>

          <div id="permissionsGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
            @php
              function humanizePermission(string $str): string
              {
                  return ucwords(str_replace(['_', '-'], ' ', $str));
              }
            @endphp
            @foreach ($permissions as $permission)
              <div
                class="permission-item flex items-center justify-between p-3 border border-slate-200 dark:border-slate-700 rounded-xl bg-slate-50 dark:bg-slate-900/50 hover:border-indigo-300 transition-colors">
                <label for="perm-{{ $permission->id }}"
                  class="text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer permission-label truncate pr-2">
                  {{ humanizePermission($permission->name) }}
                </label>

                <label class="inline-flex items-center cursor-pointer">
                  <input id="perm-{{ $permission->id }}" name="permissions[]" type="checkbox"
                    value="{{ $permission->id }}" class="sr-only peer permission-checkbox"
                    {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                  <div
                    class="relative w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-indigo-500">
                  </div>
                </label>
              </div>
            @endforeach
          </div>
          @error('permissions')
            <p class="mt-4 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Form Actions --}}
        <div class="flex justify-end space-x-3 pt-6 border-t border-slate-300 dark:border-slate-700">
          <a href="{{ route('admin.roles.index') }}"
            class="px-6 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded-xl hover:bg-gray-300 transition-colors">
            Cancel
          </a>
          <button type="submit"
            class="group relative inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-700 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden">
            <span
              class="absolute inset-0 bg-gradient-to-r from-purple-700 to-indigo-800 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            <span class="relative flex items-center">
              <i class="ri-add-circle-line mr-2"></i> Create Role
            </span>
          </button>
        </div>
      </div>
    </form>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      const $searchInput = $('#searchInput');
      const $allCheckboxes = $('.permission-checkbox');
      const $permissionItems = $('.permission-item');
      const $checkAll = $('#checkAllPermissions');

      function updateMasterToggle() {
        const visibleTotal = $allCheckboxes.filter(':visible').length;
        const visibleChecked = $allCheckboxes.filter(':visible:checked').length;
        $checkAll.prop('checked', visibleTotal > 0 && visibleTotal === visibleChecked);
      }

      $(document).on('change', '.permission-checkbox', updateMasterToggle);

      $checkAll.on('change', function() {
        $allCheckboxes.filter(':visible').prop('checked', $(this).prop('checked'));
      });

      $searchInput.on('input', function() {
        const val = $(this).val().toLowerCase().trim();
        $permissionItems.each(function() {
          const text = $(this).find('.permission-label').text().toLowerCase();
          $(this).toggle(text.includes(val));
        });
        updateMasterToggle();
      });

      updateMasterToggle();
    });
  </script>
@endpush
