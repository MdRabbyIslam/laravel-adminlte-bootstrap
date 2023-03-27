@extends('adminlte::page')
@section('title', 'Profiles')
@section('content')
    <h1>Profile Settings</h1>

    @if (session()->has('message') )
        <x-adminlte-callout theme="{{ !$errors->any() ?'success':'error'  }}" class="bg-teal" icon="fas fa-lg fa-thumbs-up" title="{{ !$errors->any() ?'Done':'Error'  }}">
            <i class="text-dark">{{ session()->get('message') }}</i>
        </x-adminlte-callout>
    @endif


    <div class="row">
        <div class="col-12 col-sm-6 col-md-4">
            <x-adminlte-profile-widget name="{{ auth()->user()->name }}" desc="Administrator" theme="lightblue"
            img="https://picsum.photos/id/1/100" layout-type="classic">
                <x-adminlte-profile-row-item icon="fas fa-envelope" title="{{ auth()->user()->email }}"
                     badge="teal"/>

            </x-adminlte-profile-widget>
        </div>

        <div class="col-12 col-sm-6 col-md-8">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">

                            @if ( (session()->has('active_tab') && session()->get('active_tab') == 'change_password')  || ($errors->has('password') || $errors->has('new_confirm_password')) )
                                <a class="nav-link " id="custom-tabs-four-profile-tab" data-toggle="pill"
                                href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                aria-selected="false">Profile</a>
                            @else
                                <a class="nav-link active" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                aria-selected="false">Profile</a>
                            @endif

                        </li>
                        <li class="nav-item">
                            @if ( (session()->has('active_tab') && session()->get('active_tab') == 'change_password')  || ($errors->has('password') || $errors->has('new_confirm_password')) )
                                <a class="nav-link active" id="custom-tabs-four-change-password-tab" data-toggle="pill"
                                    href="#custom-tabs-four-change-password" role="tab"
                                    aria-controls="custom-tabs-four-hange-password" aria-selected="false">Change Password</a>
                            @else
                                <a class="nav-link " id="custom-tabs-four-change-password-tab" data-toggle="pill"
                                href="#custom-tabs-four-change-password" role="tab"
                                aria-controls="custom-tabs-four-hange-password" aria-selected="false">Change Password</a>
                            @endif

                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">

                        @if ( (session()->has('active_tab') && session()->get('active_tab') == 'change_password')  || ($errors->has('password') || $errors->has('new_confirm_password')) )
                            <div class="tab-pane fade " id="custom-tabs-four-profile" role="tabpanel"
                            aria-labelledby="custom-tabs-four-profile-tab">
                        @else
                            <div class="tab-pane fade show active" id="custom-tabs-four-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-four-profile-tab">
                        @endif

                            <form method="POST" action="{{ route('change-profile') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{ auth()->user()->name }}">
                                     @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email" value="{{ auth()->user()->email }}">
                                         @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                        @if ( (session()->has('active_tab') && session()->get('active_tab') == 'change_password')  || ($errors->has('password') || $errors->has('new_confirm_password')) )

                        <div class="tab-pane fade show active" id="custom-tabs-four-change-password" role="tabpanel"
                            aria-labelledby="custom-tabs-four-change-password-tab">

                        @else
                        <div class="tab-pane fade " id="custom-tabs-four-change-password" role="tabpanel"
                            aria-labelledby="custom-tabs-four-change-password-tab">
                        @endif

                            <form method="POST" id="change-password-form" action="{{ route('change-password') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" name="current_password" class="form-control" id="current_password" value="{{ old('current_password') }}"
                                        placeholder="Current Password">
                                    @if ($errors->has('current_password'))
                                        <span class="text-danger">{{ $errors->first('current_password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password"  name="new_password" class="form-control" id="new_password" value="{{ old('new_password') }}"
                                        placeholder="new_password">
                                    @if ($errors->has('new_password'))
                                        <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="new_confirm_password">Confirm Password</label>
                                    <input type="password" name="new_confirm_password" class="form-control" id="new_confirm_password"
                                        placeholder="new_confirm_password">
                                    @if ($errors->has('new_confirm_password'))
                                        <span class="text-danger">{{ $errors->first('new_confirm_password') }}</span>
                                    @endif
                                </div>



                                <button type="submit" class="btn btn-primary">Submit</button>

                            </form>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
