

<div id="main-wrapper">
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <div class="navbar-collapse">
                <ul class="navbar-nav mr-auto mt-md-0">
                    <li class="nav-item "> <a class="nav-link nav-toggler  hidden-md-up  waves-effect waves-dark" href="javascript:void(0)"><i class="fas  fa-bars"></i></a></li>
                    <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="fas fa-bars"></i></a> </li>
                    <li class="nav-item mt-3">ADMIN</li>
                </ul>
                <ul class="navbar-nav my-lg-0">
                    <li class="nav-item">
                    <a class="btn btn-sm btn-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                     </a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
                     </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="left-sidebar">
        <div class="scroll-sidebar">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="nav-devider mt-0" style="margin-bottom: 5px"></li>
                    <li> <a href="{{ route('admin.home') }}"><span> <i class="fas fa-home"></i> </span><span class="hide-menu">Home</span></a></li>
                    <li> <a href="#"><span> <i class="fas fa-user"></i> </span><span class="hide-menu">Admin</span></a></li>
                    <li> <a href="#"><span> <i class="fas fa-users"></i> </span><span class="hide-menu">Vendor</span></a></li>
                    <li> <a href="#"><span> <i class="fas fa-mail-bulk"></i> </span><span class="hide-menu">Contact</span></a></li>
                    <li> <a href="{{ route('admin.categories') }}"><span> <i class="fas fa-server"></i> </span><span class="hide-menu">Category</span></a></li>
                    <li> <a href="{{ route('admin.brands') }}"><span> <i class="fas fa-suitcase"></i> </span><span class="hide-menu">Brand</span></a></li>
                    <li> <a href="{{ route('admin.products') }}"><span> <i class="fas fa-plus-circle"></i> </span><span class="hide-menu">Products</span></a></li>
                    <li> <a href="{{ route('admin.slider') }}"><span> <i class="fas fa-image"></i> </span><span class="hide-menu">Slider</span></a></li>
                    <li> <a href="#"><span> <i class="fas fa-cog"></i> </span><span class="hide-menu">Generale Settings</span></a></li>
                    <li> <a href="#"><span> <i class="fas fa-thumbs-up"></i> </span><span class="hide-menu">Social Settings</span></a></li>

                </ul>
            </nav>
        </div>
    </aside>
    <div class="page-wrapper">
