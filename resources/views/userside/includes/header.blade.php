<header>
    <div class="header-area ">
       
        <div id="sticky-header" class="main-header-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-3">
                        <div class="logo">
                            
                            <img src="{{ asset('userside/img/logo.png') }}" alt="logo" style="width: 150px; height: 100px;">

                            
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9">
                        <div class="main-menu  d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a  href="/">home</a></li>
                                    @php
                                       $categories = \App\Models\Category::all();
                                    @endphp
                                    <li>
                                        <a href="#">Pet Blogs <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            @foreach($categories as $category)
                                                <li><a href="{{ route('category.posts', $category->id) }} ">{{ $category->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    
                                    @php
                                       $categories = \App\Models\ProductCategory::all();
                                    @endphp
                                    <li>
                                        <a href="#">Shop <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            @foreach($categories as $category)
                                                <li><a href="">{{ $category->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a href="{{ route('cart.index') }}">
                                            <i class="fas fa-shopping-cart"></i> Cart <i class="ti-angle-down"></i>
                                        </a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="{{ route('cart.index') }}">
                                                    Items in Cart:
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
                                    
                                    <li>
                                        @auth
                                            <a href="#">
                                                <i class="fas fa-user"></i>  {{ Auth::user()->name }} <i class="ti-angle-down"></i>
                                            </a>
                                            <ul class="submenu">
                                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                     Logout
                                                 </a></li>
                                                <li><a href="">View Profile</a></li>
                                            </ul>
                                    
                                            <!-- Logout Form -->
                                            <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
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
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>