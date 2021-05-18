 <aside class="admin-sidebar">
        <div class="admin-sidebar-brand">
            <!-- begin sidebar branding-->
            <img class="admin-brand-logo" src="{{ asset('assets/img/logo.png') }}" width="40" alt="atmos Logo">
            <span class="admin-brand-content font-secondary"><a href='{{url("/user/home")}}'> {{env('APP_NAME')}}</a></span>
            <!-- end sidebar branding-->
            <div class="ml-auto">
                <!-- sidebar pin-->
                <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle"></a>
                <!-- sidebar close for mobile device-->
                <a href="#" class="admin-close-sidebar"></a>
            </div>
        </div>
        <div class="admin-sidebar-wrapper js-scrollbar">
            @include('User.Layout.sidebar')
        </div>
    </aside>
    <main class="admin-main">
        <header class="admin-header">
            <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>
            <nav class=" mr-auto my-auto">
                <ul class="nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" data-target="#siteSearchModal" data-toggle="modal" href="#">
                            <i class=" mdi mdi-magnify mdi-24px align-middle"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <nav class=" ml-auto">
                <ul class="nav align-items-center">
                    <li class="nav-item">
                        <div class="dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-24px mdi-bell-outline"></i>
                                <span class="notification-counter"></span>
                            </a>
                            <div class="dropdown-menu notification-container dropdown-menu-right">
                                <div class="d-flex p-all-15 bg-white justify-content-between border-bottom ">
                                    <a href="#!" class="mdi mdi-18px mdi-settings text-muted"></a>
                                    <span class="h5 m-0">Notifications</span>
                                    <a href="#!" class="mdi mdi-18px mdi-notification-clear-all text-muted"></a>
                                </div>
                                <div class="notification-events bg-gray-300">
                                    <div class="text-overline m-b-5">today</div>
                                    <a href="#" class="d-block m-b-10">
                                        <div class="card">
                                            <div class="card-body"> <i class="mdi mdi-circle text-success"></i> All systems operational.</div>
                                        </div>
                                    </a>
                                    <a href="#" class="d-block m-b-10">
                                        <div class="card">
                                            <div class="card-body"> <i class="mdi mdi-upload-multiple "></i> File upload successful.</div>
                                        </div>
                                    </a>
                                    <a href="#" class="d-block m-b-10">
                                        <div class="card">
                                            <div class="card-body">
                                                <i class="mdi mdi-cancel text-danger"></i> Your holiday has been denied
                                            </div>
                                        </div>
                                    </a>


                                </div>

                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-sm avatar-online">
                                <span class="avatar-title rounded-circle bg-dark">V</span>
                            </div>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right">
                            <a class="dropdown-item" href="{{ url('user/my-profile') }}"> My Profile </a>
                            <a class="dropdown-item" href="{{ url('user/reset-password') }}"> Reset Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('user/logout') }}"> Logout</a>
                        </div>
                    </li>

                </ul>

            </nav>
        </header>
        <div class="modal fade modal-slide-right" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="demoLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="demoLabel">Demos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe src="https://atmos.atomui.com/demos.html" height="100%" width="100%" frameborder="0"></iframe>
                    </div>
                    <div class="modal-footer">
                        <div class="text-muted"><i class="mdi mdi-information"></i>Demos will open in new tab</div>
                    </div>
                </div>
            </div>
        </div>
