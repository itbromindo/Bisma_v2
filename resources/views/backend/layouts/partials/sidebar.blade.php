<!-- sidebar menu area start -->
@php
    $usr = Auth::guard('web')->user();
    $menuData = session('menu');
@endphp

<div class="app-sidebar">
    <div class="h-100" data-simplebar>
        <div class="sidebar-menu">
            <ul id="side-menu">
                <!-- <li class="menu-title no-margin">Dashboard</li> -->
                <li>
                    <a style="text-decoration:none" href="{{ route('admin.dashboard') }}" aria-expanded="false" class="waves-effect primary-light">
                        <span class="icon-box"><i class="ph-house-line"></i></span>
                        <div class="text-box">
                            Dashboard
                        </div>
                    </a>
                </li>
                @if($menuData)
                    @foreach($menuData as $modul)
                        <li class="has-child">
                            <a style="text-decoration:none" href="javascript: void(0);" aria-expanded="false" class="waves-effect primary-light">
                                <span class="icon-box"><i class="{{ $modul['modul_icon'] }}"></i></span>
                                <div class="text-box">{{ $modul['modul_name'] }}</div>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                @foreach($modul['modul_menu'] as $menu)
                                    <li>
                                        <a style="text-decoration:none" href="/admin/{{ $menu['menu_route'] }}">
                                            {{ $menu['menu_name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>

<!-- <div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="text-white">Admin</h2> 
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">

                    @if ($usr->can('dashboard.view'))
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('role.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Roles & Permissions
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.roles.create') || Route::is('admin.roles.index') || Route::is('admin.roles.edit') || Route::is('admin.roles.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                                <li class="{{ Route::is('admin.roles.index')  || Route::is('admin.roles.edit') ? 'active' : '' }}"><a href="{{ route('admin.roles.index') }}">All Roles</a></li>
                            @endif
                            @if ($usr->can('role.create'))
                                <li class="{{ Route::is('admin.roles.create')  ? 'active' : '' }}"><a href="{{ route('admin.roles.create') }}">Create Role</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    
                    @if ($usr->can('admin.create') || $usr->can('admin.view') ||  $usr->can('admin.edit') ||  $usr->can('admin.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                            Admins
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.admins.create') || Route::is('admin.admins.index') || Route::is('admin.admins.edit') || Route::is('admin.admins.show') ? 'in' : '' }}">
                            
                            @if ($usr->can('admin.view'))
                                <li class="{{ Route::is('admin.admins.index')  || Route::is('admin.admins.edit') ? 'active' : '' }}"><a href="{{ route('admin.admins.index') }}">All Admins</a></li>
                            @endif

                            @if ($usr->can('admin.create'))
                                <li class="{{ Route::is('admin.admins.create')  ? 'active' : '' }}"><a href="{{ route('admin.admins.create') }}">Create Admin</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('penduduk.create') || $usr->can('penduduk.view') || $usr->can('penduduk.edit') || $usr->can('penduduk.delete') || $usr->can('penduduk.importexcel'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Data Penduduk
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.penduduk.create') || Route::is('admin.penduduk.index') || Route::is('admin.penduduk.edit') || Route::is('admin.penduduk.show') || Route::is('admin.penduduk.importexcel') ? 'in' : '' }}">
                            
                            @if ($usr->can('penduduk.view'))
                                <li class="{{ Route::is('admin.penduduk.index')  || Route::is('admin.penduduk.edit') ? 'active' : '' }}"><a href="{{ route('admin.penduduk.index') }}">All Data Penduduk</a></li>
                            @endif

                            @if ($usr->can('penduduk.create'))
                                <li class="{{ Route::is('admin.penduduk.create')  ? 'active' : '' }}"><a href="{{ route('admin.penduduk.create') }}">Create Data Penduduk</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                </ul>
            </nav>
        </div>
    </div>
</div> -->
<!-- sidebar menu area end -->