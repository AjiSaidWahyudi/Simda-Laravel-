<aside class="sidebar">
    <button class="sidebar-close d-md-none" id="closeSidebar">
        <i class="bi bi-x-lg"></i>
    </button>
    <div class="sidebar-logo">
        <img src="{{asset('admin_simda/logo/logo_white.png')}}" alt="Logo SIMDA">
        <span>SIMDA</span>
    </div>
    <ul class="menu">
        <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <a href="{{route('home')}}">
                <i class="bi bi-speedometer2"></i>Dashboard
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('kir.index') ? 'active' : '' }}">
            <a href="{{route('kir.index')}}">
                <i class="bi bi-building"></i>Ruangan
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('inventarisasi.index') ? 'active' : '' }}">
            <a href="{{route('inventarisasi.index')}}">
                <i class="bi bi-box"></i>Inventarisasi
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('laporan.index') ? 'active' : '' }}">
            <a href="{{route('laporan.index')}}">
                <i class="bi bi-file-earmark-text"></i>Laporan
            </a>
        </li>
    </ul>
</aside>