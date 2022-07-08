
@extends('layouts.backend_master')
@section('title', 'Agents')
@section('master_content')
<div class="container mt-3">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('admin.seller') }}" class="btn btn-sm btn-success">Back</a>
            <h4>Seller Name : {{ $seller->name }}</h4>
            <h4>Seller Email : {{ $seller->email }}</h4>
            <h4>Seller Phone : {{ $seller->phone }}</h4>
            <h4>Seller Agents : {{ $seller->agents->count() }}</h4>
        </div>
    </div>
    <table id="table_id" class="display">
        <thead>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($seller->agents as $agent)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $agent->name }}</td>
                <td>{{ $agent->phone }}</td>
                <td>{{ $agent->email }}</td>

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
