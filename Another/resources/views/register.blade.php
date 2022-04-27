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
    <h1>Register Page</h1>
    <div class="container">
        <form action="/store" method="POST">
            @csrf
            <input type="text" class="form-control" name="name" placeholder="name" value="{{ old('name') }}">
            <br>
            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
            <br>
            <input type="password" class="form-control" name="password" placeholder="password"
                value="{{ old('password') }}">

            <button class="btn btn-sm btn-success">Register</button>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>
