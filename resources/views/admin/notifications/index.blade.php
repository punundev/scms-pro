@extends('layouts.admin')

@section('title', 'My Notifications')

@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <i class="fas fa-bell text-2xl text-indigo-600 dark:text-indigo-400"></i>
      My Notifications
    </h3>

    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        {{ session('success') }}
      </div>
    @endif

    @if (Auth::user()->unreadNotifications->count() > 0)
      <form action="{{ route('admin.notifications.readAll') }}" method="POST" class="mb-4">
        @csrf
        <button type="submit"
          class="px-3 py-1 bg-indigo-500 text-white text-sm rounded-lg hover:bg-indigo-600 transition-colors flex items-center gap-1">
          <i class="fas fa-check-double"></i> Mark All as Read
        </button>
      </form>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-3">
      @forelse ($notifications as $notification)
        @php
          $data = $notification->data;
          $isRead = !is_null($notification->read_at);
        @endphp

        <div
          class="flex items-start p-4 rounded-lg border shadow-sm transition-colors
                           {{ $isRead ? 'bg-gray-50 dark:bg-gray-700 border-gray-200 dark:border-gray-700 opacity-80' : 'bg-white dark:bg-gray-800 border-indigo-200 dark:border-indigo-700 ring-2 ring-indigo-500/30' }}">

          <div class="flex-shrink-0 mr-4 mt-1">
            @if (!$isRead)
              <span class="size-2 rounded-full bg-indigo-500 block"></span>
            @else
              <i class="fas fa-circle-check text-gray-400 text-sm"></i>
            @endif
          </div>

          <div class="flex-grow">
            <div class="flex justify-between items-start">
              <h4
                class="font-semibold {{ $isRead ? 'text-gray-600 dark:text-gray-400' : 'text-gray-900 dark:text-white' }}">
                {{ $data['title'] ?? 'System Notification' }}
              </h4>
              <span
                class="text-xs {{ $isRead ? 'text-gray-500' : 'text-indigo-600 dark:text-indigo-300' }} ml-4 flex-shrink-0">
                {{ $notification->created_at->diffForHumans() }}
              </span>
            </div>
            <p
              class="text-sm mt-1 {{ $isRead ? 'text-gray-500 dark:text-gray-400' : 'text-gray-700 dark:text-gray-300' }}">
              {{ $data['body'] ?? 'Click to view details.' }}
            </p>

            <div class="mt-3 flex items-center space-x-3">
              <a href="{{ $data['link'] ?? '#' }}"
                class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 transition-colors">
                View Details
              </a>

              @if (!$isRead)
                <form action="{{ route('admin.notifications.read', $notification->id) }}" method="POST">
                  @csrf
                  <button type="submit"
                    class="text-xs text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                    | Mark as Read
                  </button>
                </form>
              @endif
            </div>
          </div>
        </div>
      @empty
        <div
          class="col-span-full p-6 text-center text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 rounded-lg">
          You have no notifications yet.
        </div>
      @endforelse
    </div>

    <div class="mt-6">
      {{ $notifications->onEachSide(2)->links('admin.components.tailwind-modern') }}
    </div>

  </div>

@endsection
