@extends('layouts.seller_master')


@section('title',"Dashboard")

@section('master_content')

<div class="container mt-2">
    <h3>Name : {{ auth('seller')->user()->name ?? "" }}</h3>
    <h3>Email : {{ auth('seller')->user()->email ?? ""}}</h3>
</div>
@stop
