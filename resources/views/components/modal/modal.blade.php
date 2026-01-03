<div id="{{ $id }}" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div {{ $attributes->merge(['class' => 'relative bg-white dark:bg-gray-800 shadow-2xl transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600 ' . $class]) }}>
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="{{$svgClass}} size-8 p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="{{$viewBox}}" fill="{{$fill}}" stroke="{{$stroke}}">
                    <path fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="{{$svgPath}}"
                        clip-rule="evenodd" />
                </svg>
                {{$title}} <span class="title"></span>
            </h3>
            <x-button.btnclose id="close{{$id}}"/>
        </div>
        <!-- Form Content -->
        {{ $slot }}
    </div>
</div>
