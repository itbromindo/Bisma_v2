<style>
    .userProfileBox {
        position: relative;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%; /* Tepat di bawah elemen */
        right: 0;
        background: #ffffff;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 10;
        padding: 10px 0;
        width: 150px;
    }

    .dropdown-menu .dropdown-item {
        display: block;
        padding: 10px 20px;
        color: #333;
        text-align: left;
        text-decoration: none;
        font-size: 14px;
        background: none;
        border: none;
        cursor: pointer;
        width: 100%;
        text-align: left;
    }

    .dropdown-menu .dropdown-item:hover {
        background: #f8f9fa;
    }

    .userProfileBox:hover .dropdown-menu {
        display: block;
    }
</style>
<header class="app-header rt-sticky">
    <div class="navbar align-items-center">
        <div class="container-fluid">
            <div class="left-content">
                <div class="logo-segment">
                    <div class="all-logo">
                        <!-- <a class='brand-logo' href='/'>
                            <img src="{{ asset('images/large_bromindo.png') }}" alt="" draggable="false" class="logo-black" />
                            <img src="{{ asset('backend/assets/images/logo/logo-white.svg') }}" alt="" draggable="false" class="logo-white" />
                            <img src="{{ asset('images/bromindo.jpg') }}" alt="" draggable="false" class="logo-icon rt-mr-10" style="max-width: 30px"/>
                            <img src="{{ asset('backend/assets/images/logo/logo-white.svg') }}" alt="" draggable="false" class="logo-full-white rt-mr-10" />
                        </a>
                        <a class='brand-logo white' href='/'>
                            <img src="{{ asset('backend/assets/images/logo/logo-white.svg') }}" alt="" draggable="false" />
                        </a>
                        <a class='collapse-in-logo' href='/'>
                            <img src="{{ asset('images/bromindo.jpg') }}" alt="" draggable="false" class="logo-icon-blue" style="max-width: 30px"/>
                            <img src="{{ asset('backend/assets/images/logo/logo-icon-white.svg') }}" alt="" draggable="false" class="logo-icon-white" />
                        </a> -->
                    </div>
                    <div class="opener_sidebar">
                        <span class="icon-bar-open" id="opener_icon"></span>
                    </div>
                    <div class="opener_horizentalmenu" id="mainmenuOpen">
                        <span class="icon-bar-open2" id="opener_icon2"></span>
                    </div>
                </div>
                <div class="dashboard-message position-relative">
                    <span class="back_sidebar_icon">
                        <i class="ph-arrow-right"></i>
                    </span>
                </div>
            </div>
            <div class="ms-auto">
                <div class="rt-nav-tolls d-flex align-items-center">
                    <ul>
                        {{-- <li>
                            <div class="iconBox page-setting pointer" id="layout">
                                <img src="{{ asset('backend/assets/images/svg/grid.svg') }}" alt="" draggable="false" class="for-v" />
                                <img src="{{ asset('backend/assets/images/svg/grid2.svg') }}" alt="" draggable="false" class="for-h" />
                            </div>
                        </li>
                        <li>
                            <div class="iconBox notifications pointer waves-effect primary-light">
                                <img src="{{ asset('backend/assets/images/svg/bell.svg') }}" alt="" draggable="false" class="for-v" />
                                <img src="{{ asset('backend/assets/images/svg/bell2.svg') }}" alt="" draggable="false" class="for-h" />
                            </div>
                        </li> --}}
                        <li>
                            <div class="userProfileBox openaccount pointer">
                                <img src="{{ asset('backend/assets/images/all-img/user.svg') }}" alt="" />
                                {{ Auth::guard('web')->user()->user_name }}
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.logout.submit') }}"
                                    onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">Log Out</a>
                                </div>
                                <form id="admin-logout-form" action="{{ route('admin.logout.submit') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</header>

