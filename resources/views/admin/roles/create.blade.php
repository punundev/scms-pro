@extends('layouts.admin')
@section('title', 'Create Role')
@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <h2 class="text-2xl font-bold mb-2 text-gray-800 dark:text-gray-200">Create New Role</h2>

    <form action="{{ route('admin.roles.store') }}" method="POST" class="bg-white dark:bg-gray-800 rounded-lg">
      @csrf

      <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
          Role Name <span class="text-red-500">*</span>
        </label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white border-slate-300 dark:border-slate-500"
          placeholder="Enter role name (e.g., administrator, teacher, student)" required maxlength="255">
        @error('name')
          <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-4 p-3 border rounded-md border-gray-300 dark:border-gray-700 bg-violet-50 dark:bg-slate-800/50">

        <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-3">
          Assign Permissions
        </h3>

        <div class="flex items-center gap-2 mb-4">
          <div class="relative w-full sm:max-w-xs">
            <input type="search" id="searchInput" placeholder="Search permissions..."
              class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5
                focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100">
            <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
          </div>
          <button id="resetSearch" type="button"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors"
            title="Reset Search">
            <svg class="h-5 w-5 text-indigo-600 dark:text-gray-300" fill="none" stroke="currentColor"
              viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356-2A8.98 8.98 0 0020 12a9 9 0 11-8-9.98l-7.9 7.9M2 12h2"></path>
            </svg>
          </button>
        </div>

        {{-- *** START: Check All Option *** --}}
        <div
          class="flex items-center space-x-2 mb-3 p-2 bg-indigo-100 dark:bg-indigo-900/50 rounded-md border border-indigo-300 dark:border-indigo-700">
          <input id="checkAllPermissions" type="checkbox"
            class="appearance-none size-4
                        border-2 border-gray-300 dark:border-gray-600 rounded-sm cursor-pointer transition-all duration-200 ease-in-out relative
                        checked:bg-indigo-600 dark:checked:bg-indigo-500 checked:border-indigo-600 dark:checked:border-indigo-500
                        hover:border-indigo-400 dark:hover:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-700
                        focus:ring-offset-2 focus:outline-none before:content-[''] before:absolute before:inset-0 before:bg-no-repeat before:bg-center
                        before:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwb2x5bGluZSBwb2ludHM9IjIwIDYgOSAxNyA0IDEyIj48L3BvbHlsaW5lPjwvc3ZnPg==')]
                        before:opacity-0 before:transition-opacity before:duration-200 checked:before:opacity-100">
          <label for="checkAllPermissions" class="text-sm font-bold text-indigo-700 dark:text-indigo-200 cursor-pointer">
            Check All / Uncheck All Visible Permissions
          </label>
        </div>
        {{-- *** END: Check All Option *** --}}

        @php
          function humanizePermission(string $str): string
          {
              $str = str_replace(['_', '-'], ' ', $str);
              return ucwords($str);
          }

        @endphp

        <div id="permissionsGrid"
          class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2">
          @foreach ($permissions as $permission)
            <div class="flex items-center space-x-2 permission-item">
              <input id="permission-{{ $permission->id }}-create" name="permissions[]" type="checkbox"
                value="{{ $permission->id }}"
                class="permission-checkbox appearance-none size-4
                                border-2 border-gray-300 dark:border-gray-600 rounded-sm cursor-pointer transition-all duration-200 ease-in-out relative
                                checked:bg-indigo-500 dark:checked:bg-indigo-600 checked:border-indigo-500 dark:checked:border-indigo-600
                                hover:border-indigo-400 dark:hover:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-700
                                focus:ring-offset-2 focus:outline-none before:content-[''] before:absolute before:inset-0 before:bg-no-repeat before:bg-center
                                before:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwb2x5bGluZSBwb2ludHM9IjIwIDYgOSAxNyA0IDEyIj48L3BvbHlsaW5lPjwvc3ZnPg==')]
                                before:opacity-0 before:transition-opacity before:duration-200 checked:before:opacity-100"
                {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
              <label for="permission-{{ $permission->id }}-create"
                class="text-sm font-medium text-gray-900 dark:text-gray-300 capitalize permission-label cursor-pointer">
                {{ humanizePermission($permission->name) }}
              </label>
            </div>
          @endforeach
        </div>
        @error('permissions')
          <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.roles.index') }}"
          class="px-4 py-2 cursor-pointer border border-red-500 hover:text-white hover:bg-red-600 text-red-500 rounded-md flex items-center gap-2 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
          Cancel
        </a>
        <button type="submit"
          class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
              clip-rule="evenodd" />
          </svg>
          Create Role
        </button>
      </div>
    </form>

  </div>

@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      let $searchInput = $('#searchInput');
      let $resetBtn = $('#resetSearch');
      let $allCheckboxes = $('.permission-checkbox');
      let $permissionItems = $('.permission-item');
      let $checkAll = $('#checkAllPermissions');

      function updateCheckAll() {
        let visibleBoxes = $allCheckboxes.filter(':visible');
        let checkedVisible = visibleBoxes.filter(':checked');
        $checkAll.prop('checked', visibleBoxes.length > 0 && visibleBoxes.length === checkedVisible.length);
      }

      $checkAll.on('change', function() {
        $allCheckboxes.filter(':visible').prop('checked', $(this).prop('checked'));
      });

      $allCheckboxes.on('change', updateCheckAll);

      $searchInput.on('keyup', function() {
        let keyword = $(this).val().toLowerCase();
        $permissionItems.each(function() {
          let text = $(this).find('.permission-label').text().toLowerCase();
          $(this).toggle(text.includes(keyword));
        });
        updateCheckAll();
      });

      $resetBtn.on('click', function() {
        $searchInput.val('');
        $permissionItems.show();
        updateCheckAll();
      });

      updateCheckAll();
    });
  </script>
@endpush
