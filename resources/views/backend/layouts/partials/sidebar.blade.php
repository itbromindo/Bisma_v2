<!-- sidebar menu area start -->
@php
    $usr = Auth::guard('web')->user();
@endphp

<div class="app-sidebar">
    <div class="h-100" data-simplebar>
        <div class="sidebar-menu">
            <ul id="side-menu">
                <!-- <li class="menu-title no-margin">Dashboard</li> -->
                @if($usr->can('dashboard.view'))
                <li>
                    <a style="text-decoration:none" href="{{ route('admin.dashboard') }}" aria-expanded="false" class="waves-effect primary-light">
                        <span class="icon-box"><i class="ph-house-line"></i></span>
                        <div class="text-box">
                            Dashboard
                        </div>
                    </a>
                </li>
                @endif
                @if(isset($menuData))
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

<!-- sidebar menu area end -->