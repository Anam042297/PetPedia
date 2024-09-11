{{-- <div class="collapse navbar-collapse" id="navbarNav"> --}}
<div id="sidebar">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.index') }}" style="color: black;">
                            <i class="fas fa-home mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('usertable') }}" style="color: black;">
                            <i class="fas fa-users mr-2" ></i>
                            Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" style="color: black;">
                            <i class="fas fa-th mr-2" ></i>
                            Post Tables
                            <i class="fas fa-angle-down ml-2"></i>
                        </a>
                        <div class="collapse" id="collapseLayouts">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/viewpost" style="color: black;">
                                        <i class="fas fa-file-alt mr-2"></i>
                                        Posts
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/displaycatagory" style="color: black;">
                                        <i class="fas fa-tag mr-2" ></i>
                                        Category
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/displaybreed" style="color: black;">
                                        <i class="fas fa-dog mr-2" ></i>
                                        Breed
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProductTables" aria-expanded="false" style="color: black;">
                            <i class="fas fa-th mr-2" ></i>
                            Product Tables
                            <i class="fas fa-angle-down ml-2"></i>
                        </a>
                        <div class="collapse" id="collapseProductTables">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" style="color: black;">
                                        <i class="fas fa-drumstick-bite mr-2"></i>
                                        Food
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" style="color: black;">
                                        <i class="fas fa-cube mr-2" ></i>
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
{{-- </div> --}}