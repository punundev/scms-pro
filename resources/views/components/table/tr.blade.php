<tr {{ $attributes->merge(['class' => 'text-nowrap border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700' . $class]) }}>
    {{ $slot }}
</tr>
