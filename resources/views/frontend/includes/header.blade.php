<!-- Navbar Start -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
        <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
            <h3 style="color: #ED6436">PetPedia</h3>
            <div class="navbar-nav mr-auto py-0">
                <a href="{{ route('home') }}" class="nav-item nav-link">Home</a>
                <a href="{{ route('mart') }}" class="nav-item nav-link">Mart</a>
                <a href="{{ route('booking') }}" class="nav-item nav-link">Booking</a>
                <a href="{{ route('blog') }}" class="nav-item nav-link">Blog</a>
                <a href="{{ route('about') }}" class="nav-item nav-link">About Us</a>
            </div>
          <!-- Other navigation items -->
        </div>
        @guest
        <div >
            <form action="{{ route('login') }}" method="GET">
                <button class="btn btn-primary py-1 px-3"  type="submit" class="search-button">Login</button>
            </form>
        </div>
        @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle"  role="button" data-toggle="dropdown">
                <i class="fas fa-user fa-fw"></i>{{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
        @endguest
        <p style="color: #181818;"><&nbsp></p>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </nav>
</div>
<!-- Navbar End -->
