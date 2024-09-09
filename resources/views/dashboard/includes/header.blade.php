<nav class="sb-topnav navbar ">
<img src="\backend\logo1.png" alt="Photo"  style="width: 100px; height: 48px;">

    <div class="dropdown"  style=" padding: 10px ;">
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
