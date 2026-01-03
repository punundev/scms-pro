@extends('layouts.admin')
@section('title', 'Create New Student')
@section('content')

    <div>
        {{-- Page Header --}}
        <div class="flex items-center justify-between px-3 md:px-0 mb-6">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
              <div class="size-10 p-2 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 border border-indigo-300 dark:border-indigo-800 dark:text-blue-50 dark:bg-slate-800">
                  <i class="ri-user-2-fill text-2xl"></i>
                </div>
                Create New Student
              </h3>
            <a href="{{ route('admin.students.index') }}"
                class="group relative inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out overflow-hidden">
                <span
                    class="absolute inset-0 bg-gradient-to-r from-purple-600 to-indigo-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                <span class="relative flex items-center">
                    <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform duration-300"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Students List
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

        <form action="{{ route('admin.students.store') }}" method="POST"
            class="bg-white dark:bg-gray-800 shadow-xl rounded-lg p-6" enctype="multipart/form-data" novalidate
            x-data="{}"> {{-- Alpine data is simple since we don't have conditional fields --}}
            @csrf

            <div class="space-y-6">

                {{-- Avatar Upload Area (Assuming x-photos.upload2 is a working component) --}}
                <div class="relative h-28 flex items-end justify-center bg-gray-50 dark:bg-gray-700 rounded-t-lg">
                    {{-- Note: You MUST have an x-photos.upload2 component or similar logic for this to work --}}
                    <x-photos.upload2 name="avatar" size="xl" :current-image-url="null" />
                </div>

                {{-- Basic Information Section --}}
                <div class="pt-5 pb-4 border-b border-slate-300 dark:border-slate-700">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">👤 Account & Basic Information
                    </h3>
                    <div class="grid grid-cols-1 md::grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-6">

                        {{-- Name --}}
                        <div class="mb-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" placeholder="Enter full name" required
                                value="{{ old('name') }}"
                                class="form-control w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                       dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                       border-slate-300 @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-2">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" placeholder="Enter email address" required
                                value="{{ old('email') }}"
                                class="form-control w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                       dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                       border-slate-300 @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="mb-2">
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Phone Number (Optional)
                            </label>
                            <input type="tel" id="phone" name="phone" placeholder="Enter phone number"
                                value="{{ old('phone') }}"
                                class="form-control w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                       dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                       border-slate-300 @error('phone') border-red-500 @enderror">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Gender --}}
                        <div class="mb-2">
                            <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Gender (Optional)
                            </label>
                            <select id="gender" name="gender"
                                class="form-control form-select w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                    dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                    border-slate-300 @error('gender') border-red-500 @enderror">
                                <option value="">Select Gender</option>
                                @foreach (['male' => 'Male', 'female' => 'Female', 'monk' => 'Monk', 'other' => 'Other'] as $key => $label)
                                    <option value="{{ $key }}" @selected(old('gender') == $key)>{{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('gender')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Date of Birth --}}
                        <div class="mb-2">
                            <label for="date_of_birth"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Date of Birth (Optional)
                            </label>

                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                                    </svg>
                                </div>

                                <input type="text" id="date_of_birth" name="date_of_birth" datepicker
                                    datepicker-format="yyyy-mm-dd" placeholder="Enter Date of Birth"
                                    value="{{ old('date_of_birth') }}" min="{{ now()->toDateString() }}"
                                    class="block w-full ps-9 pe-3 py-2.5
             bg-neutral-secondary-medium border border-default-medium
             text-heading text-sm rounded-base
             focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
             shadow-xs placeholder:text-body
             dark:bg-gray-700 dark:border-gray-600 dark:text-white
             @error('date_of_birth') border-red-500 @enderror">
                            </div>

                            @error('date_of_birth')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- <div class="mb-2">
              <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Date of Birth (Optional)
              </label>
              <input type="date" id="date_of_birth" name="date_of_birth" placeholder="Enter Date of Birth"
                value="{{ old('date_of_birth') }}" min="{{ now()->toDateString() }}"
                class="form-control w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                       dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                       border-slate-300 @error('date_of_birth') border-red-500 @enderror">
              @error('date_of_birth')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div> --}}

                        {{-- Admission Date --}}
                        <div class="mb-2">
                            <label for="admission_date"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Admission Date (Optional)
                            </label>

                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                                    </svg>
                                </div>

                                <input type="text" id="admission_date" name="admission_date" datepicker
                                    min="{{ now()->toDateString() }}" datepicker-format="yyyy-mm-dd"
                                    value="{{ old('admission_date') }}"
                                    class="block w-full ps-9 pe-3 py-2.5
             bg-neutral-secondary-medium border border-default-medium
             text-heading text-sm rounded-base
             focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
             shadow-xs placeholder:text-body
             dark:bg-gray-700 dark:border-gray-600 dark:text-white
             @error('admission_date') border-red-500 @enderror"
                                    placeholder="Enter Admission Date">
                            </div>

                            @error('admission_date')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- <div class="mb-2">
              <label for="admission_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Admission Date (Optional)
              </label>
              <input type="date" id="admission_date" name="admission_date" value="{{ old('admission_date') }}"
                class="form-control w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                       dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                       border-slate-300 @error('admission_date') border-red-500 @enderror">
              @error('admission_date')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div> --}}

                        {{-- Nationality --}}
                        <div class="mb-2">
                            <label for="nationality"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nationality (Optional)
                            </label>
                            <input type="text" id="nationality" name="nationality" placeholder="Enter nationality"
                                value="{{ old('nationality') }}"
                                class="form-control w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                       dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                       border-slate-300 @error('nationality') border-red-500 @enderror">
                            @error('nationality')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Religion --}}
                        <div class="mb-2">
                            <label for="religion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Religion (Optional)
                            </label>
                            <input type="text" id="religion" name="religion" placeholder="Enter religion"
                                value="{{ old('religion') }}"
                                class="form-control w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                       dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                       border-slate-300 @error('religion') border-red-500 @enderror">
                            @error('religion')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Occupation --}}
                        <div class="mb-2">
                            <label for="occupation"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Occupation (Optional)
                            </label>
                            <input type="text" id="occupation" name="occupation" placeholder="Student/Working/Other"
                                value="{{ old('occupation') }}"
                                class="form-control w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                       dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                       border-slate-300 @error('occupation') border-red-500 @enderror">
                            @error('occupation')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Company --}}
                        <div class="mb-2">
                            <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Company (if applicable)
                            </label>
                            <input type="text" id="company" name="company" placeholder="Enter company name"
                                value="{{ old('company') }}"
                                class="form-control w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                       dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                       border-slate-300 @error('company') border-red-500 @enderror">
                            @error('company')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Address (Full Width) --}}
                        <div class="mb-2 col-span-1 md:col-span-2 lg:col-span-3">
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Address (Optional)
                            </label>
                            <textarea id="address" name="address" placeholder="Enter full address" rows="2"
                                class="form-control w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                       dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                       border-slate-300 @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Note about Default Password --}}
                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Note: The password for the new student will be automatically set to <code
                            class="font-mono text-sm font-semibold text-indigo-600 dark:text-indigo-400">password</code>.
                        The student can change this after logging in.
                    </p>
                </div>

                {{-- Form Actions --}}
                <div class="flex justify-end space-x-3 pt-6 border-t border-slate-300 dark:border-slate-700">
                    <a href="{{ route('admin.students.index') }}"
                        class="px-6 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded-xl shadow-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="group relative inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-700 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out overflow-hidden">
                        <span
                            class="absolute inset-0 bg-gradient-to-r from-purple-700 to-indigo-800 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <span class="relative flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Create Student
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
