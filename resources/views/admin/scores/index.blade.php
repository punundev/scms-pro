@extends('layouts.admin')

@section('title', 'Score Register')

@section('content')
  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">

    {{-- Success Message --}}
    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        {{ session('success') }}
      </div>
    @endif

    {{-- Error Message --}}
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        {{ session('error') }}
      </div>
    @endif

    {{-- SAVE ALL FORM --}}
    <form action="{{ route('admin.scores.saveAll') }}" method="POST">
      @csrf
      <input type="hidden" name="exam_id" value="{{ $exam->id }}">

      {{-- Save All Button --}}
      <div class="flex justify-between mb-2">
        <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
          <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M16.5 6.75A.75.75 0 0 1 17.25 7.5v6A.75.75 0 0 1 16.5 15h-9a.75.75 0 0 1-.75-.75v-6A.75.75 0 0 1 7.5 6.75h9Z" />
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M13.5 10.5h-3m3 0a.75.75 0 1 1 0 1.5.75.75 0 0 1 0-1.5ZM17.25 15V7.5a.75.75 0 0 0-.75-.75h-9a.75.75 0 0 0-.75.75V15h10.5Z" />
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 6.75a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 6.75v10.5A2.25 2.25 0 0 1 18.75 19.5H5.25A2.25 2.25 0 0 1 3 17.25V6.75Z" />
          </svg>
          Score Register for Exam:
          <span class="ml-1 text-indigo-600 dark:text-indigo-400 capitalize">
            {{ $exam->type }} -
            {{ $exam?->courseOffering?->teacher?->name }} -
            {{ $exam?->courseOffering?->classroom?->name }} -
            {{ $exam?->courseOffering?->time_slot }}
            (Max: {{ $exam->total_marks }})
          </span>
        </h3>

        <div class="flex gap-4">
          <a href="{{ route('admin.exams.index', ['exam_id' => $exam->id, 'course_offering_id' => $exam->courseOffering->id]) }}"
            class="px-5 py-1 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700">
            <span class="btn-content flex items-center justify-center">
              <i class="fa-solid fa-arrow-left me-2"></i>
              Back to Exam
            </span>
          </a>
          <button type="submit" class="px-5 py-1 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700">
            Save All Scores
          </button>

        </div>
      </div>

      {{-- Students List --}}
      <div class="my-5 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">

        @forelse($students as $student)
          @php
            $scoreEntry = $student->scores->first();
          @endphp

          <div
            class="border-b border-e border-gray-200 dark:border-gray-700 py-1 pe-1 grid grid-cols-1 md:grid-cols-4 gap-4">

            {{-- Student Info --}}
            <div class="md:col-span-2">
              <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $student->name }}</span>
              <div class="text-xs text-gray-500 dark:text-gray-400">
                Student ID: {{ $student->id }}
              </div>
            </div>

            {{-- Score Input --}}
            <div class="flex flex-col">
              <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Score</label>
              {{-- <input type="number" name="score_{{ $student->id }}" min="0" max="{{ $exam->total_marks }}"
                name="fee" value="{{ old('fee') }}" value="{{ $scoreEntry->score ?? 0 }}"
                class="w-full border border-gray-300 dark:border-gray-600 rounded px-2 py-1 text-sm
                text-gray-800 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500"> --}}
              <input type="number" name="score_{{ $student->id }}" min="0" max="{{ $exam->total_marks }}"
                value="{{ $scoreEntry->score ?? '' }}"
                class="w-full border border-gray-300 dark:border-gray-600 rounded px-2 py-1 text-sm
              text-gray-800 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">

            </div>

            {{-- Remarks Input --}}
            <div class="flex flex-col">
              <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Remarks</label>
              <input type="text" name="remarks_{{ $student->id }}" value="{{ $scoreEntry->remarks ?? '' }}"
                class="w-full border border-gray-300 dark:border-gray-600 rounded px-2 py-1 text-sm
                text-gray-800 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

          </div>

        @empty
          <div class="p-8 text-center bg-gray-50 dark:bg-gray-700 rounded-lg shadow-inner">
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
              No students found in this course offering.
            </p>
          </div>
        @endforelse

      </div>
    </form>

  </div>
@endsection
