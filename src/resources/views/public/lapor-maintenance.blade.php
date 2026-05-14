<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lapor Maintenance Gedung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @livewireStyles
</head>
<body>
    <div class="report-page">
        <style>
            .report-page {
                min-height: 100vh;
                width: 100%;
                font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
                color: #e5f4ff;
                background:
                    radial-gradient(circle at 50% 8%, rgba(56, 189, 248, 0.28), transparent 24%),
                    radial-gradient(circle at 20% 30%, rgba(14, 165, 233, 0.14), transparent 28%),
                    linear-gradient(135deg, #07111f 0%, #0b1728 45%, #07101d 100%);
                padding: 40px 20px;
                box-sizing: border-box;
            }

            .report-container {
                width: 100%;
                max-width: 920px;
                margin: 0 auto;
            }

            .report-header {
                text-align: center;
                margin-bottom: 28px;
            }

            .report-logo {
                width: 54px;
                height: 54px;
                margin: 0 auto 16px;
                border-radius: 18px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(56, 189, 248, 0.14);
                border: 1px solid rgba(125, 211, 252, 0.26);
                box-shadow: 0 0 28px rgba(56, 189, 248, 0.24);
                font-size: 26px;
            }

            .report-title {
                margin: 0;
                font-size: 32px;
                line-height: 1.2;
                font-weight: 800;
                color: #ffffff;
                letter-spacing: -0.04em;
            }

            .report-subtitle {
                max-width: 640px;
                margin: 10px auto 0;
                color: #9fb4c9;
                font-size: 14px;
                line-height: 1.7;
            }

            .report-card {
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
                .report-card {
                    padding: 24px 18px;
                    border-radius: 22px;
                }

                .report-title {
                    font-size: 26px;
                }
            }
        </style>

        <div class="report-container">
            <div class="report-header">
                <div class="report-logo">🛠️</div>

                <h1 class="report-title">
                    Lapor Maintenance Gedung
                </h1>

                <p class="report-subtitle">
                    Silakan isi form laporan kerusakan fasilitas kampus. Laporan akan masuk ke admin maintenance untuk diverifikasi.
                </p>
            </div>

            <div class="report-card">
                <livewire:frontend.form-permintaan-maintenance />
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>