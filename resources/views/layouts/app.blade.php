<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameZone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css">

    <style>
        body {
            overflow-x: hidden;
        }

        .sidebar {
            min-height: 100vh;
        }

        .dino-runner-container {
            position: absolute;
            bottom: 10px;
            left: 10px;
            width: 88px;
            height: 94px;
            overflow: hidden;
            z-index: 999;
            animation: move-dino-sidebar 4s linear infinite;
        }

        .dino {
            width: 88px;
            height: 94px;
            background: url('/image/dino.png') no-repeat center center;
            background-size: cover;
            animation: bounce 0.8s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes move-dino-sidebar {
            0% { transform: translateX(0); }
            50% { transform: translateX(30px); }
            100% { transform: translateX(0); }
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                width: 220px;
                z-index: 1050;
                background-color: #f8f9fa;
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(0, 0, 0, 0.4);
                z-index: 1040;
            }

            .overlay.active {
                display: block;
            }

            .toggle-btn {
                display: block !important;
            }
        }
    </style>
</head>
<body>
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <button class="btn btn-outline-secondary toggle-btn m-2 d-md-none" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 col-sm-12 bg-body-secondary sidebar p-3" id="sidebar">
                <h4 id="logoGameZone" class="text-center mb-4 opacity-0">
                    <a href="{{ route('dashboard') }}" class="text-success text-decoration-none display-8">
                        🎮 GameZone
                    </a>
                </h4>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold text-success' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-house-door"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->routeIs('games.*') ? 'active fw-bold text-success' : '' }}" href="{{ route('games.index') }}">
                            <i class="bi bi-controller"></i> List Game
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->routeIs('statistik.*') ? 'active fw-bold text-success' : '' }}" href="{{ route('statistik.index') }}">
                            <i class="bi bi-graph-up"></i> Statistik
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->routeIs('developers.*') ? 'active fw-bold text-success' : '' }}" href="{{ route('developers.index') }}">
                            <i class="bi bi-person-workspace"></i> Developer
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link" href="{{ route('kategori.index') }}">
                            <i class="bi bi-tags"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link" href="{{ route('profile') }}">
                            <i class="bi bi-person-circle"></i> ({{ Auth::user()->name }})
                        </a>
                    </li>
                </ul>
                <form action="{{ route('logout') }}" method="POST" class="d-grid mt-2">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
                <hr>
                <button onclick="toggleTheme()" class="btn btn-outline-secondary btn-sm w-100">🌓 Theme</button>
                <!-- Dinosaurus -->
                <div class="dino-runner-container">
                    <div class="dino"></div>
                </div>
            </nav>

            <!-- Content -->
            <main class="col-md-10 ms-sm-auto px-md-4 py-4">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Tema
        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-bs-theme', savedTheme);

            const logo = document.getElementById('logoGameZone');
            logo.classList.add('animate__animated', 'animate__fadeInDown');
            logo.classList.remove('opacity-0');
        });

        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('show');
            overlay.classList.toggle('active');
        }
    </script>
</body>
</html>