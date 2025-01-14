<div class="nk-header nk-header-fixed is-light">
    <div class="container-lg wide-xl">
        <div class="nk-header-wrap">
            <div class="nk-header-brand">
                <a href="{{ url('dashboard') }}" class="logo-link">
                    <img src="{{ asset('assets/images/app_logo.png') }}" alt="" width="80px" height="50px">
                </a>
            </div>

            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>
                                <div class="user-info d-none d-xl-block">
                                    <div class="user-status user-status-unverified">Welcome</div>
                                    <div class="user-name dropdown-indicator">{{ Auth::user()->first_name }} {{ ((Auth::user()->last_name) != NULL) ? Auth::user()->last_name : '' }}</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <span>
                                            {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{ (Auth::user()->last_name != NULL) ? strtoupper(substr(Auth::user()->last_name, 0, 1)) : '' }}
                                        </span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{ Auth::user()->first_name }} {{ ((Auth::user()->last_name) != NULL) ? Auth::user()->last_name : '' }}</span>
                                        <span class="sub-text">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><em
                                                class="icon ni ni-signout"></em><span>Sign Out</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <li class="d-lg-none">
                            <a href="#" class="toggle nk-quick-nav-icon me-n1" data-target="sideNav"><em
                                    class="icon ni ni-menu"></em></a>
                        </li>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

