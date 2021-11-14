<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div>
        <div class="sidebar">
            <div class="logo-details">
                <i class='bx bxl-c-plus-plus icon'></i>
                <div class="logo_name">FormSystem</div>
                <i class='bx bx-menu' id="btn"></i>
            </div>
            <ul class="nav-list" style="list-style-type: none; padding: 0; margin: 0">
                <li>
                    <i class='bx bx-search'></i>
                    <input type="text" placeholder="Search...">
                    <span class="tooltip">Search</span>
                </li>
                {{--<li>
                    <a href="#">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>--}}
                <li>
                    <a href="{{ route('home') }}">
                        <i class='bx bx-home'></i>
                        <span class="links_name">{{ __('Home') }}</span>
                    </a>
                    <span class="tooltip">{{ __('Home') }}</span>
                </li>
                <li>
                    <a href="{{ route('projects') }}">
                        <i class='bx bx-folder'></i>
                        <span class="links_name">{{ __('Projects') }}</span>
                    </a>
                    <span class="tooltip">{{ __('Projects') }}</span>
                </li>
                <li>
                    <a href="{{ route('subprojects') }}">
                        <i class='bx bx-file'></i>
                        <span class="links_name">{{ __('Subprojects') }}</span>
                    </a>
                    <span class="tooltip">{{ __('Subprojects') }}</span>
                </li>
                <li>
                    <a href="{{ route('users') }}">
                        <i class='bx bx-user'></i>

                        <span class="links_name">{{ __('Users') }}</span>
                    </a>
                    <span class="tooltip">{{ __('Users') }}</span>
                </li>
                <li>
                    <a href="{{ route('activities') }}">
                        <i class='bx bxl-react'></i>
                        <span class="links_name">{{ __('Activities') }}</span>
                    </a>
                    <span class="tooltip">{{ __('Activities') }}</span>
                </li>
                <li>
                    <a href="{{ route('workers') }}">
                        <i class='bx bxs-user-voice'></i>
                        <span class="links_name">{{ __('Workers') }}</span>
                    </a>
                    <span class="tooltip">{{ __('Workers') }}</span>
                </li>
                <li>
                    <a href="{{ route('profile.show') }}">
                        <i class='bx bx-cog'></i>
                        <span class="links_name">Setting</span>
                    </a>
                    <span class="tooltip">Setting</span>
                </li>
                <li class="profile">
                    <div class="profile-details">
                        {{--<img src="profile.jpg" alt="i">--}}
                        <div class="name_job">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <div class="name"><span><i
                                            class='bx bxl-product-hunt'></i></span>{{ Auth::user()->name }}</div>
                                {{--<div class="job">Web designer</div>--}}
                            @endif
                        </div>
                    </div>
                    {{--<a href="{{ route('logout') }}"></a>--}}
                    <i class='bx bx-log-out' id="log_out"></i>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-dropdown-link href="{{ route('logout') }}"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            <i class='bx bx-log-out' id="log_out"></i>
                        </x-jet-dropdown-link>
                    </form>
                </li>
            </ul>
        </div>

        {{--<section class="home-section">
            --}}{{--<div class="text">Dashboard</div>--}}{{--

            <div class="container">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                    --}}{{--<div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}">
                            <x-jet-application-mark class="block h-9 w-auto"/>
                        </a>
                    </div>--}}{{--

                    <!-- Navigation Links -->
                        --}}{{--<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-jet-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                                {{ __('Home') }}
                            </x-jet-nav-link>
                        </div>--}}{{--
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- Teams Dropdown -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="ml-3 relative">
                                <x-jet-dropdown align="right" width="60">
                                    <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </span>
                                    </x-slot>

                                    <x-slot name="content">
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Manage Team') }}
                                            </div>

                                            <!-- Team Settings -->
                                            <x-jet-dropdown-link
                                                href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                                {{ __('Team Settings') }}
                                            </x-jet-dropdown-link>

                                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                                    {{ __('Create New Team') }}
                                                </x-jet-dropdown-link>
                                            @endcan

                                            <div class="border-t border-gray-100"></div>

                                            <!-- Team Switcher -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Switch Teams') }}
                                            </div>

                                            @foreach (Auth::user()->allTeams() as $team)
                                                <x-jet-switchable-team :team="$team"/>
                                            @endforeach
                                        </div>
                                    </x-slot>
                                </x-jet-dropdown>
                            </div>
                    @endif

                    <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <x-jet-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                 src="{{ Auth::user()->profile_photo_url }}"
                                                 alt="{{ Auth::user()->name }}"/>
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </span>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>

                                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-jet-dropdown-link>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-jet-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-jet-dropdown-link href="{{ route('logout') }}"
                                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-jet-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-jet-dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16"/>
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Responsive Navigation Menu -->
            --}}{{--<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-jet-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-jet-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="flex-shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover"
                                     src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                            </div>
                        @endif

                        <div>
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <!-- Account Management -->
                        <x-jet-responsive-nav-link href="{{ route('profile.show') }}"
                                                   :active="request()->routeIs('profile.show')">
                            {{ __('Profile') }}
                        </x-jet-responsive-nav-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}"
                                                       :active="request()->routeIs('api-tokens.index')">
                                {{ __('API Tokens') }}
                            </x-jet-responsive-nav-link>
                        @endif

                    <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-jet-responsive-nav-link>
                        </form>

                        <!-- Team Management -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Team') }}
                            </div>

                            <!-- Team Settings -->
                            <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                                                       :active="request()->routeIs('teams.show')">
                                {{ __('Team Settings') }}
                            </x-jet-responsive-nav-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-jet-responsive-nav-link href="{{ route('teams.create') }}"
                                                           :active="request()->routeIs('teams.create')">
                                    {{ __('Create New Team') }}
                                </x-jet-responsive-nav-link>
                            @endcan

                            <div class="border-t border-gray-200"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link"/>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>--}}{{--
        </section>--}}

    </div>

