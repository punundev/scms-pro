<div class="mb-2">
    <label for="{{ $edit ? "edit_$name" : $name }}"
        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    @if (!$searchable)
        <select id="{{ $edit ? "edit_$name" : $name }}" name="{{ $name }}"
            class="form-control form-select w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                border-slate-300"
            @if ($required) required @endif>
            <option value="">{{ $placeholder }}</option>
            @foreach ($options as $key => $text)
                <option value="{{ $key }}" {{ old($name, $value) == $key ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endforeach
        </select>
    @else
        {{-- Searchable select --}}
        <div data-name="{{ $name }}"
            class="form-control custom-select relative w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300">

            <div class="select-header cursor-pointer flex justify-between items-center">
                <span class="selected-value" id="{{ $edit ? "edit_$name" : $name }}">
                    {{ $options[old($name, $value)] ?? $placeholder }}
                </span>
                <span class="arrow transition-transform duration-300">▼</span>
            </div>

            <div
                class="select-options absolute z-10 top-full left-0 right-0 max-h-[250px] overflow-y-auto hidden shadow-md rounded-sm bg-slate-50 dark:bg-slate-700 border border-slate-300 dark:border-slate-600">

                <div class="search-container p-2 sticky top-0 z-10 bg-white dark:bg-slate-700">
                    <input type="search"
                        class="search-input text-sm w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                            dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
                        placeholder="Search {{ strtolower($label) }}...">
                </div>

                <div class="options-container">
                    @if ($options instanceof \Illuminate\Support\Collection)
                        @foreach ($options as $option)
                            <div class="select-option px-[10px] py-2 cursor-pointer border-b border-slate-200 dark:border-slate-600
                                {{ old($name, $value) == $option->id ? 'selected' : '' }}"
                                data-value="{{ $option->name }}" data-id="{{ $option->id }}">
                                {{ ucfirst($option->name) }}
                            </div>
                        @endforeach
                    @elseif (is_array($options))
                        @foreach ($options as $key => $text)
                            <div class="select-option px-[10px] py-2 cursor-pointer border-b border-slate-200 dark:border-slate-600
                                {{ old($name, $value) == $key ? 'selected' : '' }}"
                                data-value="{{ $text }} " data-id="{{ $key }}">
                                {{ $text }}
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="no-results p-2 text-center text-red-500 hidden">No results found</div>
            </div>

            <input type="hidden" name="{{ $name }}" id="{{ $edit ? "edit_$name" : $name }}"
                value="{{ old($name, $value) }}">
        </div>
    @endif

    <p id="{{ $edit ? "edit-error-$name" : "error-$name" }}" class="mt-1 text-sm text-red-600 dark:text-red-500"></p>
    <div class="invalid-feedback text-sm text-red-600 dark:text-red-500 mt-1">
        Field {{ $label }} is required.
    </div>
</div>

