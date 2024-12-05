<header>
    <div class="header-area">
        <div id="sticky-header" class="main-header-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-3">
                        <div class="logo">
                            <img src="{{ asset('userside/img/logo.png') }}" alt="logo" style="width: 150px; height: 80px;">
                        </div>
                    </div>

                    <div class="col-xl-9 col-lg-9">
                        <div class="main-menu d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a href="/">Home</a></li>
                                    
                                    @php $categories = \App\Models\Category::all(); @endphp
                                    <li>
                                        <a href="#">Pet Blogs <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            @foreach($categories as $category)
                                                <li><a href="{{ route('category.posts', $category->id) }}">{{ $category->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>

    @php $categories = \App\Models\Category::all(); @endphp
    <li>
        <a href="#">Pet Mart <i class="ti-angle-down"></i></a>
        <ul class="submenu">
            @foreach($categories as $category)
                <li><a href="{{ route('category.products', $category->id) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </li>
    <li class="nav-item">
        <a href="{{ route('cart.index') }}" class="nav-link">
            <i class="fas fa-shopping-cart mr-2" style="font-size: 1.0rem;"></i>Cart
        </a>
    </li>
                                    <li>
                                        @auth
                                            <a href="#">
                                                 {{ Auth::user()->name }} <i class="ti-angle-down"></i>
                                            </a>
                                            <ul class="submenu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                       Logout
                                                    </a>
                                                </li>
                                                @php $user = auth()->user(); @endphp

                                                <li><a href="{{ route('userprofile.view',['id' => $user->id]) }}">View Profile</a></li>
                                            </ul>
                                            <!-- Logout Form -->
                                            <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                                @csrf
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}">Login </a>
                                            <ul class="submenu">
                                                <li><a href="{{ route('register') }}">Register</a></li>
                                            </ul>
                                        @endauth
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <!-- Mobile Menu Section -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
