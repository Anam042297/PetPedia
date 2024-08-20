{{-- <div class="collapse navbar-collapse" id="navbarNav"> --}}
<div id="sidebar" class="sidebar">
    <!-- Sidebar content -->
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="{{ route('admin.index') }}">
                        <div class="sb-nav-link-icon">
                            <div class="text_colour"> <i class="fas fa-tachometer-alt"></i></div>
                        </div>
                        <div class="text_colour">Dashboard</div>
                    </a>
                    <a class="nav-link" href="{{ route('usertable') }}">
                        <div class="sb-nav-link-icon">
                            <div class="text_colour"><i class="fas fa-user"></i></div>
                        </div>
                        <div class="text_colour"> Users</div>
                    </a>
                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse"
                        data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon">
                            <div class="text_colour"><i class="fas fa-columns"></i></div>
                        </div>
                        <div class="text_colour">Post Tables</div>
                        <div class="sb-sidenav-collapse-arrow">
                            <div class="text_colour"><i class="fas fa-angle-down"></i></div>
                        </div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link"  href="/admin/viewpost">Posts</a>
                            <a class="nav-link"  href="/admin/displaycatagory">Category</a>
                            <a class="nav-link" href="/admin/displaybreed">Breed</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse"
                        data-bs-target="#collapseLayout" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon">
                            <div class="text_colour"><i class="fas fa-columns"></i></div>
                        </div>
                        <div class="text_colour"> Product Tables</div>
                        <div class="sb-sidenav-collapse-arrow">
                            <div class="text_colour"><i class="fas fa-angle-down"></i></div>
                        </div>
                    </a>
                    <div class="collapse" id="collapseLayout" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/admin/indexproduct">products</a>
                            <a class="nav-link" href="/admin/indexpetcategories">product_categories</a>
                        </nav>
                    </div>

                </div>
            </div>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <div class="text_colour">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user fa-fw"></i>{{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.view') }}">
                            View Profile
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.edit') }}">
                            Edit Profile
                        </a>
                        
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
            
                        <form id="logout-form" action="{{ route('logout') }}" method="Get" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </div>
            </ul>
        </nav>
        
    </div>
</div>
{{-- </div> --}}
