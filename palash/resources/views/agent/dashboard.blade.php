@extends('layouts.agent_master')


@section('title',"Dashboard")

@section('master_content')

<div class="container mt-2">
    <h3>Name : {{ auth('agent')->user()->name ?? "" }}</h3>
    <h3>Email : {{ auth('agent')->user()->email ?? ""}}</h3>
    <h3>Seller : {{ auth('agent')->user()->seller->name ?? ""}}</h3>
</div>
@stop
