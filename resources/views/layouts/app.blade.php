<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Manajemen Koleksi Film')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2 class="sidebar-title">Film Manager</h2>
                <button class="sidebar-toggle" id="sidebarToggle">
                    <span class="toggle-icon">≡</span>
                </button>
            </div>

            <!-- User Info -->
            <div class="user-info">
                <div class="user-avatar">
                    <span class="avatar-text">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
                <div class="user-details">
                    <p class="user-name">{{ Auth::user()->name }}</p>
                    <p class="user-email">{{ Auth::user()->email }}</p>
                </div>
            </div>
            
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('films.index') }}" class="menu-item {{ request()->routeIs('films.index') ? 'active' : '' }}">
                        <span class="menu-icon">🎬</span>
                        <span class="menu-text">Daftar Film</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('films.create') }}" class="menu-item {{ request()->routeIs('films.create') ? 'active' : '' }}">
                        <span class="menu-icon">➕</span>
                        <span class="menu-text">Tambah Film</span>
                    </a>
                </li>
            </ul>

            <!-- Logout Button -->
            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <span class="menu-icon">🚪</span>
                        <span class="menu-text">Logout</span>
                    </button>
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
            });
        });
    </script>
</body>
</html>