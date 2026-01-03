@extends('layouts.admin')
@section('title', 'Edit User')
@section('content')

  <div>
    <div class="flex items-center justify-between mb-6 px-3 md:px-0">
      <h1 class="text-2xl font-semibold">Edit User: {{ $user->name }}</h1>
      <a href="{{ route('admin.users.index') }}"
        class="group relative inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out overflow-hidden">
        <span
          class="absolute inset-0 bg-gradient-to-r from-purple-600 to-indigo-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
        <span class="relative flex items-center">
          <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none"
            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
          </svg>
          Back to Users List
        </span>
        <span
          class="absolute top-0 left-0 w-full h-full bg-white opacity-0 group-hover:opacity-10 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></span>
      </a>
    </div>

    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
      </div>
    @endif

    @php
      // Get all available roles (Spatie Role collection)
      $allRoles = $roles;

      // Get the role names currently assigned to the user
      $userCurrentRoleNames = $user->roles->pluck('name')->toArray();

      // Determine the selected roles, prioritizing 'old' input on validation failure
      // If validation fails, old('type') will be an array (or null/string if old input logic was single-role previously)
      $selectedRoles = old('type', $userCurrentRoleNames);

      // Ensure $selectedRoles is always an array for Alpine.js and in_array checks
      if (!is_array($selectedRoles)) {
          $selectedRoles = [$selectedRoles];
      }
      $initialSelectedRolesJson = json_encode($selectedRoles);

      $inputClasses =
          'form-control w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300';

      $fileClasses =
          'form-control w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-white dark:hover:file:bg-gray-600';
    @endphp

    <form id="Formedit" action="{{ route('admin.users.update', $user) }}" method="POST"
      class="bg-white dark:bg-gray-800 shadow-xl rounded-lg p-6" enctype="multipart/form-data" novalidate
      x-data="{
          // Store the role names currently selected (array of strings)
          selectedRoles: {{ $initialSelectedRolesJson }},
          avatarCleared: false,
          clearAvatar() {
              this.avatarCleared = true;
          },
          hasRole(roleName) {
              return this.selectedRoles.includes(roleName);
          },
          isEmployee() {
              return this.hasRole('teacher') || this.hasRole('admin') || this.hasRole('staff');
          },
          isStudent() {
              return this.hasRole('student');
          }
      }">
      @csrf
      @method('PUT')

      <div class="space-y-6">
        <div class="relative h-28 flex items-end justify-center bg-gray-50 dark:bg-gray-700 rounded-t-lg">
          <x-photos.upload2 name="avatar" size="xl" :current-image-url="$user->avatar ? asset($user->avatar) : null" :can-remove="true" :remove-action="'$parent.clearAvatar()'" />
        </div>

        <div class="pb-4 border-b border-slate-300 dark:border-slate-700">
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">👤 Basic Information</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-6">

            <div class="mb-2">
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Name <span class="text-red-500">*</span>
              </label>
              <input type="text" id="name" name="name" placeholder="Enter name" required
                value="{{ old('name', $user->name) }}"
                class="{{ $inputClasses }} @error('name') border-red-500 @enderror">
              @error('name')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Email <span class="text-red-500">*</span>
              </label>
              <input type="email" id="email" name="email" placeholder="Enter email" required
                value="{{ old('email', $user->email) }}"
                class="{{ $inputClasses }} @error('email') border-red-500 @enderror">
              @error('email')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Password (New)
              </label>
              <input type="password" id="password" name="password" placeholder="Leave blank to keep current"
                class="{{ $inputClasses }} @error('password') border-red-500 @enderror">
              @error('password')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Confirm Password
              </label>
              <input type="password" id="password_confirmation" name="password_confirmation"
                placeholder="Confirm new password"
                class="{{ $inputClasses }} @error('password_confirmation') border-red-500 @enderror">
              @error('password_confirmation')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            {{-- START MODIFICATION: Role Checkboxes --}}
            <div class="mb-2 col-span-1 md:col-span-2 lg:col-span-3">
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                User Role(s) <span class="text-red-500">*</span>
              </label>
              <div
                class="flex flex-wrap gap-x-6 gap-y-2 p-3 border rounded-md dark:border-gray-600 @error('type') border-red-500 @enderror @error('type.*') border-red-500 @enderror">
                @foreach ($allRoles as $role)
                  <label
                    class="flex items-center gap-3 px-4 py-2 rounded-lg border
           border-gray-300 dark:border-gray-600 cursor-pointer
           bg-white dark:bg-gray-800
           hover:border-indigo-400 dark:hover:border-indigo-500
           hover:bg-indigo-50 dark:hover:bg-gray-700 shadow-sm">
                    <input type="checkbox" name="type[]" value="{{ $role->name }}" @checked(in_array($role->name, $selectedRoles))
                      x-model="selectedRoles"
                      class="form-checkbox h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-offset-gray-800">
                    <span class="ml-2">{{ $role->name }}</span>
                  </label>
                @endforeach
              </div>
              @error('type')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
              @error('type.*')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>
            {{-- END MODIFICATION: Role Checkboxes --}}

            <div class="mb-2">
              <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Phone number
              </label>
              <input type="tel" id="phone" name="phone" placeholder="Enter phone number"
                value="{{ old('phone', $user->phone) }}"
                class="{{ $inputClasses }} @error('phone') border-red-500 @enderror">
              @error('phone')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Address
              </label>
              <input type="text" id="address" name="address" placeholder="Enter address"
                value="{{ old('address', $user->address) }}"
                class="{{ $inputClasses }} @error('address') border-red-500 @enderror">
              @error('address')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Date of Birth
              </label>
              <input type="date" id="date_of_birth" name="date_of_birth" placeholder="Enter Date of Birth"
                value="{{ old('date_of_birth', $user->date_of_birth?->toDateString()) }}"
                class="{{ $inputClasses }} @error('date_of_birth') border-red-500 @enderror">
              @error('date_of_birth')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Gender
              </label>
              <select id="gender" name="gender"
                class="form-control form-select w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                    dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                    border-slate-300 @error('gender') border-red-500 @enderror">
                @foreach (['male' => 'Male', 'female' => 'Female', 'monk' => 'Monk', 'other' => 'Other'] as $key => $label)
                  <option value="{{ $key }}" @selected(old('gender', $user->gender) == $key)>{{ $label }}
                  </option>
                @endforeach
              </select>
              @error('gender')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="nationality" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Nationality
              </label>
              <input type="text" id="nationality" name="nationality" placeholder="Enter nationality"
                value="{{ old('nationality', $user->nationality) }}"
                class="{{ $inputClasses }} @error('nationality') border-red-500 @enderror">
              @error('nationality')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="religion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Religion
              </label>
              <input type="text" id="religion" name="religion" placeholder="Enter religion"
                value="{{ old('religion', $user->religion) }}"
                class="{{ $inputClasses }} @error('religion') border-red-500 @enderror">
              @error('religion')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

          </div>
        </div>

        <div class="pb-4 border-b border-slate-300 dark:border-slate-700" x-show="isEmployee()">
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">🧑‍💼 Employment/Academic
            Details</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-6">

            <div class="mb-2">
              <label for="joining_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Joining Date
              </label>
              <input type="date" id="joining_date" name="joining_date" placeholder="Enter Joining Date"
                value="{{ old('joining_date', $user->joining_date?->toDateString()) }}"
                class="{{ $inputClasses }} @error('joining_date') border-red-500 @enderror">
              @error('joining_date')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="qualification" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Qualification
              </label>
              <input type="text" id="qualification" name="qualification" placeholder="e.g., Master of Science"
                value="{{ old('qualification', $user->qualification) }}"
                class="{{ $inputClasses }} @error('qualification') border-red-500 @enderror">
              @error('qualification')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="experience" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Experience (Years)
              </label>
              <input type="number" id="experience" name="experience" placeholder="e.g., 5" min="0"
                step="0.5" value="{{ old('experience', $user->experience) }}"
                class="{{ $inputClasses }} @error('experience') border-red-500 @enderror">
              @error('experience')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="specialization" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Specialization
              </label>
              <input type="text" id="specialization" name="specialization" placeholder="e.g., Computer Science"
                value="{{ old('specialization', $user->specialization) }}"
                class="{{ $inputClasses }} @error('specialization') border-red-500 @enderror">
              @error('specialization')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Salary
              </label>
              <input type="number" id="salary" name="salary" placeholder="Enter salary amount" min="0"
                step="0.01" value="{{ old('salary', $user->salary) }}"
                class="{{ $inputClasses }} @error('salary') border-red-500 @enderror">
              @error('salary')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="cv" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                CV/Resume
              </label>
              <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx"
                class="{{ $fileClasses }}">
              @error('cv')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

          </div>
        </div>

        <div class="pb-4" x-show="isStudent()">
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">🎓 Student Details</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-6">

            <div class="mb-2">
              <label for="admission_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Admission Date
              </label>
              <input type="date" id="admission_date" name="admission_date" placeholder="Enter Admission Date"
                value="{{ old('admission_date', $user->admission_date?->toDateString()) }}"
                class="{{ $inputClasses }} @error('admission_date') border-red-500 @enderror">
              @error('admission_date')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="occupation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Parent/Guardian Occupation
              </label>
              <input type="text" id="occupation" name="occupation" placeholder="Enter Occupation"
                value="{{ old('occupation', $user->occupation) }}"
                class="{{ $inputClasses }} @error('occupation') border-red-500 @enderror">
              @error('occupation')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Parent/Guardian Company
              </label>
              <input type="text" id="company" name="company" placeholder="Enter Company Name"
                value="{{ old('company', $user->company) }}"
                class="{{ $inputClasses }} @error('company') border-red-500 @enderror">
              @error('company')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

          </div>
        </div>
      </div>

      <div class="mb-8 sm:mb-0 py-4 border-t flex justify-end space-x-3 border-slate-300 dark:border-slate-700">
        <a href="{{ route('admin.users.index') }}"
          class="cursor-pointer flex items-center justify-center rounded-md transition-colors px-4 py-2 border border-red-500 text-red-500 dark:text-red-600 hover:text-white hover:bg-red-600 gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
          Cancel
        </a>
        <button type="submit"
          class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">Update
          User</button>
      </div>

      <input type="hidden" name="clear_avatar" :value="avatarCleared ? 1 : 0">
    </form>
  </div>
@endsection
