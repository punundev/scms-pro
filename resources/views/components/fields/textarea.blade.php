@php
    $id = $edit ? "edit_$name" : ($detail ? "detail_$name" : $name);
    $errorId = $edit ? "edit-error-$name" : ($detail ? "detail-error-$name" : "error-$name");
@endphp

<div class="mb-2">
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
        {{ $label }} @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <textarea id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}"
        class="form-control w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
               dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
               border-slate-300 @if ($readonly || $disabled) bg-gray-50 @endif"
        placeholder="{{ $placeholder }}" @if ($required) required @endif
        @if ($readonly) readonly @endif @if ($disabled) disabled @endif
        @if ($maxlength !== null) maxlength="{{ $maxlength }}" @endif
        @if ($autocomplete !== null) autocomplete="{{ $autocomplete }}" @endif
        @if ($pattern !== null) pattern="{{ $pattern }}" @endif>{{ old($name, $value) }}</textarea>

    <p id="{{ $errorId }}" class="error-{{ $name }} mt-1 text-sm text-red-600 dark:text-red-500"></p>

    <div class="invalid-feedback text-sm text-red-600 dark:text-red-500 mt-1">
        field {{ $label }} is required
    </div>
</div>
