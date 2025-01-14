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
                    @php
                        $navigationMenu = \Menu::getByName('Navigation Menu');
                    @endphp
                    <ul class="main-menu">
                        @foreach ($navigationMenu as $menu)
                            @if ($menu['child'])
                                <li class="has-children"><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a>
                                    <ul class="sub-menu">
                                        @foreach ($menu['child'] as $childMenu)
                                            <li><a href="{{ $childMenu['link'] }}">{{ $childMenu['label'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="has-children"><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
                <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span
                        class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
            </div>
            <div class="header-right">
                <div class="block-signin">
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
