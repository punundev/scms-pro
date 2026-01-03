@extends('layouts.admin')
@section('title', 'System Settings')

@section('content')
  <div class="mb-6">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
      <div
        class="size-10 p-2 flex justify-center items-center rounded-full bg-indigo-50 text-indigo-600 border border-indigo-300 dark:border-indigo-800 dark:text-indigo-50 dark:bg-slate-800">
        <i class="ri-settings-4-fill text-2xl"></i>
      </div>
      System Settings
    </h3>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage school identity, contact details, and academic
      configurations.</p>
  </div>

  @if (session('success'))
    <div
      class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 border border-green-200"
      role="alert">
      <span class="font-medium">Success!</span> {{ session('success') }}
    </div>
  @endif

  <div class="md:flex gap-6">
    {{-- Navigation Tabs --}}
    <ul
      class="flex-column space-y-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0 w-full md:w-64"
      id="settingsTab" data-tabs-toggle="#settingsTabContent" role="tablist">
      @foreach ($settings as $groupName => $group)
        <li role="presentation">
          <button
            class="inline-flex items-center px-4 py-3 rounded-lg w-full transition-all duration-200 aria-selected:bg-indigo-600 aria-selected:text-white hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
            id="{{ $groupName }}-tab" data-tabs-target="#{{ $groupName }}" type="button" role="tab"
            aria-controls="{{ $groupName }}" aria-selected="false">
            <i
              class="ri-{{ $groupName == 'general' ? 'global' : ($groupName == 'contact' ? 'mail' : ' graduation-cap') }}-line mr-2"></i>
            <span class="capitalize">{{ $groupName }}</span>
          </button>
        </li>
      @endforeach
    </ul>

    {{-- Settings Form --}}
    <div id="settingsTabContent"
      class="p-6 bg-white border border-gray-200 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700 rounded-xl shadow-sm w-full">
      <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @foreach ($settings as $groupName => $groupSettings)
          <div class="hidden space-y-6" id="{{ $groupName }}" role="tabpanel"
            aria-labelledby="{{ $groupName }}-tab">

            <div class="border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">
              <h4 class="text-xl font-semibold text-gray-900 dark:text-white capitalize">{{ $groupName }} Configuration
              </h4>
              <p class="text-sm text-gray-500">Update your school's {{ $groupName }} information below.</p>
            </div>

            <div class="grid grid-cols-1 gap-6">
              @foreach ($groupSettings as $setting)
                <div>
                  <label for="{{ $setting->key }}"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase tracking-wider text-xs">
                    {{ str_replace('_', ' ', $setting->key) }}
                  </label>

                  @if ($setting->type === 'text')
                    <input type="text" name="{{ $setting->key }}" id="{{ $setting->key }}"
                      value="{{ $setting->value }}"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                  @elseif($setting->type === 'textarea')
                    <textarea name="{{ $setting->key }}" id="{{ $setting->key }}" rows="3"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $setting->value }}</textarea>
                  @elseif($setting->type === 'image')
                    <div class="flex items-center gap-4">
                      <div class="shrink-0">
                        <img class="h-16 w-16 object-contain rounded-lg border dark:border-gray-600 bg-gray-50"
                          src="{{ $setting->value ? asset('storage/' . $setting->value) : 'https://placehold.co/100' }}"
                          alt="Current Logo">
                      </div>
                      <label class="block w-full">
                        <input type="file" name="{{ $setting->key }}"
                          class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-gray-300">
                      </label>
                    </div>
                  @endif
                </div>
              @endforeach
            </div>
          </div>
        @endforeach

        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-end">
          <button type="submit"
            class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-xl text-sm px-10 py-3 text-center transition-all shadow-md">
            <i class="ri-save-line mr-1"></i> Save All Changes
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection
