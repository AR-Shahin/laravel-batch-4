@extends('layouts.admin_app')

@section('app_content')
    <div class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b>Admin</b>LTE</a>
                <h6>Admin Forgot password</h6>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    @error('email')
                        {{ $message }}
                    @enderror

                    @if (session('status'))
                        {{ session('status') }}
                    @endif
                    <form action="{{ route('admin.password.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" name="email"
                                value="{{ old('email', $request->email) }}" readonly>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="my-2">
                            <input type="text" class="form-control" name="password" placeholder="Password">
                        </div>

                        <div class="my-2">
                            <input type="text" class="form-control" name="password_confirmation" placeholder="Password">
                        </div>
                        <div class="row">

                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>


                    <!-- /.social-auth-links -->


                    <p class="mb-0">
                        <a href="register.html" class="text-center">Register a new membership</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
@stop
