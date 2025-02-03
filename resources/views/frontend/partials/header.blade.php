<header class="w-100 z-index-1">
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
            <a class="navbar-brand " href="{{ url(route('index')) }}">KSFaisal</a>

            <div class="d-flex align-items-center" id="navbarScroll">
                @guest
                    <ul class="d-flex navbar-nav ms-md-auto my-md-2 my-lg-0 my-0 mx-0 nav_right_menu">
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" href="#loginmodal">
                                <i class="las la-user"></i> Sign In / New Account
                            </a>
                        </li>
                    </ul>
                @else
                    <div class="dropdown">
                        <a href="#" class="align-items-center text-white text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                            <span class="mx-1 text-dark"><b>{{ ucfirst(auth()->user()->username) }}</b></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item text-dark" href="{{ url(route('customer.logout')) }}">Logout</a>
                            </li>
                        </ul>
                    </div>
                @endguest

            </div>
    </nav>
    </div>
    </nav>
</header>
