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
                    <li><a href="{{ route('target.index') }}">Data Target User</a></li>
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
                    <i class="material-icons">quiz</i>
                    <span class="nav-text">Quiz</span>
                </a>
                <ul aria-expanded="false">
                    <li class=""><a href="{{ route('quiz.index') }}">Quiz List</a></li>
                    <li class=""><a href="{{ route('quizType.index') }}">Quiz Type</a></li>
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
                    <li class=""><a href="{{ route('module.index') }}">Course Module</a></li>
                    <li class=""><a href="{{ route('materialType.index') }}">Course Material Type</a></li>
                    <li class=""><a href="{{ route('material.index') }}">Course Material</a></li>
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
            <li>
                <a class="" href="{{ route('level.index') }}" aria-expanded="false">
                    <i class="material-symbols-outlined">
                        keyboard_arrow_up
                    </i>
                    <span class="nav-text">Level</span>
                </a>
            </li>
            <li>
                <a class="" href="{{ route('config.index') }}" aria-expanded="false">
                    <i class="material-symbols-outlined">
                        settings
                    </i>
                    <span class="nav-text">Config</span>
                </a>
            </li>
            <li>
                <a class="" href="{{ route('activityLog.index') }}" aria-expanded="false">
                    <i class="material-symbols-outlined">
                        schedule
                    </i>
                    <span class="nav-text">Activity Log</span>
                </a>
            </li>
            <li>
                <a class="" href="{{ route('payment.index') }}" aria-expanded="false">
                    <i class="material-symbols-outlined">
                        payments
                    </i>
                    <span class="nav-text">Payment</span>
                </a>
            </li>
            <li>
                <a class="" href="{{ route('assessment.index') }}" aria-expanded="false">
                    <i class="material-symbols-outlined">
                        settings_accessibility
                    </i>
                    <span class="nav-text">Assessment</span>
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
