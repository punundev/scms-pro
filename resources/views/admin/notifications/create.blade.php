@extends('layouts.admin')
@section('title', 'Send Notification')
@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">

    <h2 class="text-2xl font-bold mb-4">Send Notification</h2>

    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
      </div>
    @endif
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
      </div>
    @endif

    <form id="notificationForm" action="{{ route('admin.notifications.send') }}" method="POST" class="space-y-3">
      @csrf

      <div id="filterForm" class="flex justify-between w-full gap-4">
        <div class="w-full min-w-80">
          <label for="roleFilter" class="font-medium text-gray-700 dark:text-gray-300">Filter by Role</label>
          <select name="role" id="roleFilter"
            onchange="location.href='{{ route('admin.notifications.create') }}?role='+this.value"
            class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white border-slate-300 dark:border-slate-500 focus:ring-indigo-500">
            <option value="">-- All --</option>
            @foreach ($roles as $r)
              <option value="{{ $r }}" {{ $selectedRole == $r ? 'selected' : '' }}>{{ ucfirst($r) }}
              </option>
            @endforeach
          </select>
        </div>

        @if ($selectedRole == 'student')
          <div class="w-full min-w-80">
            <label for="courseFilter" class="font-medium text-gray-700 dark:text-gray-300">Filter by Course
              Offering</label>
            <select name="course_offering_id" id="courseFilter"
              onchange="location.href='{{ route('admin.notifications.create') }}?role={{ $selectedRole }}&course_offering_id='+this.value"
              class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white border-slate-300 dark:border-slate-500 focus:ring-indigo-500">
              <option value="">-- All --</option>
              @foreach ($courseOfferings as $co)
                <option value="{{ $co->id }}" {{ $selectedCourseOffering == $co->id ? 'selected' : '' }}>
                  {{ $co->subject->name }}
                </option>
              @endforeach
            </select>
          </div>
        @endif
      </div>

      <div class="flex flex-col gap-4">
        <div>
          <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Title <span
              class="text-red-500">*</span></label>
          <input type="text" name="title" value="{{ old('title') }}"
            class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white border-slate-300 dark:border-slate-500 focus:ring-indigo-500"
            required>
        </div>

        <div>
          <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Message <span
              class="text-red-500">*</span></label>
          <textarea name="body" rows="5"
            class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white border-slate-300 dark:border-slate-500 focus:ring-indigo-500"
            required>{{ old('body') }}</textarea>
        </div>
      </div>

      <div class="flex items-center flex-wrap gap-3 mb-4">
        <div class="relative w-full md:w-1/2">
          <input type="search" id="searchUsers" placeholder="Search users by name or email..."
            class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100">
          <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
        </div>

        <button id="resetUserSearch"
          class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors">
          <i class="ri-reset-right-line text-indigo-600 dark:text-gray-300 text-xl"></i>
        </button>
      </div>

      {{-- Select All / Unselect All --}}
      <div class="mb-4 flex gap-4 items-center w-full">
        <input type="checkbox" id="checkAllUsers" class="sr-only peer">
        <label for="checkAllUsers"
          class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg border border-slate-200 dark:border-gray-600 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors w-full">
          <span class="font-bold">Select All / Unselect All (Visible)</span>
          <div class="relative inline-flex items-center">
            <div
              class="w-11 h-6 bg-gray-200 peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600">
            </div>
          </div>
        </label>
      </div>

      {{-- Users Grid with Toggle Cards --}}
      <div id="usersGrid"
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 lg:grid-cols-5 gap-2 max-h-96 overflow-y-auto">

        @forelse ($users as $u)
          <label for="user-{{ $u->id }}"
            class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg border border-slate-200 dark:border-gray-600 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors user-item me-2">

            <div class="flex flex-col">
              <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $u->name }}</span>
              <span class="text-xs text-gray-500 dark:text-gray-400">{{ $u->roles->pluck('name')->join(', ') }}</span>
            </div>

            <div class="relative inline-flex items-center">
              <input type="checkbox" name="user_ids[]" value="{{ $u->id }}" id="user-{{ $u->id }}"
                class="sr-only peer" {{ in_array($u->id, old('user_ids', [])) ? 'checked' : '' }}>

              <div
                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600">
              </div>
            </div>
          </label>
        @empty
          <p class="text-sm text-gray-500 dark:text-gray-400 col-span-full">No users found for the selected filter(s).</p>
        @endforelse
      </div>

      {{-- <div class="mb-4 flex gap-4">
        <input type="checkbox" id="checkAllUsers"
          class="user-checkbox appearance-none size-5 border-2 border-gray-300 dark:border-gray-600 rounded-sm
            checked:bg-indigo-600 dark:checked:bg-indigo-500 checked:border-indigo-600 dark:checked:border-indigo-500">
        <label for="checkAllUsers" class="font-bold cursor-pointer">Select All / Unselect All (Visible)</label>
      </div>

      <div id="usersGrid"
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 lg:grid-cols-5 gap-2 border p-3 rounded-md border-gray-300 dark:border-gray-700 max-h-96 overflow-y-auto h-full">

        @forelse ($users as $u)
          <label for="user-{{ $u->id }}" class="flex items-center gap-2 user-item cursor-pointer">
            <input type="checkbox" name="user_ids[]" value="{{ $u->id }}" id="user-{{ $u->id }}"
              class="user-checkbox appearance-none size-5 border-2 border-gray-300 dark:border-gray-600 rounded-sm
            checked:bg-indigo-600 dark:checked:bg-indigo-500 checked:border-indigo-600 dark:checked:border-indigo-500">
            <span class="text-sm text-gray-800 dark:text-gray-200 capitalize font-bold">
              {{ $u->name }} ({{ $u->roles->pluck('name')->join(', ') }})
            </span>
          </label>
        @empty
          <p class="text-sm text-gray-500 dark:text-gray-400 col-span-full">No users found for the selected filter(s).</p>
        @endforelse
      </div> --}}

      <div class="flex justify-end space-x-3 pt-4 border-t mt-4 border-gray-200 dark:border-gray-700">
        <a href="{{ url()->previous() }}"
          class="px-4 py-2 border border-red-500 hover:bg-red-600 hover:text-white text-red-500 rounded-md flex items-center gap-2">
          Cancel
        </a>

        <button type="submit"
          class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2">
          Send Notification
        </button>
      </div>
    </form>
  </div>

@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      var $search = $('#searchUsers');
      var $reset = $('#resetUserSearch');
      var $items = $('.user-item');
      var $checkAll = $('#checkAllUsers');

      function updateSelectAll() {
        var $visibleCheckboxes = $('.user-item:visible input[type="checkbox"]');
        $checkAll.prop('checked', $visibleCheckboxes.length && $visibleCheckboxes.length === $visibleCheckboxes
          .filter(':checked').length);
      }

      $search.on('keyup', function() {
        var keyword = $(this).val().toLowerCase().trim();
        $items.each(function() {
          $(this).toggle($(this).text().toLowerCase().includes(keyword));
        });
        updateSelectAll();
      });

      $reset.on('click', function(e) {
        e.preventDefault();
        $search.val('');
        $items.show();
        updateSelectAll();
      });

      $checkAll.on('change', function() {
        var isChecked = $(this).prop('checked');
        $('.user-item:visible input[type="checkbox"]').prop('checked', isChecked);
      });

      $('.user-item input[type="checkbox"]').on('change', function() {
        updateSelectAll();
      });

      updateSelectAll();
    });
  </script>
@endpush
