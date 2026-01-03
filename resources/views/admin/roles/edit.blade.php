@extends('layouts.admin')
@section('title', 'Edit Role')
@section('content')
  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <h2 class="text-2xl font-bold mb-2">Edit Role: {{ $role->name }}</h2>
    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" class="bg-white dark:bg-gray-800 rounded-lg">
      @csrf
      @method('PUT')
      <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
        Name <span class="text-red-500">*</span>
      </label>
      <div
        class="grid grid-cols-1 sm:grid-cols-2 gap-2 gap-x-20 border p-2 rounded-md border-gray-300 bg-violet-50 dark:bg-slate-800 dark:border-gray-700">
        <div class="">
          <input type="text" id="name" name="name" value="{{ old('name', $role->name) }}"
            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:bg-slate-700 border-slate-300 dark:border-slate-500"
            placeholder="Enter name" required maxlength="255">
          @error('name')
            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
          @enderror
        </div>
        <div class="flex items-center mt-3 md:mt-0 gap-2 min-w-2/3">
          <div class="relative w-full">
            <input type="search" id="searchInput" placeholder="Search permissions ..."
              class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5
            focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100">
            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
          </div>
          <button id="resetSearch"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors">
            <i class="ri-reset-right-line text-indigo-600 dark:text-gray-300 text-xl"></i>
          </button>
        </div>
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 my-2">
          Permissions
        </label>

        {{-- Master Checkbox for All Permissions --}}
        <div
          class="flex items-center space-x-2 mb-2 p-2 bg-indigo-50 dark:bg-indigo-900/50 rounded-md border border-indigo-200 dark:border-indigo-700">
          <input id="checkAllPermissions" type="checkbox"
            class="appearance-none size-4
                            border-2 border-gray-300 dark:border-gray-600 rounded-sm cursor-pointer transition-all duration-200 ease-in-out relative
                            checked:bg-indigo-600 dark:checked:bg-indigo-500 checked:border-indigo-600 dark:checked:border-indigo-500
                            hover:border-indigo-400 dark:hover:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-700
                            focus:ring-offset-2 focus:outline-none before:content-[''] before:absolute before:inset-0 before:bg-no-repeat before:bg-center
                            before:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwb2x5bGluZSBwb2ludHM9IjIwIDYgOSAxNyA0IDEyIj48L3BvbHlsaW5lPjwvc3ZnPg==')]
                            before:opacity-0 before:transition-opacity before:duration-200 checked:before:opacity-100">
          <label for="checkAllPermissions" class="text-sm font-bold text-indigo-700 dark:text-indigo-200 cursor-pointer">
            Check All / Uncheck All
          </label>
        </div>

        <div id="permissionsGrid"
          class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2 border p-2 rounded-md border-gray-300 dark:border-gray-700">

          @php
            $rolePermissionIds = $role->permissions->pluck('id')->toArray();

            function humanizePermission(string $str): string
            {
                $str = str_replace(['_', '-'], ' ', $str);
                return ucwords($str);
            }
          @endphp
          @foreach ($permissions as $permission)
            <div class="flex items-center space-x-2 permission-item">
              <input id="permission-{{ $permission->id }}-edit" name="permissions[]" type="checkbox"
                value="{{ $permission->id }}"
                class="permission-checkbox appearance-none size-4
                                border-2 border-gray-300 dark:border-gray-600 rounded-sm cursor-pointer transition-all duration-200 ease-in-out relative
                                checked:bg-indigo-500 dark:checked:bg-indigo-600 checked:border-indigo-500 dark:checked:border-indigo-600
                                hover:border-indigo-400 dark:hover:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-700
                                focus:ring-offset-2 focus:outline-none before:content-[''] before:absolute before:inset-0 before:bg-no-repeat before:bg-center
                                before:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwb2x5bGluZSBwb2ludHM9IjIwIDYgOSAxNyA0IDEyIj48L3BvbHlsaW5lPjwvc3ZnPg==')]
                                before:opacity-0 before:transition-opacity before:duration-200 checked:before:opacity-100"
                {{ in_array($permission->id, old('permissions', $rolePermissionIds)) ? 'checked' : '' }}>

              <label for="permission-{{ $permission->id }}-edit"
                class="text-sm font-medium text-gray-900 dark:text-gray-300 capitalize permission-label">
                {{ humanizePermission($permission->name) }}
              </label>
            </div>
          @endforeach
        </div>
        @error('permissions')
          <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.roles.index') }}"
          class="px-4 py-2 cursor-pointer border border-red-500 hover:text-white hover:bg-red-600 text-red-500 rounded-md flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
          Cancel
        </a>
        <button type="submit"
          class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
              clip-rule="evenodd" />
          </svg>
          Save Changes
        </button>
      </div>
    </form>
  </div>

@endsection
@push('scripts')
  <script>
    $(document).ready(function() {
      var $searchInput = $('#searchInput');
      var $resetBtn = $('#resetSearch');
      // Select all permission checkboxes and their containers using the new classes
      var $allPermissionCheckboxes = $('.permission-checkbox');
      var $permissionItems = $('.permission-item');
      var $checkAll = $('#checkAllPermissions');

      // --- Function to update the master Check All box state ---
      function updateCheckAllState() {
        // Only count currently visible items
        var $visibleCheckboxes = $allPermissionCheckboxes.filter(':visible');

        // If there are no visible checkboxes, the master checkbox is unchecked
        if ($visibleCheckboxes.length === 0) {
          $checkAll.prop('checked', false);
          return;
        }

        // Check if all visible checkboxes are checked
        var allVisibleChecked = $visibleCheckboxes.length === $visibleCheckboxes.filter(':checked').length;

        $checkAll.prop('checked', allVisibleChecked);
      }

      // --- Master Checkbox Logic ---
      $checkAll.on('change', function() {
        // Only affect visible permission checkboxes (respects search filter)
        var isChecked = $(this).prop('checked');
        $allPermissionCheckboxes.filter(':visible').prop('checked', isChecked);
      });

      // --- Individual Checkbox Monitoring ---
      // If any individual checkbox is unchecked, uncheck the master checkbox
      $allPermissionCheckboxes.on('change', function() {
        updateCheckAllState(); // Recalculate master checkbox state
      });

      // --- Filter Permissions while typing ---
      $searchInput.on('keyup', function() {
        var keyword = $(this).val().toLowerCase().trim();

        $permissionItems.each(function() {
          // Search against the label text
          var label = $(this).find('.permission-label').text().toLowerCase();
          if (label.includes(keyword)) {
            $(this).show();
          } else {
            $(this).hide();
          }
        });

        // After filtering, check if the "Check All" state needs updating
        updateCheckAllState();
      });

      // --- Reset Search Input ---
      $resetBtn.on('click', function(e) {
        e.preventDefault();
        $searchInput.val('');
        $permissionItems.show();
        updateCheckAllState();
      });
      updateCheckAllState();
    });
  </script>
@endpush
