<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Riwayat Laporan | Fixora</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/pelapor-sidebar.css') }}"
    >

    @livewireStyles

    <style>
        :root {
            --page-border: rgba(148, 163, 184, 0.20);
            --page-text: #f8fafc;
            --page-muted: #9fb0c6;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;

            color: var(--page-text);
            font-family: 'Inter', sans-serif;

            scrollbar-width: none;
            -ms-overflow-style: none;

            background:
                radial-gradient(
                    circle at 55% 12%,
                    rgba(35, 112, 194, 0.22),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #061426 0%,
                    #07192f 48%,
                    #071426 100%
                );
        }

        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        .history-page {
            min-height: 100vh;
            padding: 32px 38px 48px;
        }

        .history-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        .history-header {
            margin-bottom: 26px;
        }

        .history-heading {
            display: flex;
            align-items: center;
            gap: 14px;

            margin-bottom: 10px;

            color: #ffffff;
            font-size: 29px;
            font-weight: 800;
        }

        .history-heading-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 48px;
            height: 48px;
            flex: 0 0 48px;

            color: #60a5fa;

            border-radius: 14px;
            background: rgba(37, 99, 235, 0.15);
            border: 1px solid rgba(96, 165, 250, 0.25);
        }

        .history-description {
            max-width: 720px;
            color: var(--page-muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .history-card {
            padding: 30px;

            border-radius: 24px;
            border: 1px solid var(--page-border);

            background:
                linear-gradient(
                    160deg,
                    rgba(24, 53, 86, 0.96),
                    rgba(14, 37, 65, 0.96)
                );

            box-shadow: 0 22px 55px rgba(0, 0, 0, 0.18);
        }

        @media (max-width: 860px) {
            .history-page {
                padding: 18px 16px 36px;
            }

            .history-card {
                padding: 22px 18px;
                border-radius: 20px;
            }

            .history-heading {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    @include('public.partials.sidebar-pelapor')

    <main class="history-page pelapor-page-content">
        <div class="history-container">
            <header class="history-header">
                <h1 class="history-heading">
                    <span class="history-heading-icon">
                        <svg
                            width="26"
                            height="26"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="M3 12a9 9 0 1 0 3-6.7"/>
                            <path d="M3 4v6h6"/>
                            <path d="M12 7v5l3 2"/>
                        </svg>
                    </span>

                    Riwayat Laporan
                </h1>

                <p class="history-description">
                    Cari laporan menggunakan kode permintaan, nomor telepon,
                    atau email pelapor untuk melihat status dan perkembangan
                    pekerjaan teknisi.
                </p>
            </header>

            <section class="history-card">
                <livewire:frontend.riwayat-laporan />
            </section>
        </div>
    </main>

    @livewireScripts
</body>
</html>