<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
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
                <a href="{{ route('home') }}">
                    <i class='bx bx-home'></i>
                    <span class="links_name">{{ __('Home') }}</span>
                </a>
                <span class="tooltip">{{ __('Home') }}</span>
            </li>
           --}}
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
                <div class="iocn-link">
                    <a href="{{url('/workers')}}">
                        <i class='bx bx-user'></i>

                        <span class="links_name">{{ __('Workers') }}</span>
                    </a>
                    <span class="tooltip">{{ __('Workers') }}</span>
                </div>
            </li>
            <li>
                <a href="{{ route('activities') }}">
                    <i class='bx bxl-react'></i>
                    <span class="links_name">{{ __('Activities') }}</span>
                </a>
                <span class="tooltip">{{ __('Activities') }}</span>
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
                        @if (Auth::user())
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
    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
        });
    </script>
</nav>
