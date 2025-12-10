@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4 text-dark fw-bold">Dashboard</h2>

    <div class="row">
        <!-- Card 1 -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Pengguna</h5>
                            <h2 class="mb-0">{{ $totalUser }}</h2>
                        </div>
                        <i class="fas fa-users fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2 (Contoh) -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Buku</h5>
                            <h2 class="mb-0">0</h2> <!-- Ganti dengan var real nanti -->
                        </div>
                        <i class="fas fa-book fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
