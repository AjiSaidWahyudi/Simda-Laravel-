<nav class="navbar-custom">
    <div class="navbar-left page-info">
        <h4 class="page-title mb-0">{{ $pageTitle ?? 'Dashboard' }}</h4>
        <nav class="breadcrumb-custom">
            @foreach ($breadcrumb as $item)
                @if (isset($item['url']))
                    <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                    <span>/</span>
                @else
                    <span class="active">{{ $item['label'] }}</span>
                @endif
            @endforeach
        </nav>
    </div>
    <div class="navbar-right">
        <button class="icon-btn">
            <i class="bi bi-bell"></i>
        </button>
        <div class="user-dropdown">
            <div class="user-trigger" id="userToggle">
                <img src="https://i.pravatar.cc/40" alt="User">
                <i class="bi bi-chevron-down"></i>
            </div>
            <div class="dropdown-menu-custom" id="userMenu">
                <div class="dropdown-header">
                    <div class="user-name">{{$user->name}}</div>
                    <div class="user-email">{{$user->email}}</div>
                </div>
                <a href="{{route('settings')}}" class="dropdown-item">
                    <i class="bi bi-person"></i> Profil
                </a>
                <a href="{{route('kelola_akun')}}" class="dropdown-item">
                    <i class="bi bi-person"></i> Kelola Akun
                </a>
                <a href="{{route('kelola_akses')}}" class="dropdown-item">
                    <i class="bi bi-person"></i> Kelola Akses
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>