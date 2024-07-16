<div class="page-wrap">
    <div class="app-sidebar colored">
        <div class="sidebar-header">
            <a class="header-brand" href="index.html">
                {{-- <span class="text"> </span> --}}
                <div class="logo-img">
                   <img src="{{asset('template/src/img/pyperLogo.png')}}" class="header-brand-img" alt="lavalite" width="90px"> 
                </div>
            </a>
            <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
            <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
        </div>
        
        <div class="sidebar-content">
            <div class="nav-container">
                <nav id="main-menu-navigation" class="navigation-main">
                    <div class="nav-item active">
                        <a href="{{url('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                    </div>
                    <div class="nav-item has-sub">
                        @if (Auth::user()->roleId==1 || Auth::user()->roleId==2)
                            
                            <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Staff</span> 
                                <span class="badge badge-danger">
                                    @if (Auth::user()->roleId==1)
                                        {{count(App\Models\User::get())}}
                                    @else
                                        {{count(App\Models\User::where('airportId','=', Auth::user()->airportId)->get())}}
                                    @endif
                                </span>
                            </a>
                            <div class="submenu-content">
                                <a href="{{route('staffs.index')}}" class="menu-item">Staff List</a>
                                <a href="{{route('staffs.create')}}" class="menu-item">New Staff</a>
                            </div>
                        @endif
                    </div>
                        <div class="nav-item active">
                            <a href="{{route('ops.create')}}"><i class="ik ik-edit"></i><span>New Operation</span> </a>
                        </div>
                        @if (Auth::user()->roleId==1)
                            <div class="nav-item active">
                                <a href="{{url('procedure')}}"><i class="ik ik-calendar"></i><span>Procedures</span> </a>
                            </div>
                        @endif
                        <div class="nav-item active">
                            <a href="{{route('ops.index')}}"><i class="ik ik-calendar"></i><span>Calendars</span> </a>
                        </div>
                        <div class="nav-item active">
                            <a href="{{url('reports')}}"><i class="ik ik-file-text"></i><span>Health & Safety</span> </a>
                        </div>
                </nav>
            </div>
        </div>
    </div>