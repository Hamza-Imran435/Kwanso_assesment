<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="{{ route('dashboard') }}" target="_blank">
            <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26"
                alt="main_logo">
            <span class="ms-1 text-sm text-dark">Kwanso</span>
        </a>
    </div>

    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('dashboard') }}">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @if (auth()->check() && auth()->user()->hasPermission('send-invites'))
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('invitations.index') }}">
                        <i class="material-symbols-rounded opacity-5">person_add</i>
                        <span class="nav-link-text ms-1">Invites</span>
                    </a>
                </li>
            @endif
            @if (auth()->check() && auth()->user()->hasPermission('manage-customers'))
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('client.index') }}">
                        <i class="material-symbols-rounded opacity-5">person</i>
                        <span class="nav-link-text ms-1">Clients</span>
                    </a>
                </li>
            @endif
            @if (auth()->check() && auth()->user()->hasPermission('view-task'))
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('task.index') }}">
                        <i class="material-symbols-rounded opacity-5">task</i>
                        <span class="nav-link-text ms-1">Task</span>
                    </a>
                </li>
            @endif
            @if (auth()->check() && auth()->user()->hasPermission('manage-roles&permissions'))
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('role.permissions.index') }}">
                        <i class="material-symbols-rounded opacity-5">view_in_ar</i>
                        <span class="nav-link-text ms-1">Roles & Permissions</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>
