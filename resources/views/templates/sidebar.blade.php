<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a class="" href="{{ route('dashboard') }}" aria-expanded="false">
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
            <li class="">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-icons">manage_accounts</i>
                    <span class="nav-text">Manage User</span>
                </a>
                <ul aria-expanded="false">
                    <li class=""><a href="{{ route('userRole.index') }}">Data User Role</a></li>
                </ul>
            </li>
            <li><a class="" href="{{ route('logout') }}" aria-expanded="false">
                    <i class="material-symbols-outlined">logout</i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
