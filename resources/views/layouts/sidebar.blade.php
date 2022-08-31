<aside class="flex-shrink-0 hidden w-64 bg-white border-r dark:border-primary-darker dark:bg-darker md:block">
    <div class="flex flex-col h-full">
        <!-- Brand -->
        <a
            href="{{ route('admin.dashboard') }}"
            class="inline-block text-2xl font-bold tracking-wider uppercase text-primary-dark dark:text-light py-4 mx-auto"
            >
            {{ LaravelLocalization::getCurrentLocale() == 'ar' ? config('app.name_ar') : config('app.name') }}
        </a>
        <!-- Sidebar links -->
        <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
            <!-- Dashboards links -->
            <div x-data="{ isActive: {{ pageActive('admin.dashboard') ? 'true' : 'false' }} }">
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive}"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="isActive ? 'true' : 'false'"
                    >
                    <span aria-hidden="true">
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">{{ __('app.Dashboard') }}</span>
                </a>
            </div>

            <div x-data="{ isActive: {{ pageTabActive('admin.tenants') ? 'true' : 'false' }} }">
                <a
                    href="{{ route('admin.tenants.index') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive}"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="isActive ? 'true' : 'false'"
                    >
                    <span aria-hidden="true">
                        <i class="fas fa-house-user"></i>
                    </span>
                    <span class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">{{ __('app.Tenants') }}</span>
                </a>
            </div>

            <div x-data="{ isActive: {{ pageTabActive('admin.buildings') ? 'true' : 'false' }} }">
                <a
                    href="{{ route('admin.buildings.index') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive}"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="isActive ? 'true' : 'false'"
                    >
                    <span aria-hidden="true">
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">{{ __('app.Buildings') }}</span>
                </a>
            </div>

            <hr>

            <div x-data="{ isActive: {{ pageTabActive('admin.due-categories') ? 'true' : 'false' }} }">
                <a
                    href="{{ route('admin.due-categories.index') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive}"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="isActive ? 'true' : 'false'"
                    >
                    <span aria-hidden="true">
                        <i class="fas fa-boxes"></i>
                    </span>
                    <span class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">{{ __('app.Due Categories') }}</span>
                </a>
            </div>

            <div x-data="{ isActive: {{ pageTabActive('admin.nationalities') ? 'true' : 'false' }} }">
                <a
                    href="{{ route('admin.nationalities.index') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive}"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="isActive ? 'true' : 'false'"
                    >
                    <span aria-hidden="true">
                        <i class="fas fa-flag"></i>
                    </span>
                    <span class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">{{ __('app.Nationalities') }}</span>
                </a>
            </div>

            <div x-data="{ isActive: {{ pageTabActive('admin.users') ? 'true' : 'false' }} }">
                <a
                    href="{{ route('admin.users.index') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive}"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="isActive ? 'true' : 'false'"
                    >
                    <span aria-hidden="true">
                        <i class="fas fa-users"></i>
                    </span>
                    <span class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">{{ __('app.Users') }}</span>
                </a>
            </div>

            <hr>

            <div x-data="{ isActive: {{ pageTabActive('admin.activity-log') ? 'true' : 'false' }} }">
                <a
                    href="{{ route('admin.activity-log') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive}"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="isActive ? 'true' : 'false'"
                    >
                    <span aria-hidden="true">
                        <i class="fas fa-clipboard-list"></i>
                    </span>
                    <span class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">{{ __('app.Activity Log') }}</span>
                </a>
            </div>

            <div x-data="{ isActive: {{ pageTabActive('admin.settings.application') ? 'true' : 'false' }} }">
                <a
                    href="{{ route('admin.settings.application') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive}"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="isActive ? 'true' : 'false'"
                    >
                    <span aria-hidden="true">
                        <i class="fas fa-globe"></i>
                    </span>
                    <span class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">{{ __('app.Application Settings') }}</span>
                </a>
            </div>

            <!-- Dashboards links -->
            {{-- <div x-data="{ isActive: {{ pageTabActive('admin.dashboard') ? 'true' : 'false' }}, open: {{ pageTabActive('admin.dashboard') ? 'true' : 'false' }} }">
                <a
                    href="#"
                    @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary dark:hover:text-light"
                    :class="{'bg-primary-100 dark:bg-primary': isActive || open}"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'"
                    >
                    <span aria-hidden="true">
                        <svg
                            class="w-5 h-5"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                />
                        </svg>
                    </span>
                    <span class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm">Dashboards</span>
                    <span class="ml-auto" aria-hidden="true">
                        <svg
                            class="w-4 h-4 transition-transform transform"
                            :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
                    <a
                        href="index.html"
                        role="menuitem"
                        class="block p-2 text-sm {{ pageActive('admin.dashboard') ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md dark:text-light hover:text-gray-700 dark:hover:text-light"
                        >
                    Default
                    </a>
                    <a
                        href="#"
                        role="menuitem"
                        class="block p-2 text-sm {{ pageActive('admin.testt') ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md hover:text-gray-700 dark:hover:text-light"
                        >
                    Project Mangement (soon)
                    </a>
                    <a
                        href="#"
                        role="menuitem"
                        class="block p-2 text-sm {{ pageActive('admin.testtt') ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md hover:text-gray-700 dark:hover:text-light"
                        >
                    E-Commerce (soon)
                    </a>
                </div>
            </div> --}}
        </nav>
    </div>
</aside>
