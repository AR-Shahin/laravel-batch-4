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
    <h1>Home Page</h1>
    {{-- {{ dd($products) }} --}}
    <form action="/logout" method="POST">
        @csrf
        <button>Logout</button>
    </form>
    <div class="container mt-5">
        <table class="table table-bordered">
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>

            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        <a href="" class="btn btn-success">View</a>
                        <form action="" class="d-inline">
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>
