<!DOCTYPE html>
<html lang="id">

<head>
    <title>Admin - TobaReads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button class="btn btn-sm btn-outline-light">Logout</button>
        </form>
    </nav>

    <div class="p-4">
        @yield('content')
    </div>

</body>

</html>
