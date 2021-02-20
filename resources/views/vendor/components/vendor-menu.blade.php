

<div id="main-wrapper">
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <div class="navbar-collapse">
                <ul class="navbar-nav mr-auto mt-md-0">
                    <li class="nav-item "> <a class="nav-link nav-toggler  hidden-md-up  waves-effect waves-dark" href="javascript:void(0)"><i class="fas  fa-bars"></i></a></li>
                    <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="fas fa-bars"></i></a> </li>
                    <li class="nav-item mt-3">Vendor</li>
                </ul>
                <ul class="navbar-nav my-lg-0">
                    <li class="nav-item">
                    <a class="btn btn-sm btn-danger" href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                     </a>

                     <form id="logout-form" action="{{ route('vendor.logout') }}" method="POST" class="d-none">
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
                    <li> <a href="#"><span> <i class="fas fa-user"></i> </span><span class="hide-menu">Profile</span></a></li>
                    <li> <a href="{{ route('admin.ordeIndex')}}"><span> <i class="fas fa-cart-arrow-down"></i> </span><span class="hide-menu">Order Manage</span></a></li>
                    <li> <a href="{{ route('vendor.products') }}"><span> <i class="fas fa-plus-circle"></i> </span><span class="hide-menu">Products</span></a></li>
                    <li> <a href="#"><span> <i class="fas fa-mail-bulk"></i> </span><span class="hide-menu">Contact</span></a></li>
                </ul>
            </nav>
        </div>
    </aside>
    <div class="page-wrapper">
