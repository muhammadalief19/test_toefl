{{-- <div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/images/logo/icon.png') }}" alt="Logo" srcset="" class="img-fluid"
                            style="width: 100px; height:auto;">
                    </a>
                </div>

            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('packetfull.first') ? 'active' : '' }}">
                    <a href="{{ route('packetfull.first') }}" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical"></i>
                        <span>Data Packet Full Test</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('packetmini.first') ? 'active' : '' }}">
                    <a href="{{ route('packetmini.first') }}" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical"></i>
                        <span>Data Packet Mini Test</span>
                    </a>
                </li>
                <li class="sidebar-item  has-sub {{ request()->routeIs('akun') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-circle"></i>
                        <span>Akun</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="akubadut">Settings</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('logout') }}">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</div> --}}
<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="" href="{{ route('dashboard') }}" aria-expanded="false">
                <i class="material-symbols-outlined">home</i>
                <span class="nav-text">Home</span>
            </a>
            </li>
            <li class="">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-icons">folder</i>
                    <span class="nav-text">Data Packet</span>
                </a>
                <ul aria-expanded="false">
                    <li class=""><a href="{{ route('packetfull.first') }}">Data Packet Full</a></li>
                    <li><a href="{{ route('packetmini.first') }}">Data Packet Mini</a></li>
                </ul>
            </li>
            <li>
                <a class="" href="{{ route('logout') }}" aria-expanded="false">
                    <i class="material-symbols-outlined">
                        logout
                    </i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>
            {{-- <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                <i class="material-symbols-outlined">person</i>
                <span class="nav-text">Teacher</span>
            </a>
            <ul aria-expanded="false">
                <li><a href="teacher.html">Teacher</a></li>
                <li><a href="add-teacher.html">Add New Teacher</a></li>

            </ul>
            </li> --}}
        </ul>
    </div>
</div>
