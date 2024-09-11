{{-- <div class="collapse navbar-collapse" id="navbarNav"> --}}
{{-- <div id="sidebar" >
    <!-- Sidebar content -->
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav ">
                    <a class="nav-link" href="{{ route('admin.index') }}">
                        <div class="sb-nav-link-icon">
                            <div class="text_colour"> <i class="fas fa-tachometer-alt"></i></div>
                        </div>
                        <div >Dashboard</div>
                    </a>
                    <a class="nav-link" href="{{ route('usertable') }}">
                        <div class="sb-nav-link-icon">
                            <div class="text_colour"><i class="fas fa-users"></i></div>
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
                            <a class="nav-link" href="">Food</a>
                            <a class="nav-link" href="">Assecories</a>
                        </nav>
                    </div>

                </div>
            </div>
        </nav>
        
    </div>
</div> --}}
{{-- </div> --}}
<div id="sidebar">
    <!-- Sidebar content -->
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <ul class="nav">
                    <!-- Dashboard Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.index') }}" style="color: black;">
                            <i class="fas fa-tachometer-alt" style="margin-right: 8px;"></i>
                            Dashboard
                        </a>
                    </li>

                    <!-- Users Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('usertable') }}" style="color: black;">
                            <i class="fas fa-users" style="margin-right: 8px;"></i>
                            Users
                        </a>
                    </li>

                    <!-- Post Tables Section -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" style="color: black;">
                            <i class="fas fa-columns" style="margin-right: 8px;"></i>
                            Post Tables
                            <i class="fas fa-angle-down"></i>
                        </a>
                        <div class="collapse" id="collapseLayouts">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/viewpost" style="color: black;">
                                        <i class="fas fa-file-alt" style="margin-right: 8px;"></i>
                                        Posts
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/displaycatagory" style="color: black;">
                                        <i class="fas fa-tag" style="margin-right: 8px;"></i>
                                        Category
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/displaybreed" style="color: black;">
                                        <i class="fas fa-dog" style="margin-right: 8px;"></i>
                                        Breed
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Product Tables Section -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProductTables" aria-expanded="false" style="color: black;">
                            <i class="fas fa-columns" style="margin-right: 8px;"></i>
                            Product Tables
                            <i class="fas fa-angle-down"></i>
                        </a>
                        <div class="collapse" id="collapseProductTables">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" style="color: black;">
                                        <i class="fas fa-utensils" style="margin-right: 8px;"></i>
                                        Food
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" style="color: black;">
                                        <i class="fas fa-cube" style="margin-right: 8px;"></i>
                                        Accessories
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
