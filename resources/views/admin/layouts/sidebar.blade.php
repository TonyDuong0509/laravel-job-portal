<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Messages
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-message">
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle">
                            <div class="is-online"></div>
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Kusnaedi</b>
                            <p>Hello, Bro!</p>
                            <div class="time">10 Hours Ago</div>
                        </div>
                    </a>
                </div>
                <div class="dropdown-footer text-center">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-icon bg-primary text-white">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            Template update is available now!
                            <div class="time text-primary">2 Min Ago</div>
                        </div>
                    </a>
                </div>
                <div class="dropdown-footer text-center">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="features-profile.html" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="features-settings.html" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST"
                    action="{{ Auth::guard('admin')->check() ? route('admin.logout') : route('logout') }}">
                    @csrf
                    <a href="{{ route('admin.logout') }}" class="dropdown-item has-icon text-danger"
                        onclick="event.preventDefault();
                                            this.closest('form').submit();">>
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ \App\Helpers\setSidebarActive(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>

            <li class="{{ \App\Helpers\setSidebarActive(['admin.orders.*']) }}">
                <a href="{{ route('admin.orders.index') }}" class="nav-link">
                    <i class="far fa-square"></i>
                    <span>Orders</span>
                </a>
            </li>

            <li class="{{ \App\Helpers\setSidebarActive(['admin.job-categories.*']) }}">
                <a href="{{ route('admin.job-categories.index') }}" class="nav-link">
                    <i class="far fa-square"></i>
                    <span>Job Category</span>
                </a>
            </li>

            <li class="{{ \App\Helpers\setSidebarActive(['admin.jobs.*']) }}">
                <a href="{{ route('admin.jobs.index') }}" class="nav-link">
                    <i class="far fa-square"></i>
                    <span>Job Post</span>
                </a>
            </li>

            <li
                class="dropdown {{ \App\Helpers\setSidebarActive([
                    'admin.industry-types.*',
                    'admin.organization-types.*',
                    'admin.languages.*',
                    'admin.professions.*',
                    'admin.skills.*',
                    'admin.educations.*',
                    'admin.job-types.*',
                    'admin.salary-types.*',
                    'admin.tags.*',
                    'admin.job-roles.*',
                    'admin.job-experiences.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>Attributes</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.industry-types.*']) }}"><a class="nav-link"
                            href="{{ route('admin.industry-types.index') }}">Industry
                            Type</a></li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.organization-types.*']) }}"><a
                            class="nav-link" href="{{ route('admin.organization-types.index') }}">Organization
                            Type</a>
                    </li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.languages.*']) }}"><a class="nav-link"
                            href="{{ route('admin.languages.index') }}">Languages</a>
                    </li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.professions.*']) }}"><a class="nav-link"
                            href="{{ route('admin.professions.index') }}">Professions</a>
                    </li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.skills.*']) }}"><a class="nav-link"
                            href="{{ route('admin.skills.index') }}">Skills</a>
                    </li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.educations.*']) }}"><a class="nav-link"
                            href="{{ route('admin.educations.index') }}">Educations</a>
                    </li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.job-types.*']) }}"><a class="nav-link"
                            href="{{ route('admin.job-types.index') }}">Job Types</a>
                    </li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.salary-types.*']) }}"><a class="nav-link"
                            href="{{ route('admin.salary-types.index') }}">Salary Types</a>
                    </li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.tags.*']) }}"><a class="nav-link"
                            href="{{ route('admin.tags.index') }}">Tags</a>
                    </li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.job-roles.*']) }}"><a class="nav-link"
                            href="{{ route('admin.job-roles.index') }}">Job Roles</a>
                    </li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.job-experiences.*']) }}"><a class="nav-link"
                            href="{{ route('admin.job-experiences.index') }}">Job Experiences</a>
                    </li>
                </ul>
            </li>

            <li
                class="dropdown {{ \App\Helpers\setSidebarActive(['admin.countries.*', 'admin.states.*', 'admin.cities.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i> <span>Locations</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.countries.*']) }}"><a class="nav-link"
                            href="{{ route('admin.countries.index') }}">Countries</a>
                    </li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.states.*']) }}"><a class="nav-link"
                            href="{{ route('admin.states.index') }}">States</a>
                    </li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.cities.*']) }}"><a class="nav-link"
                            href="{{ route('admin.cities.index') }}">Cities</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown {{ \App\Helpers\setSidebarActive(['admin.hero.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i> <span>Sections</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.hero.*']) }}"><a class="nav-link"
                            href="{{ route('admin.hero.index') }}">Hero</a>
                    </li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.why-choose-us.*']) }}"><a class="nav-link"
                            href="{{ route('admin.why-choose-us.index') }}">Why Choose Us</a>
                    </li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.learn-more.*']) }}"><a class="nav-link"
                            href="{{ route('admin.learn-more.index') }}">Learn More</a>
                    </li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.counter.*']) }}"><a class="nav-link"
                            href="{{ route('admin.counter.index') }}">Counter</a>
                    </li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.job-location.*']) }}"><a class="nav-link"
                            href="{{ route('admin.job-location.index') }}">Job Location</a>
                    </li>
                    <li class="{{ \App\Helpers\setSidebarActive(['admin.reviews.*']) }}"><a class="nav-link"
                            href="{{ route('admin.reviews.index') }}">Review</a>
                    </li>
                </ul>
            </li>

            <li class="{{ \App\Helpers\setSidebarActive(['admin.blogs.*']) }}">
                <a href="{{ route('admin.blogs.index') }}" class="nav-link">
                    <i class="far fa-square"></i>
                    <span>Blogs</span>
                </a>
            </li>

            <li class="{{ \App\Helpers\setSidebarActive(['admin.plans.*']) }}">
                <a href="{{ route('admin.plans.index') }}" class="nav-link">
                    <i class="far fa-square"></i>
                    <span>Price Plan</span>
                </a>
            </li>

            <li class="{{ \App\Helpers\setSidebarActive(['admin.newsletter.index']) }}">
                <a href="{{ route('admin.newsletter.index') }}" class="nav-link">
                    <i class="far fa-square"></i>
                    <span>Newsletter & Subscriber</span>
                </a>
            </li>

            <li class="{{ \App\Helpers\setSidebarActive(['admin.menu-builder.index']) }}">
                <a href="{{ route('admin.menu-builder.index') }}" class="nav-link">
                    <i class="far fa-square"></i>
                    <span>Menu Builder</span>
                </a>
            </li>

            <li class="{{ \App\Helpers\setSidebarActive(['admin.payment-settings.*']) }}">
                <a href="{{ route('admin.payment-settings.index') }}" class="nav-link">
                    <i class="far fa-square"></i>
                    <span>Payment Setting</span>
                </a>
            </li>
            <li class="{{ \App\Helpers\setSidebarActive(['admin.site-settings.*']) }}">
                <a href="{{ route('admin.site-settings.index') }}"
                    class="nav-link\">
                    <i class="far fa-square"></i>
                    <span>Site Setting</span>
                </a>
            </li>
            <li class="{{ \App\Helpers\setSidebarActive(['admin.page-builder.*']) }}">
                <a href="{{ route('admin.page-builder.index') }}"
                    class="nav-link\">
                    <i class="far fa-square"></i>
                    <span>Page Builder</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