{{--<div class=" content-section">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">26 New Messages!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-list"></i>
                    </div>
                    <div class="mr-5">11 New Tasks!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-shopping-cart"></i>
                    </div>
                    <div class="mr-5">123 New Orders!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-support"></i>
                    </div>
                    <div class="mr-5">13 New Tickets!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
                </a>
            </div>
        </div>
    </div>

</div>--}}

{{--<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
        <div class="flex">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <x-jet-application-mark class="block h-9 w-auto" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <x-jet-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                    {{ __('Home') }}
                </x-jet-nav-link>
                --}}{{--<x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-jet-nav-link>--}}{{--
                <x-jet-nav-link href="{{ route('projects') }}" :active="request()->routeIs('projects')">
                    {{ __('Projects') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('subprojects') }}" :active="request()->routeIs('subprojects')">
                    {{ __('Subprojects') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('activities') }}" :active="request()->routeIs('activities')">
                    {{ __('Activities') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')">
                    {{ __('Users') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('workers') }}" :active="request()->routeIs('workers')">
                    {{ __('Workers') }}
                </x-jet-nav-link>
            </div>
        </div>

        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <!-- Teams Dropdown -->
            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="60">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                    {{ Auth::user()->currentTeam->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-60">
                                <!-- Team Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Team') }}
                                </div>

                                <!-- Team Settings -->
                                <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                    {{ __('Team Settings') }}
                                </x-jet-dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                    <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                        {{ __('Create New Team') }}
                                    </x-jet-dropdown-link>
                                @endcan

                                <div class="border-t border-gray-100"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Switch Teams') }}
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                    <x-jet-switchable-team :team="$team" />
                                @endforeach
                            </div>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            @endif

            <!-- Settings Dropdown -->
            <div class="ml-3 relative">
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                    {{ Auth::user()->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                        @endif

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            </div>
        </div>

        <!-- Hamburger -->
        <div class="-mr-2 flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>--}}

<!-- Responsive Navigation Menu -->
    {{-- <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
         <div class="pt-2 pb-3 space-y-1">
             <x-jet-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                 {{ __('Home') }}
             </x-jet-nav-link>
             --}}{{--<x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                 {{ __('Dashboard') }}
             </x-jet-nav-link>--}}{{--
             <x-jet-nav-link href="{{ route('projects') }}" :active="request()->routeIs('projects')">
                 {{ __('Projects') }}
             </x-jet-nav-link>
             <x-jet-nav-link href="{{ route('subprojects') }}" :active="request()->routeIs('subprojects')">
                 {{ __('Subprojects') }}
             </x-jet-nav-link>
             <x-jet-nav-link href="{{ route('activities') }}" :active="request()->routeIs('activities')">
                 {{ __('Activities') }}
             </x-jet-nav-link>
             <x-jet-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')">
                 {{ __('Users') }}
             </x-jet-nav-link>
             <x-jet-nav-link href="{{ route('workers') }}" :active="request()->routeIs('workers')">
                 {{ __('Workers') }}
             </x-jet-nav-link>
         </div>

         <!-- Responsive Settings Options -->
         <div class="pt-4 pb-1 border-t border-gray-200">
             <div class="flex items-center px-4">
                 @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                     <div class="flex-shrink-0 mr-3">
                         <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                              alt="{{ Auth::user()->name }}"/>
                     </div>
                 @endif

                 <div>
                     <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                     <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                 </div>
             </div>

             <div class="mt-3 space-y-1">
                 <!-- Account Management -->
                 <x-jet-responsive-nav-link href="{{ route('profile.show') }}"
                                            :active="request()->routeIs('profile.show')">
                     {{ __('Profile') }}
                 </x-jet-responsive-nav-link>

                 @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                     <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}"
                                                :active="request()->routeIs('api-tokens.index')">
                         {{ __('API Tokens') }}
                     </x-jet-responsive-nav-link>
                 @endif

             <!-- Authentication -->
                 <form method="POST" action="{{ route('logout') }}">
                     @csrf

                     <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                     this.closest('form').submit();">
                         {{ __('Log Out') }}
                     </x-jet-responsive-nav-link>
                 </form>

                 <!-- Team Management -->
                 @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                     <div class="border-t border-gray-200"></div>

                     <div class="block px-4 py-2 text-xs text-gray-400">
                         {{ __('Manage Team') }}
                     </div>

                     <!-- Team Settings -->
                     <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                                                :active="request()->routeIs('teams.show')">
                         {{ __('Team Settings') }}
                     </x-jet-responsive-nav-link>

                     @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                         <x-jet-responsive-nav-link href="{{ route('teams.create') }}"
                                                    :active="request()->routeIs('teams.create')">
                             {{ __('Create New Team') }}
                         </x-jet-responsive-nav-link>
                     @endcan

                     <div class="border-t border-gray-200"></div>

                     <!-- Team Switcher -->
                     <div class="block px-4 py-2 text-xs text-gray-400">
                         {{ __('Switch Teams') }}
                     </div>

                     @foreach (Auth::user()->allTeams() as $team)
                         <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link"/>
                     @endforeach
                 @endif
             </div>
         </div>
     </div>--}}
</nav>
