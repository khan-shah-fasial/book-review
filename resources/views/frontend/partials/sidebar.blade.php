<div id="bg_theme" class="col-md-3 col-7 width20 bg-light bg_theme">
    <div id="sidebar" class="d-flex sidebar width80">
        <a href="/" class="d-md-block p-md-3 ps-md-3 p-0 link-light" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
            <img class="sidebar_logo" src="/assets/frontend/images/header_logo.svg">
        </a>
        <a class="closebtn" onclick="closeNav()">
            <i class="fa fa-xmark"></i>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start px-2 ps-md-3 pt-md-3 pt-3" id="menu">

            <li class="nav-item">
                <a href="{{ url(route('edit-user-profile')) }}" class="nav-link align-middle px-0">
                    <i class="las la-user-circle"></i>
                    <span class="ms-1 d-sm-inline">Manage Profile</span>
                </a>
            </li>
     
            <li class="nav-item">  
                <a href="{{ url(route('customer.reset_password')) }}" class="nav-link align-middle px-0">
                    <i class="fa fa-pen pe-1"></i>
                    <span class="ms-1 d-sm-inline">Reset Password</span>
                </a>
            </li>

            <li class="nav-item">             
                <a href="{{ route('customer.logout') }}" class="after_login_sign_out nav-link align-middle px-0">
                    <i class="fas fa-right-from-bracket after_login_sign_out pe-1"></i>
                    <span class="ms-1 d-sm-inline after_login_sign_out ">Sign out</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="container-fluid sidebaar_section">
    <div class="">

        
        <div class="col-md-9 width80 p-3 min-vh-100">


