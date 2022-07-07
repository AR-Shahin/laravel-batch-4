
@extends('layouts.seller_master')
@section('title', 'Post')
@push('css')
{{-- <x-utility.data-table-css/> --}}
@endpush
@section('master_content')
<div class="card">
    <div class="card-header ">
        <div class="d-flex justify-content-between">
        <h4 class="card-title">Create Agent</h4>
        <a href="{{ route('seller.agent.index') }}" class="btn btn-success btn-sm"><i class="fa fa-back"></i> Back</a>
        </div>

    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-5">
                <form action="{{ route('seller.agent.store') }}" method="POST">
                    @csrf
                    <div class="my-2">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter name">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="my-2">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                    </div>
                    <div class="my-2">
                        <button class="btn btn-sm btn-block btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


