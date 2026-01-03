@extends('layouts.admin')

@section('title', 'Users List')

@section('content')

  <div x-data="userModals()"
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">

    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <i class="fa-solid fa-users me-2"></i>
      Users List
    </h3>

    {{-- Session Messages --}}
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

    {{-- Search/Create Form --}}
    <form action="{{ route('admin.users.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">

        <a href="{{ route('admin.users.create') }}"
          class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2 justify-center">
          <i class="fa-solid fa-plus me-2"></i>
          Create New User
        </a>

        <div class="flex items-center mt-3 md:mt-0 gap-2 min-w-2/3">
          <div class="relative w-full">
            <input type="search" name="search" id="searchInput" placeholder="Search users by name, email, or phone..."
              class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5
                focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100"
              value="{{ request('search') }}">
            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
          </div>

          <button type="submit"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-600 dark:bg-indigo-700 hover:bg-indigo-700 dark:hover:bg-indigo-600 rounded-md transition-colors text-white"
            title="Search">
            <i class="fas fa-search text-white text-xs"></i>
          </button>
          <a href="{{ route('admin.users.index') }}" id="resetSearch"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors dark:text-white"
            style="margin-top: 0 !important" title="Reset Search">
            <i class="fa-solid fa-arrow-rotate-right"></i>
          </a>
        </div>
      </div>
    </form>

    <div id="CardContainer" class="my-5 grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
      <script>
        window.UsersData = @json($users->items() ?? $users);
      </script>

      @forelse ($users as $user)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border-3 border-slate-300 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col @if ($user->hasRole('admin')) dark:border-red-700 border-dashed @endif
