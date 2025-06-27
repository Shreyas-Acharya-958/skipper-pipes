<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - @yield('title', 'Login')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @stack('styles')
</head>

<body class="login-body">
    <div class="login-card">
        <div class="login-logo">
            <img src="https://i.imgur.com/4M34hi2.png" alt="Logo">
            <span>Admin Login</span>
        </div>
        @yield('content')
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg">Login</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
