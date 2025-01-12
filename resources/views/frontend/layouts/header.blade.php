<header class="header sticky-bar">
    <div class="container">
        <div class="main-header">
            <div class="header-left">
                <div class="header-logo">
                    <a class="d-flex" href="{{ url('/') }}">
                        <img alt="Job List" src="{{ asset('frontend/assets/imgs/template/logo.png') }}">
                    </a>
                </div>
            </div>
            <div class="header-nav">
                <nav class="nav-main-menu">
                    <ul class="main-menu">
                        <li class="has-children"><a class="{{ \App\Helpers\setSidebarActive(['home']) }}"
                                href="{{ url('/') }}">Home</a></li>
                        <li class="has-children"><a class="{{ \App\Helpers\setSidebarActive(['jobs.index']) }}"
                                href="{{ route('jobs.index') }}">Find a Job</a></li>
                        <li class="has-children"><a class="{{ \App\Helpers\setSidebarActive(['companies.index']) }}"
                                href="{{ route('companies.index') }}">Recruiters</a></li>
                        <li class="has-children"><a class="{{ \App\Helpers\setSidebarActive(['candidates.index']) }}"
                                href="{{ route('candidates.index') }}">Candidates</a></li>
                        <li class="has-children"><a class="{{ \App\Helpers\setSidebarActive(['blogs.index']) }}"
                                href="{{ route('blogs.index') }}">Blog</a></li>
                    </ul>
                </nav>
                <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span
                        class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
            </div>
            <div class="header-right">
                <div class="block-signin">
                    <!-- <a class="text-link-bd-btom hover-up" href="page-register.html">Register</a> -->
                    @guest
                        <a class="btn btn-default btn-shadow ml-40 hover-up" href="{{ route('login') }}">Sign in</a>
                    @endguest
                    @auth
                        @if (Auth::user()->role === 'company')
                            <a class="btn btn-default btn-shadow ml-40 hover-up" style="width: 200px"
                                href="{{ route('company.dashboard') }}">Company
                                Dashboard</a>
                        @elseif(Auth::user()->role === 'candidate')
                            <a class="btn btn-default btn-shadow ml-40 hover-up" style="width: 200px"
                                href="{{ route('candidate.dashboard') }}">Candidate
                                Dashboard</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>