">
          <div
            class="px-4 py-2 bg-slate-50 dark:bg-slate-700 border-b border-slate-300 dark:border-slate-600 flex items-center gap-4">
            <img src="{{ $user->avatar_url }}"
              class="w-14 h-14 rounded-full object-cover border-2 border-white shadow @if ($user->deleted_at) border-red-600 @endif">

            <div class="flex-grow">
              <h4 class="font-bold text-xl text-gray-800 dark:text-gray-200">{{ $user->name }}</h4>
              <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
            </div>
            {{-- Roles Badges --}}
            <div class="mt-2 flex flex-wrap gap-1">
              @foreach ($user->roles as $role)
                <span
                  class="px-2 py-1 text-xs font-semibold rounded-full capitalize
                      @if ($role->name === 'admin') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                      @elseif ($role->name === 'teacher') bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200
                      @elseif ($role->name === 'student') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                      @else bg-purple-100 text-purple-800 dark:bg-purple-700 dark:text-purple-300 @endif ">
                  <i class="fa-solid fa-shield-halved"></i>
                  {{ $role->name }}
                </span>
              @endforeach
            </div>
          </div>

          {{-- Card Body: Key Details --}}
          <div class="p-4 space-y-3 flex-grow">
            {{-- Contact --}}
            <x-info.item name="{{ $user->phone ?? 'N/A' }} | {{ Str::limit($user->address, 30) ?? 'No Address' }}"
              icon="fa-solid fa-phone text-xl" label="Contact" labelcolor="text-gray-500 dark:text-gray-400"
              color="" position="left" />
            {{-- Qualification (Teacher Only) --}}
            @if ($user->hasRole('teacher'))
              <x-info.item name="{{ $user->qualification ?? 'Not Specified' }} | {{ $user->specialization ?? 'N/A' }}"
                icon="fa-solid fa-graduation-cap text-xl" label="Qualification / Specialization"
                labelcolor="text-gray-500 dark:text-gray-400" color="" position="left" />
            @endif
            {{-- Admission & DOB (Student Only) --}}
            @if ($user->hasRole('student'))
              <x-info.item
                name="Admission: {{ $user->admission_date ? $user->admission_date->format('Y-m-d') : 'N/A' }} | DOB: {{ $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : 'N/A' }}"
                icon="fa-solid fa-calendar-alt text-xl" label="Admission / DOB"
                labelcolor="text-gray-500 dark:text-gray-400" color="" position="left" />
            @endif
            {{-- Joined & Gender --}}
            <x-info.item
              name="{{ $user->joining_date ? $user->joining_date->format('Y-m-d') : 'N/A' }} | {{ $user->gender ?? 'N/A' }}"
              icon="fa-solid fa-calendar-check text-xl" label="Joined / Gender"
              labelcolor="text-gray-500 dark:text-gray-400" color="" position="left" />
          </div>

          {{-- Card Footer: Actions --}}

          <div
            class="px-4 py-2 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-between">

            <div class="flex">
              {{-- Password Button: Triggers Password Modal --}}

              @if (!$user->hasRole('admin'))
                <button type="button" @click="openPasswordModal({{ $user->id }})"
                  class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors">
                  <i class="fa-solid fa-unlock-keyhole me-2"></i>
                  Password
                </button>
              @endif

              @if (!$user->hasRole('admin'))
                <button type="button" @click="openRoleModal({{ $user->id }})"
                  class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors">
                  <i class="fa-solid fa-fingerprint me-2"></i>
                  Role
                </button>
              @endif
            </div>

            <div class="flex">
              {{-- Show Button --}}
              @if (!$user->hasRole('admin'))
                <a href="{{ route('admin.users.show', $user->id) }}"
                  class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-600 transition-colors"
                  title="View User">
                  <i class="fa-regular fa-eye me-2"></i>
                  {{-- Show --}}
                </a>
              @endif

              @if (!$user->hasRole('admin'))
                {{-- Edit Button --}}
                <a href="{{ route('admin.users.edit', $user->id) }}"
                  class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                  title="Edit User">
                  <i class="fa-solid fa-pen-to-square me-2"></i>
                  {{-- Edit --}}
                </a>
              @endif

              {{-- @if (!$user->hasRole('admin'))
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete the user \'{{ $user->name }}\'? This action cannot be undone.');">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="delete-btn px-2 py-1 rounded-full flex items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                    title="Delete User">
                    <i class="fa-regular fa-trash-can me-2"></i>
                    Delete
                  </button>
                </form>
              @endif --}}
            </div>
          </div>

        </div>
      @empty
        <div class="col-span-full py-12 text-center">
          <div
            class="max-w-md mx-auto p-6 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div class="mx-auto h-16 w-16 rounded-full bg-red-50 dark:bg-slate-700 flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-400 dark:text-red-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">No Users Found</h3>
            <p class="mt-1 text-sm text-red-500 dark:text-red-500">Create new users to manage your system.</p>
          </div>
        </div>
      @endforelse
    </div>
    {{-- END: Card View for Users --}}

    <div class="mt-6">
      {{ $users->onEachSide(2)->links('admin.components.tailwind-modern') }}
    </div>

    @include('admin.users.partials.password-modal')
    @include('admin.users.partials.role-modal')

  </div>
@endsection

@push('script')
  <script>
    document.getElementById('resetSearch').addEventListener('click', e => {
      document.getElementById('searchInput').value = '';
    });
  </script>
  <script>
    function userModals() {
      return {
        showPasswordModal: false,
        showRoleModal: false,

        user: {},
        selectedRoles: [],

        openPasswordModal(id) {
          this.user = window.UsersData.find(u => u.id === id);
          this.showPasswordModal = true;
        },

        openRoleModal(id) {
          this.user = window.UsersData.find(u => u.id === id);
          this.selectedRoles = this.user.roles.map(r => r.name);
          this.showRoleModal = true;
        },

        closeModals() {
          this.showPasswordModal = false;
          this.showRoleModal = false;
        }
      }
    }
  </script>
@endpush

@push('styles')
  <style>
    [x-cloak] {
      display: none !important;
    }
  </style>
@endpush
