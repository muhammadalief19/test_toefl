@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="profile card card-body px-3 pt-3 pb-0">
            <div class="profile-head">
                <div class="photo-content">
                    <div class="cover-photo rounded"></div>
                </div>
                <div class="profile-info">
                    <div class="profile-photo">
                        <img src="images/profile/profile.png" class="img-fluid rounded-circle" alt="">
                    </div>
                    <div class="profile-details">
                        <div class="profile-name px-3 pt-2">
                            <h4 class="text-primary mb-0">
                                {{ $user->name }}
                            </h4>
                            <p>{{ $user->role->role_name }}</p>
                        </div>
                        <div class="profile-email px-2 pt-2">
                            <h4 class="text-muted mb-0">
                                {{ $user->email }}
                            </h4>
                            <p>Email</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card h-auto">
            <div class="card-body">
                <div class="profile-tab">
                    <div class="custom-tab-1">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a href="#about-me" data-bs-toggle="tab" class="nav-link active show">About Me</a>
                            </li>
                            <li class="nav-item"><a href="#profile-settings" data-bs-toggle="tab" class="nav-link">Profile</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="about-me" class="tab-pane fade active show">
                                <div class="profile-personal-info mt-3">
                                    <h5 class="text-primary mb-4">Personal Information</h5>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Name <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ $user->name }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Email <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="profile-settings" class="tab-pane fade">
                                <div class="pt-3">
                                    <div class="settings-form">
                                        <h5 class="text-primary">Profile Setting</h5>
                                        <form method="POST" action="{{ route('users.update', ['id' => $user->_id]) }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" placeholder="Name" class="form-control" name="name" value="{{ $user->name }}">
                                            </div>
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" name="email" placeholder="Email" class="form-control" value="{{ $user->email }}">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" name="password" placeholder="Password" class="form-control">
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
