<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">Company Name</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">CP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ request()->url() == route('home') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <x-menu-item link="{{ route('home') }}">Home</x-menu-item>
                </ul>
            </li>

            <x-menu-title>Management</x-menu-title>

            <li
                class="dropdown {{ Request::is('user') ? 'active' : '' }} {{ Request::is('user/create') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-solid fa-users"></i>
                    <span>Manage User</span>
                </a>
                <ul class="dropdown-menu">
                    <x-menu-item link="{{ route('user.index') }}">Users</x-menu-item>
                    <x-menu-item link="{{ route('user.create') }}">Create User</x-menu-item>
                </ul>
            </li>

            <li
                class="dropdown {{ Request::is('genre') ? 'active' : '' }} {{ Request::is('genre/create') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Manage Configuration</span>
                </a>
                <ul class="dropdown-menu">
                    <x-menu-item link="{{ route('config') }}">Config</x-menu-item>
                    <x-menu-item link="{{ route('genre.create') }}">Create Genre</x-menu-item>
                    <x-menu-item link="{{ route('server.create') }}">Create Server</x-menu-item>
                    <x-menu-item link="{{ route('quality.create') }}">Create Quality</x-menu-item>
                </ul>
            </li>


            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                <a href="https://getcodiepie.com/docs" onclick="document.getElementById('logOut').submit()"
                    class="btn btn-primary btn-lg btn-block btn-icon-split"><i class="fas fa-rocket"></i>
                    Documentation</a>

                <form class="d-none" id="logOut" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
    </aside>
</div>
