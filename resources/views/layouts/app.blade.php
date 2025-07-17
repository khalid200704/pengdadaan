<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Pengadaan')</title>
        <link rel="icon" type="image/png" href="{{ asset('logo.png') }}?v=2">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
        <style>
            body {
                background: #f8fafc;
                font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif;
            }
            .sidebar {
                min-height: 100vh;
                background: #fff;
                color: #222;
                font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif;
                font-size: 1rem;
            }
            .sidebar .nav-link {
                color: #222;
                font-weight: 500;
                font-size: 1rem;
            }
            .sidebar .nav-link.active, .sidebar .nav-link:hover {
                background: #f1f5f9;
                color: #2563eb;
            }
            .sidebar .sidebar-title {
                font-size: 1.3rem;
                font-weight: bold;
                letter-spacing: 1px;
                color: #222;
                margin-bottom: 2rem;
            }
            .logout-btn {
                color: #dc3545;
                font-weight: 500;
                font-size: 1rem;
                border: none;
                background: none;
                width: 100%;
                text-align: left;
                padding: 0.75rem 1rem;
            }
            .logout-btn:hover {
                background: #fef2f2;
                color: #dc3545;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar Offcanvas Trigger (Mobile Only) -->
                <button class="btn btn-primary d-md-none m-2 position-fixed z-3 p-2 rounded-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas" style="bottom:10px;left:10px;width:44px;height:44px;min-width:unset;min-height:unset;display:flex;align-items:center;justify-content:center;top:auto;">
                    <i class="bi bi-list fs-4 m-0 p-0"></i>
                </button>
                <!-- Sidebar (Desktop) -->
                <div class="col-md-2 d-none d-md-flex bg-white min-vh-100 flex-column align-items-start p-0 border-end sidebar">
                    <div class="p-4 w-100 border-bottom">
                        <h4 class="fw-bold mb-0"><i class="bi bi-wallet2 me-2"></i>Pengadaan</h4>
                    </div>
                    <ul class="nav flex-column w-100 mt-3">
                        <li class="nav-item"><a class="nav-link" href="/dashboard"><i class="bi bi-house me-2"></i>Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="/permintaan"><i class="bi bi-file-earmark-plus me-2"></i>Permintaan</a></li>
                        @if(auth()->user()->canManageBudget())
                        <li class="nav-item"><a class="nav-link" href="/budgets"><i class="bi bi-wallet me-2"></i>Budget</a></li>
                        @endif
                        @if(auth()->user()->canApprove())
                        <li class="nav-item"><a class="nav-link" href="/persetujuan"><i class="bi bi-check2-circle me-2"></i>Persetujuan</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link" href="/laporan-pengadaan"><i class="bi bi-bar-chart me-2"></i>Laporan</a></li>
                        @if(auth()->user()->canManageBudget())
                        <li class="nav-item"><a class="nav-link" href="/users"><i class="bi bi-person me-2"></i>Manajemen Akun</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link" href="/pengaturan"><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                    </ul>
                    <div class="mt-auto w-100 border-top">
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-person-circle me-2 text-muted"></i>
                                <small class="text-muted">{{ auth()->user()->nama ?? 'User' }}</small>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="logout-btn">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Offcanvas (Mobile Only) -->
                <div class="offcanvas offcanvas-start d-md-none sidebar" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
                    <div class="offcanvas-header border-bottom">
                        <h5 class="offcanvas-title" id="sidebarOffcanvasLabel"><i class="bi bi-wallet2 me-2"></i>Pengadaan</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-flex flex-column p-0">
                        <ul class="nav flex-column w-100 mt-3">
                            <li class="nav-item"><a class="nav-link" href="/dashboard"><i class="bi bi-house me-2"></i>Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="/permintaan"><i class="bi bi-file-earmark-plus me-2"></i>Permintaan</a></li>
                            @if(auth()->user()->canManageBudget())
                            <li class="nav-item"><a class="nav-link" href="/budgets"><i class="bi bi-wallet me-2"></i>Budget</a></li>
                            @endif
                            @if(auth()->user()->canApprove())
                            <li class="nav-item"><a class="nav-link" href="/persetujuan"><i class="bi bi-check2-circle me-2"></i>Persetujuan</a></li>
                            @endif
                            <li class="nav-item"><a class="nav-link" href="/laporan-pengadaan"><i class="bi bi-bar-chart me-2"></i>Laporan</a></li>
                            @if(auth()->user()->canManageBudget())
                            <li class="nav-item"><a class="nav-link" href="/users"><i class="bi bi-person me-2"></i>Manajemen Akun</a></li>
                            @endif
                            <li class="nav-item"><a class="nav-link" href="/pengaturan"><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                        </ul>
                        <div class="mt-auto w-100 border-top">
                            <div class="p-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-person-circle me-2 text-muted"></i>
                                    <small class="text-muted">{{ auth()->user()->nama ?? 'User' }}</small>
                                </div>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="logout-btn">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Main Content -->
                <main class="col-md-10 px-0 py-0">
                    @yield('content')
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
