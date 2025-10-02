<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Film Manager</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-body">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo">
                    <div class="logo-icon">🎬</div>
                    <h1 class="logo-text">Film Manager</h1>
                </div>
                <p class="auth-subtitle">Buat akun baru</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="auth-input @error('name') error @enderror" 
                        value="{{ old('name') }}"
                        placeholder="Nama lengkap Anda"
                        required 
                        autofocus
                    >
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="auth-input @error('email') error @enderror" 
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        required
                    >
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="auth-input @error('password') error @enderror"
                        placeholder="Minimal 8 karakter"
                        required
                    >
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        class="auth-input"
                        placeholder="Ulangi password"
                        required
                    >
                </div>

                <button type="submit" class="auth-btn auth-btn-primary">
                    <span>Daftar</span>
                    <div class="btn-loading"></div>
                </button>
            </form>

            <div class="auth-footer">
                <p class="auth-link-text">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="auth-link">Masuk sekarang</a>
                </p>
            </div>
        </div>

        <div class="auth-bg">
            <div class="bg-gradient"></div>
            <div class="bg-pattern"></div>
        </div>
    </div>

    <script>
        // Add form submission loading state
        document.querySelector('.auth-form').addEventListener('submit', function(e) {
            const btn = this.querySelector('.auth-btn-primary');
            const loading = btn.querySelector('.btn-loading');
            const text = btn.querySelector('span');
            
            btn.disabled = true;
            loading.style.display = 'block';
            text.style.opacity = '0.7';
        });
    </script>
</body>
</html>