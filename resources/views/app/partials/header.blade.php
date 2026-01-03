<header
    class="bg-white/90 backdrop-blur sticky top-0 z-40 shadow-sm border-b border-slate-300">
    <div class="max-w-7xl xl:max-w-[96rem] mx-auto px-4 py-3 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="#" class="flex items-center gap-3">
                <img src="assets{{ '/images/scms.png' }}" alt="logo" class="size-14 rounded-full border" />
                <div class="hidden sm:block">
                    <div class="font-semibold text-lg">Wat Damnak</div>
                    <div class="text-xs text-gray-500">Learning Centre</div>
                </div>
            </a>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex items-center gap-6">
            <ul class="flex gap-2 items-center">
                <li class="group relative">
                    <a href="{{ route('web.home') }}"
                        class="px-3 py-2 rounded-md hover:bg-gray-100 transition-colors duration-200">Home</a>
                </li>
                <li class="group relative">
                    <button
                        class="px-3 py-2 rounded-md hover:bg-gray-100 flex items-center gap-2 submenu-toggle no-select transition-colors duration-200">
                        Who i am
                        <svg class="w-3 h-3 transition-transform duration-200 group-hover:rotate-180"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <!-- Submenu -->
                    <ul
                        class="submenu absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 border border-gray-200">
                        <li>
                            <a href="{{ route('web.about') }}"
                                class="block px-4 py-2 hover:bg-gray-100 transition-colors duration-200">Our
                                History</a>
                        </li>
                        <li>
                            <a href="#team"
                                class="block px-4 py-2 hover:bg-gray-100 transition-colors duration-200">Mission
                                &
                                Vision</a>
                        </li>
                    </ul>
                </li>
                <li class="group relative">
                    <a href="{{ route('web.home') }}"
                        class="px-3 py-2 rounded-md hover:bg-gray-100 transition-colors duration-200">What
                        we do</a>
                </li>

                <li class="group relative">
                    <button
                        class="px-3 py-2 rounded-md hover:bg-gray-100 flex items-center gap-2 submenu-toggle no-select transition-colors duration-200">Activity
                        <svg class="w-3 h-3 transition-transform duration-200 group-hover:rotate-180"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul
                        class="submenu absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 border border-gray-200">
                        <li><a href="#events"
                                class="block px-4 py-2 hover:bg-gray-100 transition-colors duration-200">Events</a>
                        </li>

                        <li>
                            <a href="#clubs"
                                class="block px-4 py-2 hover:bg-gray-100 transition-colors duration-200">News</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('web.contact') }}"
                        class="px-3 py-2 rounded-md hover:bg-gray-100 transition-colors duration-200">Contact
                        Us</a>
                </li>
            </ul>
        </nav>
        <div class="relative">
            <a href="{{ route('web.home') }}"
                class="px-3 py-2 border border-orange-500 rounded-md bg-orange-500 hover:bg-transparent hover:text-orange-500 text-slate-100 transition-colors duration-200 cursor-pointer">
                <i class="fas fa-hand-holding-heart w-5 group-hover:text-blue-500 transition-colors duration-200"></i>
                Donations
            </a>
        </div>
        <!-- Desktop Theme Toggle -->
        <button id="darkToggle"
            class="size-9 hidden lg:flex items-center justify-center rounded-full cursor-pointer p-2 border border-slate-300 hover:bg-gray-100 transition-colors duration-200"
            title="Toggle dark mode">
            <i class="fas fa-moon"></i>
        </button>
        <!-- Mobile controls -->
        <div class="flex items-center gap-3 lg:hidden">
            <button id="mobileOpen"
                class="bg-indigo-800 cursor-pointer text-slate-200 size-9 flex items-center justify-center rounded-full p-2 
                        border hover:bg-slate-100 hover:text-indigo-800 transition-colors duration-200"
                aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>
