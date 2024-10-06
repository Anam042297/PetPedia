<nav class="sb-topnav navbar ">

    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <div class="dropdown"  style=" padding: 10px;right:0%">
    <a class="dropdown-toggle profile-toggle" role="button" data-bs-toggle="dropdown">
        <i class="fas fa-user fa-fw"></i> {{ Auth::user()->name }}
    </a>
    <div class="dropdown-menu profile-dropdown-menu">
        
        <a class="dropdown-item" href="{{ route('admin.view') }}">View Profile</a>
        <a class="dropdown-item" href="{{ route('admin.edit') }}">Edit Profile</a>
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="GET">
            @csrf
        </form>
    </div>
</div>

</nav>
