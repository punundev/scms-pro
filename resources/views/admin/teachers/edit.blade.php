@extends('layouts.admin')
@section('title', 'Edit Teacher: ' . $teacher->name)
@section('content')

  <div class="mb-10">
    {{-- Page Header --}}
    <div class="flex items-center justify-between px-3 md:px-0 mb-6">
      <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
        <div
          class="size-10 p-2 flex justify-center items-center rounded-full bg-indigo-50 text-indigo-600 border border-indigo-300 dark:border-indigo-800 dark:text-indigo-50 dark:bg-slate-800">
          <i class="ri-teacher-line text-2xl"></i>
        </div>
        Edit Teacher: {{ $teacher->name }}
      </h3>
      <a href="{{ route('admin.teachers.index') }}"
        class="group relative inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out overflow-hidden">
        <span
          class="absolute inset-0 bg-gradient-to-r from-purple-600 to-indigo-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
        <span class="relative flex items-center">
          <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
          </svg>
          Back to Teachers List
        </span>
      </a>
    </div>

    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
      </div>
    @endif

    <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST"
      class="bg-white dark:bg-gray-800 shadow-xl rounded-lg p-6" enctype="multipart/form-data" novalidate>
      @csrf
      @method('PUT')

      <div class="space-y-6">

        {{-- Avatar Upload Area --}}
        <div class="relative h-28 flex items-end justify-center bg-gray-50 dark:bg-gray-700 rounded-t-lg">
          @php
            $avatarUrl = $teacher->avatar ? asset($teacher->avatar) : null;
          @endphp
          <x-photos.upload2 name="avatar" size="xl" :current-image-url="$avatarUrl" :clear-input-name="'clear_avatar'" />
        </div>

        {{-- Section 1: Basic Information --}}
        <div class="pt-5 pb-4 border-b border-slate-300 dark:border-slate-700">
          <h3 class="text-lg font-semibold text-indigo-700 dark:text-indigo-400 mb-4">👤 Personal Information</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-6">

            {{-- Name --}}
            <div class="mb-2">
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name
                <span class="text-red-500">*</span></label>
              <input type="text" id="name" name="name" value="{{ old('name', $teacher->name) }}" required
                class="form-control w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300">
              @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            {{-- Email --}}
            <div class="mb-2">
              <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address
                <span class="text-red-500">*</span></label>
              <input type="email" id="email" name="email" value="{{ old('email', $teacher->email) }}" required
                class="form-control w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300">
              @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            {{-- Phone --}}
            <div class="mb-2">
              <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone
                Number</label>
              <input type="tel" id="phone" name="phone" value="{{ old('phone', $teacher->phone) }}"
                class="form-control w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300">
            </div>

            {{-- Gender --}}
            <div class="mb-2">
              <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gender</label>
              <select id="gender" name="gender"
                class="form-control w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white border-slate-300">
                <option value="">Select Gender</option>
                @foreach (['male' => 'Male', 'female' => 'Female'] as $key => $label)
                  <option value="{{ $key }}" @selected(old('gender', strtolower($teacher->gender)) == $key)>{{ $label }}</option>
                @endforeach
              </select>
            </div>

            {{-- Date of Birth --}}
            <div class="mb-2">
              <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date of
                Birth</label>
              <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                  <i class="ri-calendar-line text-gray-400"></i>
                </div>
                <input type="text" id="date_of_birth" name="date_of_birth" datepicker datepicker-format="yyyy-mm-dd"
                  value="{{ old('date_of_birth', $teacher->date_of_birth) }}"
                  class="block w-full ps-10 pe-3 py-2 border border-slate-300 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-indigo-500">
              </div>
            </div>

            {{-- Nationality --}}
            <div class="mb-2">
              <label for="nationality"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nationality</label>
              <input type="text" id="nationality" name="nationality"
                value="{{ old('nationality', $teacher->nationality) }}"
                class="form-control w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white border-slate-300">
            </div>
          </div>
        </div>

        {{-- Section 2: Professional Information --}}
        <div class="pb-4 border-b border-slate-300 dark:border-slate-700">
          <h3 class="text-lg font-semibold text-indigo-700 dark:text-indigo-400 mb-4">🎓 Professional Details</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-6">

            {{-- Specialization --}}
            <div class="mb-2">
              <label for="specialization"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Specialization</label>
              <input type="text" id="specialization" name="specialization"
                value="{{ old('specialization', $teacher->specialization) }}" placeholder="e.g. Mathematics, English"
                class="form-control w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white border-slate-300">
            </div>

            {{-- Qualification --}}
            <div class="mb-2">
              <label for="qualification"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Qualification</label>
              <input type="text" id="qualification" name="qualification"
                value="{{ old('qualification', $teacher->qualification) }}" placeholder="e.g. Masters in Education"
                class="form-control w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white border-slate-300">
            </div>

            {{-- Salary --}}
            <div class="mb-2">
              <label for="salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Monthly
                Salary ($)</label>
              <input type="number" step="0.01" id="salary" name="salary"
                value="{{ old('salary', $teacher->salary) }}"
                class="form-control w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white border-slate-300">
            </div>

            {{-- Joining Date --}}
            <div class="mb-2">
              <label for="joining_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Joining
                Date</label>
              <input type="text" id="joining_date" name="joining_date" datepicker datepicker-format="yyyy-mm-dd"
                value="{{ old('joining_date', $teacher->joining_date) }}"
                class="form-control w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white border-slate-300">
            </div>

            {{-- Experience --}}
            <div class="mb-2">
              <label for="experience" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Experience
                (Years)</label>
              <input type="text" id="experience" name="experience"
                value="{{ old('experience', $teacher->experience) }}"
                class="form-control w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white border-slate-300">
            </div>

            {{-- CV Upload --}}
            <div class="mb-2">
              <label for="cv" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Update CV
                (PDF/DOC)</label>
              <input type="file" id="cv" name="cv"
                class="form-control w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
              @if ($teacher->cv)
                <p class="mt-1 text-xs text-gray-500">Current file: <a href="{{ asset($teacher->cv) }}"
                    target="_blank" class="text-indigo-600 underline">View CV</a></p>
              @endif
            </div>
          </div>
        </div>

        {{-- Section 3: Password --}}
        <div class="pb-4 border-b border-slate-300 dark:border-slate-700">
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">🔒 Change Password</h3>
          <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Leave empty to keep current password.</p>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
            <div class="mb-2">
              <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">New
                Password</label>
              <input type="password" id="password" name="password"
                class="form-control w-full px-3 py-2 border rounded-lg dark:bg-gray-700 border-slate-300">
            </div>
            <div class="mb-2">
              <label for="password_confirmation"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirm Password</label>
              <input type="password" id="password_confirmation" name="password_confirmation"
                class="form-control w-full px-3 py-2 border rounded-lg dark:bg-gray-700 border-slate-300">
            </div>
          </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex justify-end space-x-3 pt-6 border-t border-slate-300 dark:border-slate-700">
          <a href="{{ route('admin.teachers.index') }}"
            class="px-6 py-3 text-sm font-semibold text-gray-700 bg-gray-200 rounded-xl hover:bg-gray-300 transition-colors">
            Cancel
          </a>
          <button type="submit"
            class="group relative inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-700 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden">
            <span
              class="absolute inset-0 bg-gradient-to-r from-purple-700 to-indigo-800 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            <span class="relative flex items-center">
              <i class="ri-save-line mr-2"></i> Update Teacher Profile
            </span>
          </button>
        </div>
      </div>
    </form>
  </div>
@endsection
