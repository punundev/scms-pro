<input id="{{ $id ?? $name }}" type="checkbox" name="{{ $name }}" value="{{$value}}" @checked($checked??false)
    class="{{ $class }} appearance-none size-4 
    border-2 border-gray-300 dark:border-gray-600 rounded-sm cursor-pointer transition-all ease-in-out relative
    checked:bg-indigo-500 dark:checked:bg-indigo-600 checked:border-indigo-500 dark:checked:border-indigo-600
        hover:border-indigo-400 dark:hover:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-700
        focus:ring-offset-2 focus:outline-none before:content-[''] before:absolute before:inset-0 before:bg-no-repeat before:bg-center
        before:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwb2x5bGluZSBwb2ludHM9IjIwIDYgOSAxNyA0IDEyIj48L3BvbHlsaW5lPjwvc3ZnPg==')]
        before:opacity-0 before:transition-opacity before:duration-200 checked:before:opacity-100">

