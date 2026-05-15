<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pelapor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0 !important;
            padding: 0 !important;
            width: 100%;
            min-height: 100vh;
            overflow-x: hidden;
            background: #07111f;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .page {
            min-height: 100vh;
            padding: 40px 20px;
            color: #e5f4ff;
            background:
                radial-gradient(circle at 50% 8%, rgba(56, 189, 248, 0.28), transparent 24%),
                radial-gradient(circle at 20% 30%, rgba(14, 165, 233, 0.14), transparent 28%),
                linear-gradient(135deg, #07111f 0%, #0b1728 45%, #07101d 100%);
        }

        .container {
            width: 100%;
            max-width: 980px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 36px;
        }

        .logo {
            width: 62px;
            height: 62px;
            margin: 0 auto 16px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(56, 189, 248, 0.14);
            border: 1px solid rgba(125, 211, 252, 0.26);
            box-shadow: 0 0 28px rgba(56, 189, 248, 0.24);
            font-size: 30px;
        }

        .title {
            margin: 0;
            font-size: 36px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.04em;
        }

        .subtitle {
            max-width: 660px;
            margin: 12px auto 0;
            color: #9fb4c9;
            font-size: 15px;
            line-height: 1.7;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 24px;
            margin-top: 36px;
        }

        .menu-card {
            position: relative;
            min-height: 260px;
            border-radius: 28px;
            padding: 32px;
            text-decoration: none;
            overflow: hidden;
            background:
                linear-gradient(180deg, rgba(30, 53, 76, 0.72), rgba(13, 25, 43, 0.78)),
                rgba(15, 23, 42, 0.76);
            border: 1px solid rgba(148, 163, 184, 0.24);
            box-shadow:
                0 28px 90px rgba(0, 0, 0, 0.42),
                inset 0 1px 0 rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(22px);
            transition: 0.2s ease;
        }

        .menu-card:hover {
            transform: translateY(-4px);
            border-color: rgba(56, 189, 248, 0.45);
            box-shadow:
                0 32px 100px rgba(0, 0, 0, 0.5),
                0 0 40px rgba(56, 189, 248, 0.12);
        }

        .menu-icon {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(56, 189, 248, 0.14);
            border: 1px solid rgba(125, 211, 252, 0.24);
            color: #ffffff;
            font-size: 28px;
            margin-bottom: 22px;
        }

        .menu-title {
            margin: 0;
            font-size: 24px;
            font-weight: 800;
            color: #ffffff;
        }

        .menu-desc {
            margin: 12px 0 24px;
            color: #9fb4c9;
            font-size: 14px;
            line-height: 1.7;
        }

        .menu-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #7dd3fc;
            font-weight: 700;
            font-size: 14px;
        }

        .back-link {
            display: block;
            margin-top: 28px;
            text-align: center;
            color: #7dd3fc;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .page {
                padding: 28px 14px;
            }

            .card-grid {
                grid-template-columns: 1fr;
            }

            .title {
                font-size: 28px;
            }

            .menu-card {
                min-height: auto;
                padding: 26px;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <div class="container">
            <div class="header">
                <div class="logo">🛠️</div>

                <h1 class="title">
                    Dashboard Pelapor
                </h1>

                <p class="subtitle">
                    Pilih layanan yang ingin digunakan. Pelapor dapat membuat laporan kerusakan gedung dan mengecek riwayat progres perbaikan tanpa login.
                </p>
            </div>

            <div class="card-grid">
                <a href="{{ route('lapor-maintenance') }}" class="menu-card">
                    <div class="menu-icon">📝</div>

                    <h2 class="menu-title">
                        Form Laporan
                    </h2>

                    <p class="menu-desc">
                        Buat laporan baru untuk kerusakan fasilitas kampus seperti AC, listrik, toilet, ruangan, pintu, meja, kursi, dan lainnya.
                    </p>

                    <span class="menu-action">
                        Buat laporan sekarang →
                    </span>
                </a>

                <a href="{{ route('riwayat-laporan') }}" class="menu-card">
                    <div class="menu-icon">📊</div>

                    <h2 class="menu-title">
                        Riwayat Laporan
                    </h2>

                    <p class="menu-desc">
                        Cek status laporan dan progres perbaikan berdasarkan kode permintaan atau nomor telepon pelapor.
                    </p>

                    <span class="menu-action">
                        Cek riwayat laporan →
                    </span>
                </a>
            </div>

            <a href="{{ route('home') }}" class="back-link">
                ← Kembali ke halaman utama
            </a>
        </div>
    </main>
</body>
</html>