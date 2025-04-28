<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('plants.index') }}">
                    <div class= "mb-2 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="32" viewBox="0 0 44 32" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22.0011 7.46892C18.1051 3.51594 13.2359 1.86128 9.42977 1.18423C7.84746 0.900319 6.24517 0.745992 4.63842 0.722747C4.03117 0.714524 3.42383 0.729715 2.81771 0.768288L2.70691 0.777396H2.67696L2.66499 0.780433H2.659L1.52105 0.889732L1.3264 2.0313L1.32341 2.04648L1.31742 2.08291L1.29346 2.21954L1.22459 2.71442C0.901282 5.26407 0.817057 7.83905 0.97304 10.4048C1.26651 14.9923 2.49429 20.8307 6.49507 24.8869C10.406 28.8521 15.1734 30.3974 18.8927 30.9621C20.5028 31.2071 22.1316 31.3036 23.7589 31.2506V28.7306L12.2207 17.0265L14.3409 14.877L23.7619 24.4346V9.65794C23.2468 8.86856 22.6599 8.13686 22.0011 7.46892ZM26.7565 13.8295V24.9416L31.8114 20.8429L33.68 23.211L26.7565 28.8278V31.2202C27.8515 31.2334 28.9461 31.1706 30.0326 31.032C32.7547 30.6767 36.2913 29.69 38.9205 27.0243C41.5737 24.3313 42.5949 20.266 42.9992 17.1297C43.2373 15.2394 43.3155 13.3318 43.2327 11.428L43.2268 11.3308V11.3005L43.2238 11.2944L43.1339 10.0708L41.9421 9.89779H41.9301L41.9031 9.89172L41.8133 9.87958L41.4809 9.84011C39.8073 9.66839 38.1223 9.63995 36.444 9.7551C33.5183 9.97369 29.6613 10.76 27.1757 13.3863L27.056 13.5077L26.7565 13.8295Z" fill="green"/>
                        </svg>
                    </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <!-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div> -->

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('plants.index')" :active="request()->routeIs('plants.index')">
                        {{ __('Explore Plants') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('weather.show')" :active="request()->routeIs('weather.show')">
                        {{ __('Weather') }}
                    </x-nav-link>
                </div>

                @if(auth()->check() && auth()->user()->role === 'admin')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('plantuser.index')" :active="request()->routeIs('plantuser.index')">
                        {{ __('My Garden') }}
                    </x-nav-link>
                </div>
                @endif
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            @if(auth()->check())
                                <div>{{ Auth::user()->name }}</div>
                            @endif
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @if(auth()->check())
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @endif
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
