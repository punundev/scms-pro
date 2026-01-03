@php
    // Set base classes
    $containerClasses = 'flex gap-3 text-gray-600 dark:text-gray-300 border-b border-gray-200 dark:border-slate-700 pb-2';
    $iconWrapperClasses =
        'p-1 rounded-md border border-gray-200 dark:border-slate-700 text-indigo-600 dark:text-indigo-400';
    $textWrapperClasses = 'flex flex-col';

    // Adjust layout based on position
    switch ($position) {
        case 'right':
            $containerClasses .= ' flex-row-reverse items-center';
            $textWrapperClasses .= ' text-right';
            break;
        case 'top':
            $containerClasses .= ' flex-col items-start';
            break;
        case 'bottom':
            $containerClasses .= ' flex-col-reverse items-start';
            break;
        default:
            // left
            $containerClasses .= ' flex-row items-center';
    }
@endphp

<div class="{{ $containerClasses }}">
    <div class="{{ $iconWrapperClasses }}">
        <i class="{{ $icon }} text-md text-indigo-600"></i>
    </div>
    <div class="{{ $textWrapperClasses }}">
        <span class="label text-xs {{ $labelcolor }}">{{ $label }}</span>
        <span id="{{ $id }}" class="text-xs truncate font-bold text-start {{ $color }}">{{ $name }}</span>
    </div>
</div>
