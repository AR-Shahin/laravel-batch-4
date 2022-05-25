<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <h3>{{ auth()->user()->name }}</h3>
    <hr>
    <table>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>User</th>
            <th>Action</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>
                    {{ $loop->index + 1 }}
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->user->name }}</td>
                <td>
                    @can('view', $product)
                        <a href="{{ route('view',$product->id) }}">View</a>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
