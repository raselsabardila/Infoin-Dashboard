<div class="main-sidebar">
    <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="/">Hilfe</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="/">Hf</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li>
            <a 
                @if (Auth::user()->role_id == 1)
                    href="{{ route("user.dashboard") }}"
                @endif
                @if (Auth::user()->role_id == 2)
                    href="{{ route("eo.dashboard") }}"
                @endif
                @if (Auth::user()->role_id == 3)
                    href="{{ route("admin.dashboard") }}"
                @endif
            ><i class="fas fa-fire"></i> <span>Dashboard</a>
        </li>
            @if (Auth::user()->role_id == 3)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-eye"></i> <span>Pengunjung</span></a>
                    <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route("visitors.index") }}">Daftar Pengunjung</a></li>
                    </ul>
                </li>
            @endif
            @if (Auth::user()->role_id == 3)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Users</span></a>
                    <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route("users.userList") }}">Daftar User</a></li>
                    <li><a class="nav-link" href="{{ route("users.eoList") }}">Daftar Event Organizer</a></li>
                    <li><a class="nav-link" href="{{ route("users.adminList") }}">Daftar Admin</a></li>
                    </ul>
                </li>
            @endif
            @if (Auth::user()->role_id == 3)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-tags"></i> <span>Kategori</span></a>
                    <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route("categories.index") }}">Daftar Kategori</a></li>
                    </ul>
                </li>
            @endif
            @if (Auth::user()->role_id == 3)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list-ol"></i> <span>Status</span></a>
                    <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route("status.index") }}">Daftar Status</a></li>
                    </ul>
                </li>
            @endif
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-pencil-alt"></i> <span>Artikel</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route("articles.index") }}">Daftar Artikel</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>