<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Buat Laporan | Fixora</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    {{-- CSS sidebar yang sama dengan dashboard --}}
    <link
        rel="stylesheet"
        href="{{ asset('css/pelapor-sidebar.css') }}"
    >

    @livewireStyles

    <style>
        :root {
            --report-border: rgba(148, 163, 184, 0.20);
            --report-text: #f8fafc;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;

            color: var(--report-text);
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

        /* Konten halaman */

        .main-content {
            padding: 28px;
        }

        .report-layout {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        .form-card {
            width: 100%;
            min-width: 0;
            padding: 34px;

            border-radius: 24px;
            border: 1px solid var(--report-border);

            background:
                linear-gradient(
                    160deg,
                    rgba(24, 53, 86, 0.96),
                    rgba(14, 37, 65, 0.96)
                );

            box-shadow: 0 22px 55px rgba(0, 0, 0, 0.18);
        }

        .form-section-title {
            display: flex;
            align-items: center;
            gap: 12px;

            margin-bottom: 14px;

            color: #ffffff;
            font-size: 20px;
            font-weight: 800;
        }

        .form-section-title svg {
            width: 25px;
            height: 25px;
            flex: 0 0 25px;

            color: #4da3ff;
        }

        .form-card-description {
            margin-bottom: 26px;

            color: #9eafc5;
            font-size: 14px;
            line-height: 1.7;
        }

        /* Penyesuaian form Livewire */

        .form-card .report-form-wrapper {
            width: 100%;
        }

        .form-card .form-control {
            background: rgba(5, 19, 35, 0.68);
            border-color: rgba(130, 153, 182, 0.24);
        }

        .form-card .form-control:focus {
            background: rgba(4, 17, 31, 0.88);
        }

        .form-card .submit-button {
            min-height: 54px;
            margin-top: 4px;
            font-size: 15px;
        }

        /* Tablet */

        @media (max-width: 1180px) {
            .main-content {
                padding: 24px;
            }
        }

        /* Mobile */

        @media (max-width: 860px) {
            .main-content {
                padding: 16px;
            }

            .form-card {
                padding: 26px 22px;
                border-radius: 20px;
            }
        }

        @media (max-width: 600px) {
            .form-card {
                padding: 22px 16px;
                border-radius: 18px;
            }

            .form-section-title {
                font-size: 18px;
            }

            .form-card-description {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>
    {{-- Sidebar yang sama dengan Dashboard Pelapor --}}
    @include('public.partials.sidebar-pelapor')

    <main class="main-content pelapor-page-content">
        <section class="report-layout">
            <section class="form-card">
                <div class="form-section-title">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path d="M9 4h6"/>
                        <path d="M9 2h6v4H9z"/>

                        <path
                            d="M6 4H5a2 2 0 0 0-2 2v14h18V6a2 2 0 0 0-2-2h-1"
                        />

                        <path d="m8 14 2 2 5-5"/>
                    </svg>

                    Form Laporan Kerusakan
                </div>

                <p class="form-card-description">
                    Lengkapi seluruh data bertanda bintang agar laporan
                    dapat dikirim dan diproses oleh admin.
                </p>

                <livewire:frontend.form-permintaan-maintenance />
            </section>
        </section>
    </main>

    @livewireScripts
</body>
</html>