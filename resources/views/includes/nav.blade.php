<div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="{{ url('/home') }}" class="logo-link">
                                    <img class="logo-light logo-img" src="{{ asset('main/img/devlogo.png') }}" srcset="{{ asset('main/img/devlogo.png') }}" alt="logo">
                                    <img class="logo-dark logo-img" src="{{ asset('main/img/devlogo.png') }}" srcset="{{ asset('main/img/devlogo.png') }}" alt="logo-dark">
                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-search ms-3 ms-xl-0">
                                <em class="icon ni ni-search"></em>
                                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search anything">
                            </div><!-- .nk-header-news -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown data-tools-dropdown">
                                        <button type="button" class="dropdown-toggle data-tools-toggle" id="dataToolsMenu" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Data tools">
                                            <em class="icon ni ni-file-code" aria-hidden="true"></em>
                                            <span class="data-tools-label">Data tools</span>
                                            <em class="icon ni ni-chevron-down data-tools-chevron" aria-hidden="true"></em>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dataToolsMenu">
                                            <div class="dropdown-inner data-tools-menu__body">
                                                <a class="data-tools-menu__link" href="https://kf.kobo.visystem.net/" target="_blank" rel="noopener noreferrer">
                                                    <span class="data-tools-menu__icon data-tools-menu__icon--teal"><em class="icon ni ni-file-code" aria-hidden="true"></em></span>
                                                    <span class="data-tools-menu__copy"><strong>KoboToolbox</strong><small>Data collection</small></span>
                                                </a>
                                                <a class="data-tools-menu__link" href="https://rstudio.visystem.net/" target="_blank" rel="noopener noreferrer">
                                                    <span class="data-tools-menu__icon data-tools-menu__icon--blue"><em class="icon ni ni-bar-chart" aria-hidden="true"></em></span>
                                                    <span class="data-tools-menu__copy"><strong>RStudio</strong><small>Statistical analysis</small></span>
                                                </a>
                                                <a class="data-tools-menu__link" href="https://jupyter.visystem.net" target="_blank" rel="noopener noreferrer">
                                                    <span class="data-tools-menu__icon data-tools-menu__icon--violet"><em class="icon ni ni-code" aria-hidden="true"></em></span>
                                                    <span class="data-tools-menu__copy"><strong>Jupyter</strong><small>Notebooks and code</small></span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown notification-dropdown">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" id="notificationMenu" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifications">
                                            <em class="icon ni ni-bell" aria-hidden="true"></em>
                                            <span class="header-notification-count{{ $notificationcount == 0 ? ' header-notification-count--empty' : '' }}" aria-label="{{ $notificationcount }} notifications">{{ $notificationcount }}</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end" aria-labelledby="notificationMenu">
                                            <div class="dropdown-head">
                                                <span class="sub-title nk-dropdown-title">Notifications</span>
                                                <span class="badge bg-lighter">{{ $notificationcount }}</span>
                                            </div>
                                            <div class="dropdown-body">
                                                <div class="nk-notification">
                                                    @forelse($notifcations as $notify)
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text"><span>{{ $notify->type }}</span></div>
                                                            <div class="nk-notification-time">{{ $notify->datetime }}</div>
                                                        </div>
                                                    </div>
                                                    @empty
                                                    <div class="header-notification-empty">
                                                        <span class="header-notification-empty__icon" aria-hidden="true"><em class="icon ni ni-check-circle"></em></span>
                                                        <span>You’re all caught up</span>
                                                        <small>New notifications will appear here.</small>
                                                    </div>
                                                    @endforelse
                                                </div><!-- .nk-notification -->
                                            </div><!-- .nk-dropdown-body -->
                                            <div class="dropdown-foot center">
                                                <a href="{{ url('barnotifications') }}">View all updates</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle me-n1" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Open account menu">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                                </div>
                                                <div class="user-info d-none d-xl-block">
                                                    <div class="user-name dropdown-indicator">{{ Auth::user()->name }}</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end" aria-labelledby="userMenu">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">{{ Auth::user()->name }}</span>
                                                        <span class="sub-text">{{ Auth::user()->email }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="{{ route('users.show', Auth::id()) }}"><em class="icon ni ni-user-alt"></em><span>View profile</span></a></li>
                                                    <li><a href="{{ route('change-password') }}"><em class="icon ni ni-setting-alt"></em><span>Change password</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li>
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                            <em class="icon ni ni-signout"></em>
                                                            <span>{{ __('Log out') }}</span>
                                                        </a>
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                                                            @csrf
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>