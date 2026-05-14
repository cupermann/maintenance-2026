<div class="auth-dark-page">
    <style>
        .auth-dark-page {
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #e5f4ff;
            background:
                radial-gradient(circle at 50% 10%, rgba(56, 189, 248, 0.38), transparent 22%),
                radial-gradient(circle at 20% 30%, rgba(14, 165, 233, 0.18), transparent 28%),
                radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.16), transparent 24%),
                linear-gradient(135deg, #07111f 0%, #0b1728 45%, #07101d 100%);
            overflow: hidden;
            position: relative;
            padding: 24px;
        }

        .auth-dark-page::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(rgba(255, 255, 255, 0.018) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.018) 1px, transparent 1px);
            background-size: 48px 48px;
            mask-image: radial-gradient(circle at center, black 0%, transparent 72%);
            pointer-events: none;
        }

        .auth-dark-page::after {
            content: "";
            position: absolute;
            top: -120px;
            left: 50%;
            width: 520px;
            height: 520px;
            transform: translateX(-50%);
            background: radial-gradient(circle, rgba(125, 211, 252, 0.35), transparent 65%);
            filter: blur(40px);
            pointer-events: none;
        }

        .login-card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 390px;
            border-radius: 28px;
            padding: 34px;
            background:
                linear-gradient(180deg, rgba(30, 53, 76, 0.72), rgba(13, 25, 43, 0.78)),
                rgba(15, 23, 42, 0.76);
            border: 1px solid rgba(148, 163, 184, 0.28);
            box-shadow:
                0 28px 90px rgba(0, 0, 0, 0.42),
                inset 0 1px 0 rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(22px);
        }

        .login-logo {
            width: 42px;
            height: 42px;
            margin: 0 auto 18px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(186, 230, 253, 0.6);
            background: rgba(15, 23, 42, 0.25);
            box-shadow: 0 0 22px rgba(56, 189, 248, 0.32);
        }

        .login-logo svg {
            width: 22px;
            height: 22px;
            color: #dff7ff;
        }

        .login-title {
            margin: 0;
            text-align: center;
            font-size: 25px;
            line-height: 1.2;
            font-weight: 700;
            letter-spacing: -0.03em;
            color: #ffffff;
        }

        .login-subtitle {
            margin: 8px 0 28px;
            text-align: center;
            font-size: 13px;
            color: #9fb4c9;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 7px;
            font-size: 12px;
            font-weight: 600;
            color: #c7d7e7;
        }

        .input-wrap {
            position: relative;
        }

        .form-input {
            width: 100%;
            height: 46px;
            box-sizing: border-box;
            border-radius: 12px;
            border: 1px solid rgba(148, 163, 184, 0.22);
            background: rgba(7, 16, 29, 0.62);
            color: #f8fafc;
            font-size: 14px;
            padding: 0 15px;
            outline: none;
            transition: 0.2s ease;
        }

        .form-input::placeholder {
            color: #5e7188;
        }

        .form-input:focus {
            border-color: rgba(56, 189, 248, 0.75);
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.12);
            background: rgba(7, 16, 29, 0.85);
        }

        .login-submit {
            position: absolute;
            top: 50%;
            right: 7px;
            width: 34px;
            height: 34px;
            transform: translateY(-50%);
            border: 0;
            border-radius: 10px;
            cursor: pointer;
            color: #042033;
            background: linear-gradient(135deg, #7dd3fc, #38bdf8);
            box-shadow: 0 8px 20px rgba(56, 189, 248, 0.28);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s ease;
        }

        .login-submit:hover {
            transform: translateY(-50%) scale(1.03);
            background: linear-gradient(135deg, #bae6fd, #38bdf8);
        }

        .login-submit:disabled {
            cursor: not-allowed;
            opacity: 0.65;
        }

        .login-submit svg {
            width: 16px;
            height: 16px;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 2px 0 20px;
            font-size: 12px;
            color: #aab9c9;
        }

        .remember-row input {
            width: 14px;
            height: 14px;
            accent-color: #38bdf8;
        }

        .error-text {
            margin: 7px 0 0;
            font-size: 12px;
            color: #fca5a5;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
            color: #6f8197;
            font-size: 12px;
        }

        .divider::before,
        .divider::after {
            content: "";
            height: 1px;
            flex: 1;
            background: rgba(148, 163, 184, 0.18);
        }

        .social-button {
            width: 100%;
            height: 43px;
            border-radius: 12px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(15, 30, 49, 0.72);
            color: #c7d7e7;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 14px;
            margin-bottom: 10px;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .social-button:hover {
            background: rgba(22, 43, 68, 0.86);
            border-color: rgba(125, 211, 252, 0.25);
        }

        .social-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .social-icon {
            width: 19px;
            height: 19px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .social-arrow {
            width: 24px;
            height: 24px;
            border-radius: 8px;
            background: rgba(7, 16, 29, 0.65);
            color: #93a8bd;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-text {
            margin-top: 22px;
            text-align: center;
            font-size: 12px;
            color: #8fa2b8;
        }

        .register-text a {
            color: #7dd3fc;
            font-weight: 700;
            text-decoration: none;
        }

        .register-text a:hover {
            text-decoration: underline;
        }

        .testing-box {
            margin-top: 18px;
            padding: 13px;
            border-radius: 14px;
            background: rgba(7, 16, 29, 0.46);
            border: 1px solid rgba(148, 163, 184, 0.14);
            font-size: 11.5px;
            color: #90a4b8;
            line-height: 1.7;
        }

        .testing-box strong {
            color: #dbeafe;
        }

        @media (max-width: 480px) {
            .login-card {
                max-width: 100%;
                padding: 28px 22px;
                border-radius: 24px;
            }

            .login-title {
                font-size: 23px;
            }
        }
    </style>

    <div class="login-card">
        <div class="login-logo">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M12 3L19 7V12C19 16.5 16.1 20.1 12 21C7.9 20.1 5 16.5 5 12V7L12 3Z" stroke="currentColor" stroke-width="1.7"/>
                <path d="M9.5 12.2L11.2 13.9L14.8 10.1" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <h1 class="login-title">Aduan Kampus ABC</h1>
        <p class="login-subtitle">Layanan pusat pengaduan Fasilitas Kampus.</p>

        <form wire:submit.prevent="login">
            <div class="form-group">
                <label class="form-label">Email</label>

                <div class="input-wrap">
                    <input
                        type="email"
                        wire:model.defer="email"
                        class="form-input"
                        placeholder="Masukkan email"
                        autocomplete="email"
                        autofocus
                    >

                    <button
                        type="submit"
                        class="login-submit"
                        wire:loading.attr="disabled"
                        wire:target="login"
                        title="Masuk"
                    >
                        <span wire:loading.remove wire:target="login">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M5 12H18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <path d="M13 7L18 12L13 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>

                        <span wire:loading wire:target="login">...</span>
                    </button>
                </div>

                @error('email')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>

                <input
                    type="password"
                    wire:model.defer="password"
                    class="form-input"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                >

                @error('password')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <label class="remember-row">
                <input type="checkbox" wire:model="remember">
                Remember me
            </label>
        </form>

        <div class="divider">ATAU</div>

        <a href="{{ url('/lapor-maintenance') }}" class="social-button">
            <span class="social-left">
                <span class="social-icon">📝</span>
                Masuk tanpa login
            </span>
            <span class="social-arrow">›</span>
        </a>

        <p class="register-text">
            Pelapor dapat mengirim laporan kerusakan tanpa harus login.
        </p>

        
    </div>
</div>