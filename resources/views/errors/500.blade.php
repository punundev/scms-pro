@extends('layouts.error')
@section('title', '500')
@section('content')

  <div class="max-w-md w-full bg-white rounded-2xl shadow-lg p-8 animate-fade-in">
    <div class="flex flex-col items-center text-center space-y-6">
      <!-- School Icon -->
      <div class="w-20 h-20 bg-school-primary rounded-full flex items-center justify-center animate-bounce-slow">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white book-icon" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
      </div>

      <!-- Error Number -->
      <div class="flex items-center justify-center space-x-2">
        <span class="text-6xl font-bold text-school-primary">5</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-school-accent book-icon" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
        </svg>
        <span class="text-6xl font-bold text-school-primary">0</span>
      </div>

      <!-- Error Message -->
      <div class="space-y-2">
        <h2 class="text-2xl font-bold text-school-dark error-text">Internal Server Error</h2>
        <p class="text-gray-600">Oops! Something broke in our school system.</p>
        <p class="text-gray-500 text-sm">An unexpected error occurred. Our technical team has been notified, but please
          contact the school administrator for assistance.</p>
      </div>

      <!-- Action Buttons -->
      <div class="flex flex-col sm:flex-row gap-3 w-full">
        <a href="/"
          class="flex-1 px-6 py-2 bg-school-primary text-white rounded-md hover:bg-school-secondary transition-all duration-300 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
          Back to Dashboard
        </a>
        <button onclick="window.history.back()"
          class="flex-1 px-6 py-2 bg-white border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-all duration-300 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
          </svg>
          Go Back
        </button>
      </div>
    </div>
  </div>
@endsection
