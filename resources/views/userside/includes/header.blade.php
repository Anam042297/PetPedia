<header>
    <div class="header-area">
        <div id="sticky-header" class="main-header-area">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Logo Section -->
                    <div class="col-xl-3 col-lg-3">
                        <div class="logo">
                            <img src="{{ asset('userside/img/logo.png') }}" alt="logo" style="width: 150px; height: 80px;">
                        </div>
                    </div>

                    <!-- Main Menu Section -->
                    <div class="col-xl-9 col-lg-9">
                        <div class="main-menu d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a href="/">Home</a></li>

                                    <!-- Pet Blogs Dropdown -->
                                    @php $categories = \App\Models\Category::all(); @endphp
                                    <li>
                                        <a href="#">Pet Blogs <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            @foreach($categories as $category)
                                                <li><a href="{{ route('category.posts', $category->id) }}">{{ $category->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>


                                    <!-- Shop Dropdown -->
            
                                    @php $categories = \App\Models\Category::all(); @endphp
                                    <li>
                                        <a href="#">Pet Mart<i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            @foreach($categories as $category)
                                            <li><a href="{{ route('products.byCategory', $category->id) }}">{{ $category->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>



                                    {{-- @php $categories = \App\Models\Category::all(); @endphp
<li>
    <a href="#">Pet Mart <i class="ti-angle-down"></i></a>
    <ul class="submenu">
        @foreach($categories as $category)
            <li>
                <a href="#">{{ $category->name }} <i class="ti-angle-down"></i></a>
                @php
                      $productCategories = \App\Models\Category::all();
                @endphp
               
                    <ul class="submenu">
                        @foreach($productCategories as $productCategory)
                            <li><a href="{{ route('products.byCategory', $productCategory->id) }}">{{ $productCategory->name }}</a></li>
                        @endforeach
                    </ul>
               
            </li>
        @endforeach
    </ul>
</li> --}}

                                    
                                    {{-- <li class="nav-item">
                                    </li>

                                    <!-- Cart Dropdown -->
                                    <li class="nav-item">
                                        <a href="{{ route('cart.index') }}">
                                             Cart <i class="ti-angle-down"></i>
                                        </a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="{{ route('cart.index') }}">
                                                    Items in Cart:
                                                    <div class="cart-icon">
                                                        @if(auth()->check())
                                                            @php
                                                                $cart = auth()->user()->cart;
                                                                $cartItemCount = $cart && $cart->items ? $cart->items->sum('quantity') : 0;
                                                            @endphp
                                                            <span id="cart-icon">{{ $cartItemCount }}</span>
                                                        @else
                                                            <span id="cart-icon">0</span>
                                                        @endif
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li> --}}
                                    <li>
                                    <a href="{{ route('shop.index') }}" id="shop-link">Shop</a>
                                    </li> 
                                    <li>
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('cart.index') }}">
                                                {{-- <i class="fas fa-shopping-cart"></i>  --}}
                                                <i class="fas fa-cart-plus">Cart</i>
                                                <div class="cart-icon">
                                                    @if(auth()->check())
                                                        @php
                                                            // Check if the user has a cart and if it has items
                                                            $cart = auth()->user()->cart;
                                                            $cartItemCount = $cart && $cart->items ? $cart->items->sum('quantity') : 0;
                                                        @endphp
                                                        <span id="cart-icon">{{ $cartItemCount }}</span>
                                                    @else
                                                        <!-- If user is not logged in, show 0 -->
                                                        <span id="cart-icon">0</span>
                                                    @endif
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                    </li>

                                    <!-- User Dropdown -->
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
                                                <li><a href="#">View Profile</a></li>
                                            </ul>
                                            <!-- Logout Form -->
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}">Login <i class="ti-angle-down"></i></a>
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
