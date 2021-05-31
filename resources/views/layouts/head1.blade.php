<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12">
                <div class="float-left">
                    <div class="hamburger sidebar-toggle">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                </div>
                <div class="float-right">
                    <ul>
                        <li class="header-icon dib"><span class="user-avatar">{{Auth::user()->name}} <i class="ti-angle-down f-s-10"></i></span>
                            <div class="drop-down dropdown-profile">
                                
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="{{ route('register') }}"><i class="ti-user"></i> <span>Profile</span></a></li>

                                       <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <li><a onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                <i class="ti-power-off"></i> <span>Logout</span>
                                            </a>
                                        </li>
                                     <form>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>