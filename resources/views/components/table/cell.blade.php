{{-- <div class="flex items-center">
    <img class="detail-btn size-10 rounded-full object-cover cursor-pointer"
        src="{{ $item->photo ? asset($item->photo) : 'https://placehold.co/40x40/6366F1/FFFFFF?text=' . substr($item->name, 0, 1) }}"
        alt="{{ $item->name }} image" data-id="{{ $item->id }}">
    <div class="pl-3">
        <div class="text-base font-semibold">
            {{ $item->name }}
        </div>
        <div class="font-normal text-gray-500 truncate w-[85%]">
            {{ $item->email }}
        </div>
    </div>
</div> --}}


<div class="flex items-center">
    @if (!empty($item->avatar))
        <img class="w-10 h-10 rounded-full object-cover cursor-grab detail-btn" src="{{ asset($item->avatar) }}"
            alt="{{ $item->name }} image" data-id="{{ $item->id }}">
    @elseif (!empty($item->photo))
        <img class="w-10 h-10 rounded-full object-cover cursor-grab detail-btn" src="{{ asset($item->photo) }}"
            alt="{{ $item->name }} image" data-id="{{ $item->id }}">
    @elseif (!empty($item->cover_image))
        <img class="w-10 h-10 rounded-full object-cover cursor-grab detail-btn" src="{{ asset($item->cover_image) }}"
            alt="{{ $item->name }} image" data-id="{{ $item->id }}">
    @else
        <div data-id="{{ $item->id }}" class="detail-btn w-10 h-10 rounded-full flex items-center justify-center bg-indigo-600 text-white font-bold cursor-default select-none">
            {{ strtoupper(substr($item->name, 0, 1)) }}
        </div>
    @endif
    
    <div class="pl-3">
        <div class="text-base font-semibold">
            {{ $item->name }}
        </div>
        <div class="font-normal text-gray-500 truncate">
            {{ $item->email }}
        </div>
    </div>
</div>
