
@extends('layouts.backend_master')
@section('title', 'Category')
@section('master_content')
<div class="container">
    <table id="table_id" class="display">
        <thead>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Agents</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sellers as $seller)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $seller->name }}</td>
                <td>{{ $seller->phone }}</td>
                <td>{{ $seller->agents->count() }}</td>
                <td>
                    <a href="" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                </td>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
@endpush
@push('script')
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script>
   $('#table_id').DataTable();
</script>
@endpush
