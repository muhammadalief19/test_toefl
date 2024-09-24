@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            @if (Session::has('error'))
                <div class="alert alert-danger solid alert-dismissible fade show">
                    <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none"
                        stroke-linecap="round" stroke-linejoin="round" class="me-2">
                        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    <strong>Error!</strong> {{ Session::get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success solid alert-dismissible fade show">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                        fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    <strong>Success!</strong> {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                </div>
            @endif
        </div>
        @foreach ($data['userRoleData'] as $item)
            @if ($item->role_name == 'admin')
                <a href="{{ route('users.index', ['id' => $item->_id]) }}" class="col-xl-4 col-xxl-4 col-sm-6">
                    <div class="col-12">
                        <div class="card counter">
                            <div class="card-body d-flex align-items-center p-4">
                                <div class="card-box-icon me-3 me-xl-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960"
                                        width="30px" fill="#e8eaed">
                                        <path fill="var(--primary)" stroke="var(--primary)"
                                            d="M480-440q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0-80q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0 440q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 152-90.5 276.5T480-80Zm0-400Zm0-315-240 90v189q0 54 15 105t41 96q42-21 88-33t96-12q50 0 96 12t88 33q26-45 41-96t15-105v-189l-240-90Zm0 515q-36 0-70 8t-65 22q29 30 63 52t72 34q38-12 72-34t63-52q-31-14-65-22t-70-8Z" />
                                    </svg>
                                </div>
                                <div class="">
                                    <h5 class="font-w600 1h-1 mb-0">
                                        {{ $item->role_name }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @elseif ($item->role_name == 'instructor')
                <a href="{{ route('users.index', ['id' => $item->_id]) }}" class="col-xl-4 col-xxl-4 col-sm-6">
                    <div class="col-12">
                        <div class="card counter">
                            <div class="card-body d-flex align-items-center p-4">
                                <div class="card-box-icon me-3 me-xl-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960"
                                        width="30px" fill="#e8eaed">
                                        <path fill="#FF4646" stroke="#FF4646"
                                            d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17-62.5t47-43.5q60-30 124.5-46T480-440q67 0 131.5 16T736-378q30 15 47 43.5t17 62.5v112H160Zm320-400q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm160 228v92h80v-32q0-11-5-20t-15-14q-14-8-29.5-14.5T640-332Zm-240-21v53h160v-53q-20-4-40-5.5t-40-1.5q-20 0-40 1.5t-40 5.5ZM240-240h80v-92q-15 5-30.5 11.5T260-306q-10 5-15 14t-5 20v32Zm400 0H320h320ZM480-640Z" />
                                    </svg>
                                </div>
                                <div class="">
                                    <h5 class="font-w600 1h-1 mb-0">
                                        {{ $item->role_name }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @else
                <a href="{{ route('users.index', ['id' => $item->_id]) }}" class="col-xl-4 col-xxl-4 col-sm-6">
                    <div class="col-12">
                        <div class="card counter">
                            <div class="card-body d-flex align-items-center p-4">
                                <div class="card-box-icon me-3 me-xl-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960"
                                        width="30px" fill="#e8eaed">
                                        <path fill="#1eba62" stroke="#1eba62"
                                            d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                                    </svg>
                                </div>
                                <div class="">
                                    <h5 class="font-w600 1h-1 mb-0">
                                        {{ $item->role_name }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
    </div>
@endsection
