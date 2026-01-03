@extends('layouts.auth')

@section('content')
  @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
      <span class="block sm:inline"> {{ $errors->first() }}</span>
    </div>
  @endif

  <div
    class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-gray-900 dark:to-gray-900 min-h-screen flex items-center justify-center p-4">

    <div
      class="max-w-[800px] w-full mx-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow-lg overflow-hidden transition-all duration-300 ease-in-out transform scale-100 opacity-100">

      <div class="grid grid-cols-1 md:grid-cols-2 bg-white dark:bg-gray-900">
        <!-- Left Column - Login Form -->
        <div class="px-8 py-6">
          <div class="flex justify-center pt-2">
            <img src="{{ asset('assets/images/cambodia.png') }}" alt="School Logo" class="h-40">
          </div>

          <div class="text-center mt-2">
            <h1
              class="text-2xl font-bold mb-2 text-indigo-800 dark:text-gray-200 filter drop-shadow-[0_0_75px_rgba(44,54,145,1)]">
              Welcome</h1>
            <p class="text-gray-600 dark:text-gray-300 text-sm">Login to your <br>School Management System</p>
          </div>

          <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4 mt-6">
            @csrf

            <div class="flex flex-col gap-5">
              <!-- Email Field -->
              <div class="flex flex-col gap-1">
                <label for="email"
                  class="font-medium dark:text-gray-300 @error('email') text-red-500 @enderror">Email</label>
                <div class="relative flex items-center group">
                  <div
                    class="absolute left-0 flex items-center justify-center h-full w-10 text-gray-500 dark:text-gray-400 @error('email') text-red-500 @enderror group-focus-within:text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                      <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                  </div>
                  <input id="email" name="email" type="email" value="{{ old('email') }}"
                    placeholder="example@gmail.com"
                    class="w-full pl-10 pr-3 py-2.5 border rounded-md focus:ring-1 focus:ring-indigo-500 focus:indigo--500 outline-none transition
                                    @error('email') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror
                                    bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 group-focus-within:border-indigo-600"
                    autocomplete="email" autofocus>
                  <div id="email-success" class="absolute right-3 hidden text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                    </svg>
                  </div>
                </div>
                @error('email')
                  <small id="email-error" class="text-red-500 text-sm mt-1">{{ $message }}</small>
                @enderror
                <small id="email-error" class="text-red-500 text-sm mt-1 hidden">Please enter a valid
                  email</small>
              </div>

              <!-- Password Field -->
              <div class="flex flex-col gap-1">
                <label for="password"
                  class="font-medium dark:text-gray-300 @error('password') text-red-500 @enderror">Password</label>
                <div class="relative flex items-center group">
                  <div
                    class="absolute left-0 flex items-center justify-center h-full w-10 text-gray-500 dark:text-gray-400 @error('password') text-red-500 @enderror group-focus-within:text-indigo-600">
                    <svg id="password-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                      fill="currentColor">
                      <path fill-rule="evenodd"
                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                        clip-rule="evenodd" />
                    </svg>
                  </div>
                  <input id="password" name="password" type="password" placeholder="Enter your password"
                    class="w-full pl-10 pr-10 py-2.5 border rounded-md focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition
                                    @error('password') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror
                                    bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 group-focus-within:border-indigo-600"
                    autocomplete="current-password">
                  <button type="button" id="toggle-password"
                    class="absolute right-0 flex items-center justify-center h-full w-10 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                    <svg id="eye-icon" class="h-5 w-5 fill-gray-600" xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 640 512">
                      <path
                        d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z" />
                    </svg>
                  </button>
                  <div id="password-success" class="absolute right-10 hidden text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                    </svg>
                  </div>
                </div>
                @error('password')
                  <small id="password-error" class="text-red-500 text-sm mt-1">{{ $message }}</small>
                @enderror
                <small id="password-error" class="text-red-500 text-sm mt-1 hidden">Password must be at
                  least 8 characters</small>
              </div>

              <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                  <input type="checkbox" id="remember" name="remember"
                    class="h-4 w-4 rounded accent-violet-800 border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700">
                  <label for="remember" class="text-sm text-gray-600 dark:text-gray-300 cursor-pointer">Remember
                    me</label>
                </div>
              </div>

              <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-4 rounded-md font-medium transition duration-200 flex items-center justify-center gap-2">
                Login
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform rotate-180" viewBox="0 0 20 20"
                  fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
                </svg>
              </button>
            </div>

          </form>
        </div>

        <!-- Right Column - Image -->
        <div class="hidden md:block">
          <img
            src="https://images.pexels.com/photos/29229695/pexels-photo-29229695/free-photo-of-creative-aerial-clock-formation-on-green-lawn.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
            alt="" class="h-full w-full object-cover dark:brightness-[0.8]">
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      const emailInput = document.getElementById('email');
      const passwordInput = document.getElementById('password');
      const togglePasswordBtn = document.getElementById('toggle-password');
      const eyeIcon = document.getElementById('eye-icon');
      const passwordIcon = document.getElementById('password-icon');

      // Email validation
      if (emailInput) {
        emailInput.addEventListener('input', function() {
          const emailError = document.getElementById('email-error');
          const emailSuccess = document.getElementById('email-success');
          const emailIcon = this.parentElement.querySelector('.absolute svg');

          if (!this.value) {
            emailError.classList.add('hidden');
            emailSuccess.classList.add('hidden');
            emailIcon.classList.remove('text-red-500', 'text-green-500');
            return;
          }

          if (!emailPattern.test(this.value)) {
            emailError.classList.remove('hidden');
            emailSuccess.classList.add('hidden');
            emailIcon.classList.add('text-red-500');
            emailIcon.classList.remove('text-green-500');
          } else {
            emailError.classList.add('hidden');
            emailSuccess.classList.remove('hidden');
            emailIcon.classList.remove('text-red-500');
            emailIcon.classList.add('text-green-500');
          }
        });
      }

      // Password validation
      if (passwordInput) {
        passwordInput.addEventListener('input', function() {
          const passwordError = document.getElementById('password-error');
          const passwordSuccess = document.getElementById('password-success');
          const passwordIcon = this.parentElement.querySelector('.absolute svg');

          if (!this.value) {
            passwordError.classList.add('hidden');
            passwordSuccess.classList.add('hidden');
            passwordIcon.classList.remove('text-red-500', 'text-green-500');
            passwordIcon.innerHTML =
              '<path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />';
            return;
          }

          if (this.value.length < 8) {
            passwordError.classList.remove('hidden');
            passwordSuccess.classList.add('hidden');
            passwordIcon.classList.add('text-red-500');
            passwordIcon.classList.remove('text-green-600');
            passwordIcon.innerHTML =
              '<path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />';
          } else {
            passwordError.classList.add('hidden');
            passwordSuccess.classList.remove('hidden');
            passwordIcon.classList.remove('text-red-500');
            passwordIcon.classList.add('text-green-500');
            passwordIcon.innerHTML =
              '<path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />';
          }
        });
      }

      // Toggle password visibility
      if (togglePasswordBtn) {
        togglePasswordBtn.addEventListener('click', function() {
          const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordInput.setAttribute('type', type);

          if (type === 'text') {
            eyeIcon.innerHTML =
              '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>';
          } else {
            eyeIcon.innerHTML =
              '<svg id="eye-icon" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"> <path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z" /></svg>';
          }
        });
      }
    });
  </script>
@endpush
