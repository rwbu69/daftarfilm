<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Film Manager</title>
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
                <p class="auth-subtitle">Masuk ke akun Anda</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

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
                        autofocus
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
                        placeholder="••••••••"
                        required
                    >
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-options">
                    <label class="checkbox-container">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                        <span class="checkbox-text">Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="auth-btn auth-btn-primary">
                    <span>Masuk</span>
                    <div class="btn-loading"></div>
                </button>
            </form>

            <div class="auth-footer">
                <p class="auth-link-text">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="auth-link">Daftar sekarang</a>
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