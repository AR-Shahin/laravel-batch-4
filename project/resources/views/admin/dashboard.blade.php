@extends('layouts.admin_master')

@section('title', 'Dashboard')


@section('master_content')

    <h2>Dashboard</h2>
    <h5>Hello , {{ auth('admin')->user()->name }}</h5>

    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button class="btn btn-sm btn-success">Logout</button>
    </form>
@stop
