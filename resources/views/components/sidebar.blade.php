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
                    <li class=""><a href="{{ route('users.menu') }}">Users</a></li>
                </ul>
            </li>
            <li class="">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-icons">menu_book</i>
                    <span class="nav-text">Course</span>
                </a>
                <ul aria-expanded="false">
                    <li class=""><a href="{{ route('course.index') }}">Course List</a></li>
                    <li class=""><a href="{{ route('courseCategory.index') }}">Course Category</a></li>
                </ul>
            </li>
            <li class="">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-icons">forum</i>
                    <span class="nav-text">Manage Forum</span>
                </a>
                <ul aria-expanded="false">
                    <li class=""><a href="{{ route('forum.index') }}">Forum</a></li>
                    <li class=""><a href="{{ route('topic.index') }}">Topic</a></li>
                </ul>
            </li>
            <li class="">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-icons">forum</i>
                    <span class="nav-text">Manage Post</span>
                </a>
                <ul aria-expanded="false">
                    <li class=""><a href="{{ route('forum.index') }}">Forum</a></li>
                    <li class=""><a href="{{ route('topic.index') }}">Topic</a></li>
                </ul>
            </li>
            <li>
                <a class="" href="{{ route('level.index') }}" aria-expanded="false">
                    <i class="material-symbols-outlined">
                        keyboard_arrow_up
                    </i>
                    <span class="nav-text">Level</span>
                </a>
            </li>


            <li><a class="" href="{{ route('logout') }}" aria-expanded="false">
                    <i class="material-symbols-outlined">logout</i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
