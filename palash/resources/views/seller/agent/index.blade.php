
@extends('layouts.seller_master')
@section('title', 'Post')
@push('css')
{{-- <x-utility.data-table-css/> --}}
@endpush
@section('master_content')
<div class="card">
    <div class="card-header ">
        <div class="d-flex justify-content-between">
        <h4 class="card-title">Manage Agent</h4>
        <a href="{{ route('seller.agent.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New Agent</a>
        </div>

    </div>
    <div class="card-body">
        <table class="table table-bordered" id="postTable">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $Agent)
                    <tr>
                        <td>{{ $Agent->id }}</td>
                        <td>{{ $Agent->name }}</td>
                        <td>{{ $Agent->email }}</td>
                        <td>{{ $Agent->phone }}</td>
                        <td>
                            <form action="{{ route('seller.agent.delete',$Agent->id) }}" class="d-inline" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('script')
{{-- <x-utility.data-table-js/> --}}
<script>
   $('#postTable').DataTable();

</script>
@endpush
