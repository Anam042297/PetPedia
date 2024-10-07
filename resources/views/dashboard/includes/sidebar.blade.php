{{-- <div class="collapse navbar-collapse" id="navbarNav"> --}}
<div id="sidebar">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav">
            <div class="py-3">
                <img src="\backend\logo1.png" alt="Photo"  style="width: 150px; height: 100px;">
            </div>
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
                                        <i class="fas fa-paw mr-2"></i>
                                        Posts
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/displaycategory" style="color: black;">
                                        <i class="fa-solid fa-layer-group mr-2" ></i>
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
                                    <a class="nav-link" href="/admin/indexproduct" style="color: black;">
                                        <i class="fa-brands fa-product-hunt mr-2"></i>
                                        Products
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/indexproductcategories" style="color: black;">
                                      <i class="fa-solid fa-layer-group mr-2"></i>
                                        Category
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="small">Logged in as:</div>Admin
        </nav>
    </div>
</div>
{{-- </div> --}}