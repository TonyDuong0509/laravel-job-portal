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
                        <li class="has-children"><a class="active" href="{{ url('/') }}">Home</a></li>
                        <li class="has-children"><a href="{{ route('jobs.index') }}">Find a Job</a></li>
                        <li class="has-children"><a href="companies-grid.html">Recruiters</a></li>
                        <li class="has-children"><a href="candidates-grid.html">Candidates</a></li>
                        <li class="has-children"><a href="blog-grid.html">Blog</a></li>
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
