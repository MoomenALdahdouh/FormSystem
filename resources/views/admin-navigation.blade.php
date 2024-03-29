<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="sidebar open">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus icon'></i>
            {{--<img src="{{'http://127.0.0.1:8000/storage/profile-photos/KSeKY34O2SlgGq2krnxAuf3NLsTwuJQLWaBaRKuX.jpg'}}"/>--}}
            <div class="logo_name">DIRCAMS</div>
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
                    <span class="links_name">{{ __('strings.home') }}</span>
                </a>
                <span class="tooltip">{{ __('strings.home') }}</span>
            </li>
            <li>
                <a href="{{ route('projects') }}">
                    <i class='bx bx-folder'></i>
                    <span class="links_name">{{ __('strings.projects') }}</span>
                </a>
                <span class="tooltip">{{ __('strings.projects') }}</span>
            </li>
            <li>
                <a href="{{ route('subprojects') }}">
                    <i class='bx bx-file'></i>
                    <span class="links_name">{{ __('strings.subprojects') }}</span>
                </a>
                <span class="tooltip">{{ __('strings.subprojects') }}</span>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="{{url('users')}}">
                        <i class='bx bx-user'></i>

                        <span class="links_name">{{ __('strings.users') }}</span>
                    </a>
                    <span class="tooltip">{{ __('strings.users') }}</span>
                    {{--<i class='bx bxs-chevron-down arrow' ></i>--}}
                </div>
            </li>
            <li>
                <a href="{{ route('activities') }}">
                    <i class='bx bxl-react'></i>
                    <span class="links_name">{{ __('strings.activities') }}</span>
                </a>
                <span class="tooltip">{{ __('strings.activities') }}</span>
            </li>
            <li>
                <a href="{{ route('subactivities') }}">
                    <i class="las la-biohazard"></i>
                    <span class="links_name">{{ __('strings.subactivities') }}</span>
                </a>
                <span class="tooltip">{{ __('strings.subactivities') }}</span>
            </li>
            <li>
                <a href="{{ route('forms') }}">
                    <i class='bx bxs-data'></i>
                    <span class="links_name">{{ __('strings.forms') }}</span>
                </a>
                <span class="tooltip">{{ __('strings.forms') }}</span>
            </li>
            <li>
                <a href="{{ route('interviews.fetch') }}">
                    <i class="lab la-wpforms"></i>
                    <span class="links_name">{{ __('strings.interviews') }}</span>
                </a>
                <span class="tooltip">{{ __('strings.interviews') }}</span>
            </li>
            <li>
                <a href="{{ route('profile.show') }}">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">{{ __('strings.settings') }}</span>
                </a>
                <span class="tooltip">{{ __('strings.settings') }}</span>
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
    {{-- <section class="home-section">
         <div class="home-content">
             <i class='bx bx-menu'></i>
             <span class="text">Drop Down Sidebar</span>
         </div>
     </section>--}}



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
