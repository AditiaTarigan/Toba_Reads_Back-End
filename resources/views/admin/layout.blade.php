<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Admin - TobaReads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #457B9D; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .card { width: 100%; max-width: 400px; border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-primary { background: #2A486B; border: none; }
        .btn-primary:hover { background: #1a304a; }
    </style>
</head>
<body>
    <div class="card p-4">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-dark">Admin Login</h3>
            <p class="text-muted">Masuk untuk mengelola TobaReads</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="admin@example.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="******" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2">Masuk</button>
        </form>
    </div>
</body>
</html>
