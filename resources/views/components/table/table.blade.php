<table class="w-full text-sm text-left">
    <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase">
        <tr class="text-nowrap">
            @foreach ($headers as $header)
                <th scope="col" class="px-4 py-4">{{ $header }}</th>
            @endforeach
            <th scope="col" class="px-4 py-4">Actions</th>
            @if ($checkbox)
                <th scope="col" class="px-4 py-4 w-20 flex gap-1.5 items-center">
                    <x-fields.checkbox id="selectAllCheckbox" name="" class="" value="" />
                    <span>All</span>
                </th>
            @endif
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
        {{ $slot }}
    </tbody>
</table>
