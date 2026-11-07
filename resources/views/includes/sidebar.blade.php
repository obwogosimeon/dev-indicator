<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="{{ url('/home') }}" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="{{ asset('main/img/devlogo.png') }}" srcset="{{ asset('main/img/devlogo.png') }}" alt="logo">
                            <img class="logo-dark logo-img" src="{{ asset('main/img/devlogo.png') }}" srcset="{{ asset('main/img/devlogo.png') }}" alt="logo-dark">
                            <img class="logo-small logo-img logo-img-small" src="{{ asset('main/img/devlogo.png') }}" srcset="{{ asset('main/img/devlogo.png') }}" alt="logo-small">
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Workspace</h6>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item{{ request()->is('home') ? ' active' : '' }}">
                                    <a href="{{ url('/home')}}" class="nk-menu-link"{{ request()->is('home') ? ' aria-current=page' : '' }}>
                                        <span class="nk-menu-icon"><em class="icon ni ni-home"></em></span>
                                        <span class="nk-menu-text">Home</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                @can('projects.index')
                                <li class="nk-menu-item{{ request()->is('projects*') ? ' active' : '' }}">
                                    <a href="{{ route('projects.index')}}" class="nk-menu-link"{{ request()->is('projects*') ? ' aria-current=page' : '' }}>
                                        <span class="nk-menu-icon"><em class="icon ni ni-activity-round-fill"></em></span>
                                        <span class="nk-menu-text">Projects</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                @endcan
                                @can('programs.index')    
                                <li class="nk-menu-item{{ request()->is('programs*') ? ' active' : '' }}">
                                    <a href="{{ route('programs.index')}}" class="nk-menu-link"{{ request()->is('programs*') ? ' aria-current=page' : '' }}>
                                        <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                                        <span class="nk-menu-text">Programs</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                @endcan

                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Manage</h6>
                                </li><!-- .nk-menu-heading -->
                               
                            
                               
                               @can('organization')
                                <li class="nk-menu-item">
                                    <a href="{{ route('organizations.index')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-home-fill"></em></span>
                                        <span class="nk-menu-text">Organizations</span>
                                    </a>
                                </li>
                                @endcan
                                <li class="nk-menu-item">
                                    <a href="{{ url('barnotifications')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-send"></em></span>
                                        <span class="nk-menu-text">Invitations</span>
                                    </a>
                                </li>
                                @can('reports')
                                <li class="nk-menu-item">
                                    <a href="{{ url('index/reports')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-folder"></em></span>
                                        <span class="nk-menu-text">Reports</span>
                                    </a>
                                </li>
                                @endcan
                                @can('security.index')
                                <li class="nk-menu-item has-sub{{ request()->is('users*') || request()->is('roles*') || request()->is('notification/*') || request()->is('permissions*') ? ' active' : '' }}">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-setting-alt"></em></span>
                                        <span class="nk-menu-text">Settings</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        
                                        <li class="nk-menu-item{{ request()->is('users*') ? ' active' : '' }}">
                                            <a href="{{ route('users.index')}}" class="nk-menu-link"{{ request()->is('users*') ? ' aria-current=page' : '' }}><span class="nk-menu-text">Members</span></a>
                                        </li><!-- .nk-menu-item -->
                                        
                                       
                                        <li class="nk-menu-item{{ request()->is('roles*') ? ' active' : '' }}">
                                            <a href="{{ route('roles.index')}}" class="nk-menu-link"{{ request()->is('roles*') ? ' aria-current=page' : '' }}><span class="nk-menu-text">Roles & Permissions</span></a>
                                        </li><!-- .nk-menu-item -->
                                       
                                       
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link"><span class="nk-menu-text">Audit Trails</span></a>
                                        </li>
                                      
                                        <li class="nk-menu-item{{ request()->is('notification/*') ? ' active' : '' }}">
                                            <a href="{{ route('notificationget')}}" class="nk-menu-link"{{ request()->is('notification/*') ? ' aria-current=page' : '' }}><span class="nk-menu-text">Notifications</span></a>
                                        </li>
                                  
                                        <li class="nk-menu-item{{ request()->is('permissions*') ? ' active' : '' }}">
                                            <a href="{{ route('permissions.index')}}" class="nk-menu-link"{{ request()->is('permissions*') ? ' aria-current=page' : '' }}><span class="nk-menu-text">Permissions</span></a>
                                        </li>
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                @endcan
                              
                            
                                
                               
                                
                               
                               
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>