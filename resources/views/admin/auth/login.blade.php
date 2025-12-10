<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - TobaReads</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #457B9D;
            /* Warna TobaReads */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-login {
            width: 100%;
            max-width: 400px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .card-header {
            background-color: #2A486B;
            /* Warna Gelap TobaReads */
            color: white;
            text-align: center;
            padding: 25px;
            border-bottom: none;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 700;
        }

        .card-body {
            background: white;
            padding: 40px 30px;
        }

        .btn-primary {
            background-color: #2A486B;
            border-color: #2A486B;
            padding: 12px;
            font-weight: bold;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #1d344f;
            border-color: #1d344f;
        }

        .form-control:focus {
            border-color: #457B9D;
            box-shadow: 0 0 0 0.25rem rgba(69, 123, 157, 0.25);
        }

        .input-group-text {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>

    <div class="card card-login">
        <div class="card-header">
            <h4><i class="fas fa-book-reader me-2"></i>Admin Panel</h4>
            <small>TobaReads Management</small>
        </div>
        <div class="card-body">

            <!-- Menampilkan Pesan Error -->
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Form Login -->
            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label text-muted">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope text-secondary"></i></span>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="admin@example.com" required autofocus value="{{ old('email') }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label text-muted">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock text-secondary"></i></span>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="••••••••" required>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        MASUK
                    </button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center py-3 bg-light text-muted" style="font-size: 0.85rem;">
            &copy; {{ date('Y') }} Kelompok 4 - TobaReads
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
