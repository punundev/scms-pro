@extends('layouts.admin')

@section('title', 'Dashboard')
@section('content')

  <div class="p-4 sm:p-0">

    @include('admin.dashboard.stat')

    @include('admin.dashboard.recent-enroll')

    <!-- Charts and Activity Section -->
    <div class="box grid grid-cols-1 lg:grid-cols-3 gap-4">

      @include('admin.dashboard.attendance')

      <!-- Recent Activities -->
      <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm mb-10">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">{{ __('message.recent_activities') }}</h3>
        <div class="space-y-4">
          <!-- Activity Item -->

          @foreach ($recentActivities as $activity)
            <div class="flex items-start">
              <div
                class="h-9 w-9 rounded-full flex items-center justify-center mr-3 mt-1 flex-shrink-0
             bg-{{ $activity['color'] }}-500/20 text-{{ $activity['color'] }}-400">
                <i class="fas fa-{{ $activity['icon'] }}"></i>
              </div>

              <div>
                <p class="text-gray-800 dark:text-white font-medium text-sm">
                  {{ $activity['title'] }}
                </p>

                <p class="text-gray-500 dark:text-gray-400 text-sm">
                  {{ $activity['description'] }}
                </p>

                <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">
                  {{ $activity['time']->diffForHumans() }}
                </p>
              </div>
            </div>
          @endforeach

        </div>
        <a href="{{ route('admin.notifications.index') }}"
          class="w-full  mt-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg text-sm transition-colors">
          {{ __('message.view_all_activities') }}
        </a>
      </div>
    </div>

  </div>
@endsection
