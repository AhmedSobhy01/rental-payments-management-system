<header class="relative bg-white dark:bg-darker">
    <div
        class="flex items-center {{ pageTabActive('admin.') ? 'justify-between' : 'justify-end' }} md:justify-end p-2 border-b dark:border-primary-darker">
        @if (pageTabActive('admin.'))
            <button @click="isMobileMainMenuOpen = !isMobileMainMenuOpen"
                class="p-1 transition-colors duration-200 rounded-md text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark md:hidden focus:outline-none focus:ring">
                <span class="sr-only">{{ __('app.Open main manu') }}</span>
                <span aria-hidden="true">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </span>
            </button>
        @endif

        <div class="flex justify-between items-center">
            @if (pageTabActive('admin.'))
                <nav class="space-x-2 flex items-center mr-5">
                    <!-- Toggle dark theme button -->
                    <button aria-hidden="true" class="relative focus:outline-none" x-cloak @click="toggleTheme">
                        <div
                            class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-lighter">
                        </div>
                        <div class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-150 transform scale-110 rounded-full shadow-sm"
                            :class="{ 'translate-x-0 -translate-y-px  bg-white text-primary-dark': !
                                isDark, 'translate-x-6 text-primary-100 bg-primary-darker': isDark }">
                            <svg x-show="!isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            <svg x-show="isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                    </button>
                </nav>
            @endif

            <nav x-data="{ langsOpen: false }" class="relative mr-5">
                <button @click="langsOpen = !langsOpen"
                    class="flex mx-4 text-gray-600 dark:text-white focus:outline-none">
                    <i class="fas fa-globe"></i>
                </button>

                <div x-show="langsOpen" @click="langsOpen = false" class="fixed inset-0 h-full w-full z-10"
                    style="display: none;"></div>

                <div x-show="langsOpen"
                    class="absolute top-5 {{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'right-0' : 'left-0' }} mt-2 bg-white rounded-lg shadow-xl overflow-hidden z-10"
                    style="width: 12rem; display: none;">

                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <a href="{{ LaravelLocalization::getLocalizedURL($locale) }}"
                            class="flex items-center px-3 py-2  {{ $locale == LaravelLocalization::getCurrentLocale() ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:text-white hover:bg-indigo-600' }} -mx-2">
                            <img class="h-8 w-8 rounded-full object-cover mx-1"
                                src="data:image/png;base64,{{ File::exists(public_path('imgs/langs/' . $locale . '.png')) ? base64_encode(file_get_contents(public_path('imgs/langs/' . $locale . '.png'))) : '' }}"
                                alt="flag">
                            <p class="text-sm mx-2">{{ $language['native'] }}</p>
                        </a>
                    @endforeach

                </div>
            </nav>

            @auth
                <nav class="space-x-2 flex items-center mr-3 z-50">
                    <!-- User avatar button -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })"
                            type="button" aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'"
                            class="transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100">
                            <span class="sr-only">{{ __('app.User menu') }}</span>
                            <img class="w-10 h-10 rounded-full"
                                src="{{ 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=' . urlencode(auth()->user()->name) }}"
                                alt="Ahmed Kamel" />
                        </button>
                        <!-- User dropdown menu -->
                        <div x-show="open" x-ref="userMenu" x-transition:enter="transition-all transform ease-out"
                            x-transition:enter-start="translate-y-1/2 opacity-0"
                            x-transition:enter-end="translate-y-0 opacity-100"
                            x-transition:leave="transition-all transform ease-in"
                            x-transition:leave-start="translate-y-0 opacity-100"
                            x-transition:leave-end="translate-y-1/2 opacity-0" @click.away="open = false"
                            @keydown.escape="open = false"
                            class="absolute {{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'right-0' : 'left-0' }} w-48 py-1 bg-white rounded-md shadow-lg top-12 ring-1 ring-black ring-opacity-5 dark:bg-dark focus:outline-none"
                            tabindex="-1" role="menu" aria-orientation="vertical" aria-label="User menu">
                            @if (!pageTabActive('admin'))
                                <a href="{{ route('admin.dashboard') }}" role="menuitem"
                                    class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                    {{ __('app.Admin Dashboard') }}
                                </a>
                            @endif

                            <a href="{{ route('admin.settings.account') }}" role="menuitem"
                                class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                {{ __('app.Edit Account') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}" role="menuitem"
                                class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                @csrf
                                <button type="submit"
                                    class="w-full {{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'text-left' : 'text-right' }}">{{ __('app.Logout') }}</button>
                            </form>
                        </div>
                    </div>
                </nav>
            @else
                <a href="{{ route('login') }}"
                    class="bg-blue-500 text-white px-6 py-2 rounded font-medium mr-3 hover:bg-blue-600 transition duration-200 each-in-out">{{ __('app.Login') }}</a>
            @endauth
        </div>
    </div>

    @if (pageTabActive('admin.'))
        <!-- Mobile main manu -->
        <div class="border-b md:hidden dark:border-primary-darker" x-show="isMobileMainMenuOpen"
            @click.away="isMobileMainMenuOpen = false">
            <nav aria-label="Main" class="px-2 py-4 space-y-2">
                <div x-data="{ isActive: {{ pageActive('admin.dashboard') ? 'true' : 'false' }} }">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive }" role="button" aria-haspopup="true"
                        :aria-expanded="isActive ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <i class="fas fa-home"></i>
                        </span>
                        <span
                            class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">{{ __('app.Dashboard') }}</span>
                    </a>
                </div>

                <div x-data="{ isActive: {{ pageTabActive('admin.tenants') ? 'true' : 'false' }} }">
                    <a href="{{ route('admin.tenants.index') }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive }" role="button" aria-haspopup="true"
                        :aria-expanded="isActive ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <i class="fas fa-house-user"></i>
                        </span>
                        <span
                            class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">{{ __('app.Tenants') }}</span>
                    </a>
                </div>

                <div x-data="{ isActive: {{ pageTabActive('admin.buildings') ? 'true' : 'false' }} }">
                    <a href="{{ route('admin.buildings.index') }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive }" role="button" aria-haspopup="true"
                        :aria-expanded="isActive ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <i class="fas fa-home"></i>
                        </span>
                        <span
                            class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">{{ __('app.Buildings') }}</span>
                    </a>
                </div>

                <hr>

                <div x-data="{ isActive: {{ pageTabActive('admin.due-categories') ? 'true' : 'false' }} }">
                    <a href="{{ route('admin.due-categories.index') }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive }" role="button" aria-haspopup="true"
                        :aria-expanded="isActive ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <i class="fas fa-boxes"></i>
                        </span>
                        <span
                            class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">{{ __('app.Due Categories') }}</span>
                    </a>
                </div>

                <div x-data="{ isActive: {{ pageTabActive('admin.nationalities') ? 'true' : 'false' }} }">
                    <a href="{{ route('admin.nationalities.index') }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive }" role="button" aria-haspopup="true"
                        :aria-expanded="isActive ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <i class="fas fa-flag"></i>
                        </span>
                        <span
                            class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">{{ __('app.Nationalities') }}</span>
                    </a>
                </div>

                <div x-data="{ isActive: {{ pageTabActive('admin.users') ? 'true' : 'false' }} }">
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive }" role="button" aria-haspopup="true"
                        :aria-expanded="isActive ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <i class="fas fa-users"></i>
                        </span>
                        <span
                            class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">{{ __('app.Users') }}</span>
                    </a>
                </div>

                <hr>

                <div x-data="{ isActive: {{ pageTabActive('admin.activity-log') ? 'true' : 'false' }} }">
                    <a href="{{ route('admin.activity-log') }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive }" role="button" aria-haspopup="true"
                        :aria-expanded="isActive ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <i class="fas fa-clipboard-list"></i>
                        </span>
                        <span
                            class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">{{ __('app.Activity Log') }}</span>
                    </a>
                </div>

                <div x-data="{ isActive: {{ pageTabActive('admin.settings.application') ? 'true' : 'false' }} }">
                    <a href="{{ route('admin.settings.application') }}"
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive }" role="button" aria-haspopup="true"
                        :aria-expanded="isActive ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <i class="fas fa-globe"></i>
                        </span>
                        <span
                            class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">{{ __('app.Application Settings') }}</span>
                    </a>
                </div>

                {{-- <div x-data="{ isActive: {{ pageTabActive('admin.dashboard') ? 'true' : 'false' }}, open: {{ pageTabActive('admin.dashboard') ? 'true' : 'false' }} }">
                <a
                    href="#"
                    @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive || open}"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                    <span aria-hidden="true">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </span>
                    <span class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">Dashboards</span>
                    <span class="ml-auto" aria-hidden="true">
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
                    <a href="index.html" role="menuitem" class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                        Default
                    </a>
                    <a href="index.html" role="menuitem" class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                        Default
                    </a>
                    <a href="index.html" role="menuitem" class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                        Default
                    </a>
                </div>
            </div> --}}
            </nav>
        </div>
    @endif
</header>
