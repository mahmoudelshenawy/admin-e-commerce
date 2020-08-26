    <!-- START: Header-->
    <div id="header-fix" class="header fixed-top">
        <nav class="navbar navbar-expand-lg  p-0">
            <div class="navbar-header h4 mb-0 align-self-center d-flex">  
                <a href="index.html" class="horizontal-logo align-self-center d-flex d-lg-none">
                    <img src="{{ asset('dist/images/money.png') }}" alt="logo" width="23" class="img-fluid"/> <span class="h5 align-self-center mb-0 ">E-commerce</span>              
                </a>
                <a href="#" class="sidebarCollapse ml-2" id="collapse"><i class="icon-menu body-color"></i></a>
            </div>
            <div class="d-inline-block position-relative">
                <button data-toggle="dropdown" aria-expanded="false" class="btn btn-primary p-2 rounded mx-3 h4 mb-0 line-height-1 d-none d-lg-block">
                    <span class="text-white font-weight-bold h4">+</span></button>
                <div class="dropdown-menu left p-0">
                    <a href="" class="dropdown-item px-2">Create Page</a>
                    <a href="" class="dropdown-item px-2">Add New User</a>
                    <a href="" class="dropdown-item px-2">New Campain</a>
                    <div class="dropdown-divider"></div>
                    <a href="" class="dropdown-item px-2 text-danger">Generate Reports</a>
                </div>
            </div>

            <form class="float-left d-none d-lg-block search-form">
                <div class="form-group mb-0 position-relative">
                    <input type="text" class="form-control border-0 rounded bg-search pl-5" placeholder="Search anything...">
                    <div class="btn-search position-absolute top-0">
                        <a href="#"><i class="h5 icon-magnifier body-color"></i></a>
                    </div>
                    <a href="#" class="position-absolute close-button mobilesearch d-lg-none" data-toggle="dropdown" aria-expanded="false"><i class="icon-close h5"></i>                               
                    </a>

                </div>
            </form>
            <div class="navbar-right ml-auto">
                <ul class="ml-auto p-0 m-0 list-unstyled d-flex">
                    <li class="mr-1 d-inline-block my-auto d-block d-lg-none">
                        <a href="#" class="nav-link px-2 mobilesearch" data-toggle="dropdown" aria-expanded="false"><i class="icon-magnifier h4"></i>                               
                        </a>
                    </li>                        
                    <li class="mr-1 d-inline-block my-auto">
                        <div id="options" data-input-name="country2"  data-selected-country="US"></div>
                    </li>
                    <li class="dropdown align-self-center mr-1">
                        <a href="#" class="nav-link px-2" data-toggle="dropdown" aria-expanded="false"><i class="icon-reload h4"></i>
                            <span class="badge badge-default"> <span class="ring">
                                </span><span class="ring-point">
                                </span> </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right border  py-0">
                            <li>
                                <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                    <div class="media">
                                        <img src="{{ asset('dist/images/author.jpg') }}" alt="" class="d-flex mr-3 img-fluid rounded-circle">
                                        <div class="media-body">
                                            <h6 class="mb-0">john</h6>
                                            <span class="text-warning">New user registered.</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                    <div class="media">
                                        <img src="{{ asset('dist/images/author2.jpg') }}" alt="" class="d-flex mr-3 img-fluid rounded-circle">
                                        <div class="media-body">
                                            <h6 class="mb-0">Peter</h6>
                                            <span class="text-success">Server #12 overloaded.</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                    <div class="media">
                                        <img src="{{ asset('dist/images/author3.jpg') }}" alt="" class="d-flex mr-3 img-fluid rounded-circle">
                                        <div class="media-body">
                                            <h6 class="mb-0">Bill</h6>
                                            <span class="text-danger">Application error.</span>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li><a class="dropdown-item text-center py-2" href="#"> <strong>See All Tasks <i class="icon-arrow-right pl-2 small"></i></strong></a></li>
                        </ul>

                    </li>
                    <li class="dropdown align-self-center mr-1 d-inline-block">
                        <a href="#" class="nav-link px-2" data-toggle="dropdown" aria-expanded="false"><i class="icon-bell h4"></i>
                            <span class="badge badge-default"> <span class="ring">
                                </span><span class="ring-point">
                                </span> </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right border   py-0">
                            <li>
                                <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="{{ url('lang/ar') }}"><i class="fa fa-flag"></i> عربى
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="{{ url('lang/en') }}"><i class="fa fa-flag"></i>English                                </a>
                            </li>
                            {{-- <li >
                                <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                    <div class="media">
                                        <img src="dist/images/author2.jpg" alt="" class="d-flex mr-3 img-fluid rounded-circle">
                                        <div class="media-body">
                                            <h6 class="mb-0 text-danger">Peter send a message</h6>
                                            15 min ago
                                        </div>
                                    </div>
                                </a>
                            </li> --}}
                            {{-- <li >
                                <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                    <div class="media">
                                        <img src="dist/images/author3.jpg" alt="" class="d-flex mr-3 img-fluid rounded-circle">
                                        <div class="media-body">
                                            <h6 class="mb-0 text-warning">Bill send a message</h6>
                                            5 min ago
                                        </div>
                                    </div>
                                </a>
                            </li> --}}

                            {{-- <li><a class="dropdown-item text-center py-2" href="#"> <strong>Read All Message <i class="icon-arrow-right pl-2 small"></i></strong></a></li> --}}
                        </ul>
                    </li>
                    <li class="dropdown user-profile d-inline-block py-1 mr-2">
                        <a href="#" class="nav-link px-2 py-0" data-toggle="dropdown" aria-expanded="false"> 
                            <div class="media">
                                <div class="media-body align-self-center d-none d-sm-block mr-2">
                                    <p class="mb-0 text-uppercase line-height-1"><b>John Deo</b><br/><span> Admin </span></p>

                                </div>
                                <img src="{{ asset('dist/images/author.jpg') }}" alt="" class="d-flex img-fluid rounded-circle" width="45">

                            </div>
                        </a>

                        <div class="dropdown-menu  dropdown-menu-right p-0">
                            <a href="" class="dropdown-item px-2 align-self-center d-flex">
                                <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                            <a href="" class="dropdown-item px-2 align-self-center d-flex">
                                <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                            <div class="dropdown-divider"></div>
                            <a href="" class="dropdown-item px-2 align-self-center d-flex">
                                <span class="icon-support mr-2 h6  mb-0"></span> Help Center</a>
                            <a href="" class="dropdown-item px-2 align-self-center d-flex">
                                <span class="icon-globe mr-2 h6 mb-0"></span> Forum</a>
                            <a href="" class="dropdown-item px-2 align-self-center d-flex">
                                <span class="icon-settings mr-2 h6 mb-0"></span> Account Settings</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('admin/logout') }}" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                        </div>

                    </li>

                </ul>
            </div>
        </nav>
    </div>
    <!-- END: Header-->