<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>{{ config('app.name') }}</title>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"rel="stylesheet"/>
        @livewireStyles
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        @stack('styles')
    </head>
    <body data-scrollbar>
        <div x-data="setup()" x-init="loading = false" :class="{ 'dark': isDark }">
            <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
                <div x-ref="loading" class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-primary-darker" x-show="loading" x-transition.opacity>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="100px" height="100px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                        <circle cx="50" cy="50" fill="none" stroke="#ffffff" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                            <animateTransform animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                        </circle>
                    </svg>
                </div>

                @include('layouts.sidebar')

                <div class="flex-1 h-full overflow-x-hidden overflow-y-auto">

                @include('layouts.navigation')

                <main class="text-gray-600">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @livewireScripts
        <script src="{{ asset('js/admin.js') }}"></script>
        <script>
            const setup = () => {
                const getTheme = () => {
                    if (window.localStorage.getItem('dark')) {
                        return JSON.parse(window.localStorage.getItem('dark'))
                    }

                    return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
                }

                const setTheme = (value) => {
                    window.localStorage.setItem('dark', value)
                }

                return {
                    loading: true,

                    isDark: getTheme(),
                    toggleTheme() {
                        this.isDark = !this.isDark
                        setTheme(this.isDark)
                    },
                    setLightTheme() {
                        this.isDark = false
                        setTheme(this.isDark)
                    },
                    setDarkTheme() {
                        this.isDark = true
                        setTheme(this.isDark)
                    },

                    isSidebarOpen: false,
                    toggleSidbarMenu() {
                        this.isSidebarOpen = !this.isSidebarOpen
                    },

                    isMobileMainMenuOpen: false,
                    openMobileMainMenu() {
                        this.isMobileMainMenuOpen = true;
                        this.$nextTick(() => {
                            this.$refs.mobileMainMenu.focus();
                        });
                    },
                };
            };
        </script>
        @include('partials.messages')
        @stack('scripts')
    </body>
</html>
