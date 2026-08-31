<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <form action="/login" method="POST">
        @csrf

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        

        <h2>Laravel Login</h2>

        <input
            id="email"
            name="email"
            type="email"
            class="form-control mb-2"
            placeholder="Email"
            value="{{ old('email') }}"
            required>

        <input
            id="password"
            name="password"
            type="password"
            class="form-control mb-2"
            placeholder="Password"
            required>

        <button type="submit" class="btn btn-primary">Login</button>

    </form>

    <br>

    <a href="/register" class="btn btn-secondary">Register</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>