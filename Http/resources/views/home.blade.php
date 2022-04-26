<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Hello, world!</title>
</head>

<body>

    <div class="container mt-5">
        <a href="/create" class="btn btn-sm btn-warning">Create</a>
        <form action="/logout" method="POST">
            @csrf
            <button class="btn btn-info">Logout</button>
        </form>
        <table class="table table-bordered">
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>


            {{-- {{ dd($products) }} --}}
            @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        {{ $product->name }}
                    </td>
                    <td>
                        <a href="" class="btn btn-sm btn-success">View</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>
