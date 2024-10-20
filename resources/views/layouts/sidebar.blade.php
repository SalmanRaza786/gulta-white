
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">

            <a href="{{url('/')}}" class="logo logo-light">
            <span class="logo-sm">
             <img src="{{ URL::asset('build/images/logo-light.png')}}" alt="" height="22">
            </span>
                <span class="logo-lg">
          <img src="{{ URL::asset('build/images/logo-light.png')}}" alt="" height="17">
            </span>
            </a>

        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.menu')</span></li>




                    <li class="nav-item">
                        <a class="nav-link menu-link {{ (Route::currentRouteName()=='admin.products.index')?'active':''}}" href="{{route('admin.products.index')}}" >
                            <i class="ri-price-tag-2-fill"></i> <span> Products</span>
                        </a>
                    </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Route::currentRouteName()=='admin.products.codes')?'active':''}}" href="{{route('admin.products.codes')}}" >
                        <i class="ri-cactus-fill"></i> <span> Product Codes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Route::currentRouteName()=='admin.products.codes')?'active':''}}" href="{{route('admin.codes.print')}}" >
                        <i class="ri-printer-cloud-fill"></i> <span>Print Codes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Route::currentRouteName()=='admin.products.codes')?'active':''}}" href="{{route('admin.attempt.codes')}}" >
                        <i class="ri-parent-fill"></i> <span>Attempts</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Route::currentRouteName()=='admin.products.codes')?'active':''}}" href="{{route('admin.message.index')}}" >
                        <i class="ri-message-2-fill"></i> <span>Messages</span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>
