
<div id="sidebar" class="sidebar">
    <!-- Sidebar content -->
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="{{ route('admin.index') }}">
                        <div class="sb-nav-link-icon"><div class="text_colour"> <i class="fas fa-tachometer-alt"></i></div></div>
                        <div class="text_colour">Dashboard</div>
                    </a>
                    <a class="nav-link" href="{{ route('usertable') }}">
                        <div class="sb-nav-link-icon"><div class="text_colour"><i class="fas fa-user"></i></div></div>
                        <div class="text_colour"> Users</div>
                    </a>
                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><div class="text_colour"><i class="fas fa-columns"></i></div></div>
                        <div class="text_colour">Post Tables</div>
                        <div class="sb-sidenav-collapse-arrow"><div class="text_colour"><i class="fas fa-angle-down"></i></div></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/admin/viewpost">Posts</a>
                            <a class="nav-link" href="/admin/displaycatagory">Category</a>
                            <a class="nav-link" href="/admin/displaybreed">Breed</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseLayout"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><div class="text_colour"><i class="fas fa-columns"></i></div></div>
                        <div class="text_colour"> Product Tables</div>
                        <div class="sb-sidenav-collapse-arrow"><div class="text_colour"><i class="fas fa-angle-down"></i></div></div>
                    </a>
                    <div class="collapse" id="collapseLayout" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            {{-- <a class="nav-link" href="/admin/viewpost"> Pet Posts</a>
                            <a class="nav-link" href="/admin/displaycatagory"> Pet Category</a>
                            <a class="nav-link" href="/admin/displaybreed">Pet Breed</a> --}}
                        </nav>
                    </div>

                </div>
            </div>

        </nav>
    </div>
</div>
