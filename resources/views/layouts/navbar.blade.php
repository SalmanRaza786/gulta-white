<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{route('user.index')}}" class="logo d-flex align-items-center me-auto">
            <img src="{{ URL::asset('build/web/assets/img/logo.jpg')}}" alt="">
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{route('user.index')}}" class="active">Home</a></li>
                <li><a href="{{route('user.gallery')}}">Gallery</a></li>
                <li><a href="{{route('user.blogs')}}">Blogs</a></li>
                <li><a href="{{route('user.about.us')}}">About Us</a></li>
                <li><a href="{{route('user.faq')}}">FAQs</a></li>
                <li><a href="{{route('user.contact.us')}}">Contact US</a></li>
                <li><a class="cursor-pointer" data-bs-target="#contactModal" data-bs-toggle="modal">Review</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>
