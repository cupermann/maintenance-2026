<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Laporan Maintenance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @livewireStyles

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            margin: 0 !important;
            padding: 0 !important;
            width: 100%;
            min-height: 100%;
            background: #07111f;
            overflow-x: hidden;
        }

        body {
            margin: 0 !important;
            padding: 0 !important;
            width: 100%;
            min-height: 100vh;
            background: #07111f;
            overflow-x: hidden;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .page {
            margin: 0 !important;
            padding: 40px 20px;
            width: 100%;
            min-height: 100vh;
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
            margin-bottom: 28px;
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
            overflow: hidden;
        }

        .logo img {
            width: 42px;
            height: 42px;
            object-fit: contain;
        }

        .title {
            margin: 0;
            font-size: 32px;
            line-height: 1.2;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.04em;
        }

        .subtitle {
            max-width: 640px;
            margin: 10px auto 0;
            color: #9fb4c9;
            font-size: 14px;
            line-height: 1.7;
        }

        .card {
            border-radius: 28px;
            padding: 32px;
            background:
                linear-gradient(180deg, rgba(30, 53, 76, 0.72), rgba(13, 25, 43, 0.78)),
                rgba(15, 23, 42, 0.76);
            border: 1px solid rgba(148, 163, 184, 0.24);
            box-shadow:
                0 28px 90px rgba(0, 0, 0, 0.42),
                inset 0 1px 0 rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(22px);
        }

        @media (max-width: 768px) {
            .page {
                padding: 24px 14px;
            }

            .card {
                padding: 24px 18px;
                border-radius: 22px;
            }

            .title {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <div class="container">
            <div class="header">
                <div class="logo">
                    <img src="{{ asset('images/riwayat-laporan.png') }}" alt="Riwayat Laporan">
                </div>

                <h1 class="title">
                    Riwayat Laporan
                </h1>

                <p class="subtitle">
                    Cek status laporan maintenance dan progres perbaikan berdasarkan kode permintaan, nomor telepon, atau email pelapor.
                </p>
            </div>

            <div class="card">
                <livewire:frontend.riwayat-laporan />
            </div>
        </div>
    </main>

    @livewireScripts
</body>
</html>