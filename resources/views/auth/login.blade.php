<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg-color: #f8fafc;
            --card-bg: rgba(255, 255, 255, 0.85);
            --text-main: #1e293b;
            --text-muted: #64748b;
            --input-bg: rgba(255, 255, 255, 0.9);
            --input-border: rgba(148, 163, 184, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            background-image:
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(236, 72, 153, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-main);
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 2rem;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .login-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 24px;
            padding: 2.5rem 2rem;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0, 0, 0, 0.02);
        }

        .logo-area {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-icon {
            font-size: 2.5rem;
            background: linear-gradient(135deg, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }

        .logo-title {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.025em;
        }

        .logo-subtitle {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-muted);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 12px;
            color: var(--text-main);
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.02);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            color: var(--text-muted);
            cursor: pointer;
        }

        .checkbox-input {
            margin-right: 0.5rem;
            width: 1rem;
            height: 1rem;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .forgot-link {
            font-size: 0.875rem;
            color: var(--primary);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .forgot-link:hover {
            color: #818cf8;
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, var(--primary), #7c3aed);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px rgba(79, 70, 229, 0.6);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.5rem;
            display: block;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #059669;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            text-align: center;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-card">

            <div class="logo-area">
                <i class="fas fa-layer-group logo-icon"></i>
                <h1 class="logo-title">Login</h1>
                <p class="logo-subtitle">Silakan login untuk melanjutkan</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required
                        autofocus autocomplete="username" placeholder="admin@example.com">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-control" type="password" name="password" required
                        autocomplete="current-password" placeholder="••••••••">
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="checkbox-group">
                    <label for="remember_me" class="checkbox-label">
                        <input id="remember_me" type="checkbox" class="checkbox-input" name="remember">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn-login">
                    Sign In
                </button>
            </form>
        </div>
    </div>

</body>

</html>