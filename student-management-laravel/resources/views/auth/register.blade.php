<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <h2>Laravel Register</h2>

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form action="/register" method="POST">
        @csrf

        <input
            type="text"
            id="name"
            name="name"
            class="form-control mb-2"
            placeholder="Name"
            value="{{ old('name') }}"
            required>


        <input
            type="email"
            id="email"
            name="email"
            class="form-control mb-2"
            placeholder="Email"
            value="{{ old('email') }}"
            required>

        @error('email')
        <div class="text-danger">{{ $message }}</div><br>
        @enderror

        <input
            type="password"
            id="password"
            name="password"
            class="form-control mb-2"
            placeholder="Password"
            required>


        @error('password')
        <div class="text-danger">{{ $message }}</div><br>
        @enderror

        <button type="submit" class="btn btn-success">Register</button>
    </form>

    <br>

    <a href="/login" class="btn btn-secondary">Login</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>