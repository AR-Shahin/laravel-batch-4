@extends('layouts.backend_app')

@section('title' ,'Seller Registration')

@section('app_content')
<div class="login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <h3 class="login-box-msg">Seller Registration</h3>

            <form action="{{ route('seller.store') }}" method="post">

                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter Your Name" name="name">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  </div>
                  @error('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Enter Your Email" name="email">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              @error('email')
              <span class="text-danger">{{ $message }}</span>
              @enderror
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter Your Phone" name="phone">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              @error('phone')
              <span class="text-danger">{{ $message }}</span>
              @enderror
              <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder=" Enter Your Password" name="password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              @error('password')
              <span class="text-danger">{{ $message }}</span>
              @enderror
              <div class="row">

                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
              </div>
            </form>

            <p class="mb-0">
              <a href="{{ route('seller.login') }}" class="text-center">Login</a>
            </p>
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
</div>

@stop
