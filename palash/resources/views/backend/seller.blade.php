
@extends('layouts.backend_master')
@section('title', 'Seller')
@section('master_content')
<div class="container mt-3">
    <h4>Total Seller</h4>
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
                    <a href="{{ route('admin.agents',$seller->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>

                    <form action="{{ route('admin.delete',$seller->id) }}" class="d-inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick=" return confirm('Are you Sure Delete This Data?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                       </form>

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
