<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Dashboard Pelapor | Fixora</title>

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

    <style>
        :root {
            --primary: #175cd3;
            --primary-dark: #0d47a1;
            --primary-soft: #eaf2ff;
            --text: #10234a;
            --muted: #667799;
            --border: #d9e5f5;
            --background: #f4f8fd;
            --white: #ffffff;
            --green: #07966f;
            --purple: #7957e8;
            --whatsapp: #0b9b66;
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
            color: var(--text);
            font-family: 'Inter', sans-serif;
            background: var(--background);
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        .main-content {
            min-height: 100vh;
            padding: 28px;
        }

        .dashboard-card {
            position: relative;
            min-height: calc(100vh - 56px);
            padding: 46px 42px 34px;
            overflow: hidden;

            background: rgba(255, 255, 255, 0.96);
            border: 1px solid var(--border);
            border-radius: 28px;

            box-shadow: 0 18px 50px rgba(55, 91, 145, 0.11);
        }

        /* Hero */

        .hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(360px, 46%);
            align-items: center;
            gap: 34px;

            min-height: 330px;
            padding-bottom: 34px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            margin-bottom: 18px;

            color: #081e43;
            font-size: clamp(42px, 5vw, 68px);
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -2.5px;
        }

        .hero-line {
            width: 78px;
            height: 5px;
            margin-bottom: 26px;

            border-radius: 999px;

            background: linear-gradient(
                90deg,
                var(--primary),
                #7baeff
            );
        }

        .hero-greeting {
            margin-bottom: 12px;

            color: var(--primary);
            font-size: 28px;
            font-weight: 800;
        }

        .hero-description {
            max-width: 650px;

            color: #536888;
            font-size: 17px;
            line-height: 1.8;
        }

        .guest-notice {
            display: inline-flex;
            align-items: center;
            gap: 12px;

            max-width: 590px;
            margin-top: 24px;
            padding: 16px 20px;

            color: #29466e;
            font-size: 15px;
            line-height: 1.5;

            background: #edf4ff;
            border: 1px solid #dbe8fb;
            border-radius: 14px;
        }

        .guest-notice svg {
            width: 24px;
            height: 24px;
            flex: 0 0 24px;

            color: var(--primary);
        }

        .guest-notice strong {
            color: var(--primary);
        }

        .hero-visual {
            position: relative;

            display: flex;
            align-items: center;
            justify-content: center;

            min-height: 290px;
            overflow: hidden;

            border-radius: 24px;

            background:
                radial-gradient(
                    circle at 70% 25%,
                    rgba(95, 166, 255, 0.34),
                    transparent 34%
                ),
                linear-gradient(
                    135deg,
                    #eaf4ff,
                    #dcecff
                );
        }

        .hero-visual::before {
            position: absolute;
            inset: 0;

            z-index: 1;
            content: '';

            pointer-events: none;

            background:
                linear-gradient(
                    90deg,
                    rgba(255, 255, 255, 0.82),
                    rgba(255, 255, 255, 0.12)
                );
        }

        .hero-image {
            position: relative;
            z-index: 0;

            display: block;

            width: 100%;
            height: 290px;

            object-fit: cover;
            object-position: center;
        }

        /* Kartu layanan */

        .service-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;

            margin-top: 10px;
        }

        .service-card {
            display: flex;
            flex-direction: column;

            min-height: 300px;
            padding: 30px;
            overflow: hidden;

            background: var(--white);
            border: 1px solid #d7e3f2;
            border-radius: 22px;

            box-shadow: 0 12px 28px rgba(64, 97, 145, 0.09);

            transition: 0.25s ease;
        }

        .service-card:hover {
            border-color: #9bbced;

            box-shadow: 0 18px 34px rgba(48, 91, 156, 0.15);

            transform: translateY(-5px);
        }

        .service-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 82px;
            height: 82px;
            margin-bottom: 22px;

            border-radius: 50%;
        }

        .service-icon svg {
            width: 42px;
            height: 42px;
        }

        .service-icon.blue {
            color: #145ccb;
            background: #e8f1ff;
        }

        .service-icon.green {
            color: var(--green);
            background: #e3f8f1;
        }

        .service-icon.purple {
            color: var(--purple);
            background: #f0ebff;
        }

        .service-title {
            margin-bottom: 14px;

            color: #11254b;
            font-size: 23px;
            font-weight: 800;
        }

        .service-description {
            margin-bottom: 24px;

            color: #62728e;
            font-size: 15px;
            line-height: 1.75;
        }

        .service-link {
            display: inline-flex;
            align-items: center;
            gap: 9px;

            width: fit-content;
            margin-top: auto;

            font-size: 15px;
            font-weight: 800;

            transition: 0.2s ease;
        }

        .service-link:hover {
            gap: 14px;
        }

        .service-link.blue {
            color: var(--primary);
        }

        .service-link.green {
            color: var(--green);
        }

        .service-link.purple {
            color: var(--purple);
        }

        /* Banner */

        .bottom-banner {
            display: flex;
            align-items: center;
            gap: 20px;

            margin-top: 28px;
            padding: 22px 28px;

            background: linear-gradient(
                90deg,
                #eef5ff,
                #f8fbff
            );

            border: 1px solid #d7e6fa;
            border-radius: 18px;
        }

        .banner-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 48px;
            height: 48px;
            flex: 0 0 48px;

            color: var(--primary);

            border-radius: 14px;
            background: var(--white);

            box-shadow: 0 8px 18px rgba(58, 100, 167, 0.10);
        }

        .banner-title {
            margin-bottom: 5px;

            color: #14366c;
            font-size: 17px;
            font-weight: 800;
        }

        .banner-text {
            color: #647592;
            font-size: 14px;
            line-height: 1.5;
        }

        /* Panduan dan kontak */

        .info-section {
            margin-top: 32px;
            padding: 30px;

            scroll-margin-top: 30px;

            background: #f7faff;
            border: 1px solid #dce8f7;
            border-radius: 20px;
        }

        .info-section h2 {
            margin-bottom: 18px;

            color: #102a56;
            font-size: 24px;
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .step {
            padding: 20px;

            background: var(--white);
            border: 1px solid #dce7f5;
            border-radius: 16px;
        }

        .step-number {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 34px;
            height: 34px;
            margin-bottom: 14px;

            color: var(--white);
            font-weight: 800;

            border-radius: 50%;
            background: var(--primary);
        }

        .step h3 {
            margin-bottom: 8px;

            color: #173765;
            font-size: 16px;
        }

        .step p,
        .contact-text {
            color: #66758f;
            font-size: 14px;
            line-height: 1.7;
        }

        /* Kontak terintegrasi */

        .contact-card {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;

            margin-top: 18px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 16px;

            min-width: 0;
            padding: 20px;

            color: inherit;
            text-decoration: none;

            background: #ffffff;
            border: 1px solid #dce7f5;
            border-radius: 16px;

            transition: 0.22s ease;
        }

        .contact-item:hover {
            border-color: #8fb7ef;

            box-shadow: 0 14px 28px rgba(49, 94, 160, 0.13);

            transform: translateY(-3px);
        }

        .contact-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 54px;
            height: 54px;
            flex: 0 0 54px;

            border-radius: 15px;
        }

        .contact-icon svg {
            width: 28px;
            height: 28px;
        }

        .contact-icon.email {
            color: #2563eb;
            background: #eaf2ff;
        }

        .contact-icon.whatsapp {
            color: var(--whatsapp);
            background: #e5f8f0;
        }

        .contact-content {
            min-width: 0;
        }

        .contact-label {
            margin-bottom: 5px;

            color: #7890ae;
            font-size: 12px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .contact-value {
            color: #173765;
            font-size: 15px;
            font-weight: 800;

            word-break: break-word;
        }

        .contact-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            margin-top: 8px;

            color: #2563eb;
            font-size: 12px;
            font-weight: 700;
        }

        .contact-item.whatsapp-card .contact-action {
            color: var(--whatsapp);
        }

        .contact-action span {
            transition: transform 0.2s ease;
        }

        .contact-item:hover .contact-action span {
            transform: translateX(4px);
        }

        /* Tablet */

        @media (max-width: 1180px) {
            .hero {
                grid-template-columns: minmax(0, 1fr) minmax(300px, 42%);
            }

            .service-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .service-card:last-child {
                grid-column: 1 / -1;
            }
        }

        /* Mobile */

        @media (max-width: 860px) {
            .main-content {
                padding: 16px;
            }

            .dashboard-card {
                min-height: auto;
                padding: 30px 22px;

                border-radius: 20px;
            }

            .hero {
                grid-template-columns: 1fr;

                min-height: auto;
                gap: 24px;
            }

            .hero-visual {
                min-height: 230px;
            }

            .hero-image {
                height: 230px;
            }

            .service-grid {
                grid-template-columns: 1fr;
            }

            .service-card:last-child {
                grid-column: auto;
            }

            .steps,
            .contact-card {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 520px) {
            .hero-title {
                font-size: 40px;
                letter-spacing: -1.5px;
            }

            .hero-greeting {
                font-size: 23px;
            }

            .hero-description {
                font-size: 15px;
            }

            .guest-notice {
                align-items: flex-start;
            }

            .service-card {
                min-height: 270px;
                padding: 24px;
            }

            .bottom-banner {
                align-items: flex-start;
                padding: 20px;
            }

            .info-section {
                padding: 22px 18px;
            }

            .contact-item {
                align-items: flex-start;
                padding: 18px;
            }
        }
    </style>
</head>

<body>
    @php
        /*
         * Ganti data berikut dengan email dan nomor WhatsApp resmi kampus.
         *
         * Nomor wa.me harus memakai format internasional:
         * 0811-1111-1111 menjadi 628111111111.
         */
        $contactEmail = 'fixoracs@gmail.com';

        $whatsappDisplay = '0813-5906-0319';
        $whatsappNumber = '6281359060319';

        $emailSubject = rawurlencode('Bantuan Layanan Fixora');

        $emailBody = rawurlencode(
            "Halo Admin Fixora,\n\n"
            . "Saya membutuhkan bantuan terkait layanan pelaporan "
            . "fasilitas kampus.\n\n"
            . "Terima kasih."
        );

        $whatsappMessage = rawurlencode(
            'Halo Admin Fixora, saya membutuhkan bantuan terkait '
            . 'layanan pelaporan fasilitas kampus.'
        );
    @endphp

    @include('public.partials.sidebar-pelapor')

    <main class="main-content pelapor-page-content">
        <section class="dashboard-card">
            <section class="hero">
                <div class="hero-content">
                    <h1 class="hero-title">
                        WELCOME 
                    </h1>

                    <div class="hero-line"></div>

                    <h2 class="hero-greeting">
                        Selamat datang! 👋
                    </h2>

                    <p class="hero-description">
                        Laporkan kerusakan fasilitas di lingkungan kampus
                        dengan mudah dan pantau status perbaikannya secara
                        langsung.
                    </p>

                    <div class="guest-notice">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 11v5M12 8h.01"/>
                        </svg>

                        <span>
                            Anda dapat membuat laporan dan mengecek statusnya
                            <strong>tanpa perlu login.</strong>
                        </span>
                    </div>
                </div>

                <div class="hero-visual">
                    <img
                        src="{{ asset('images/gedung-kampus.png') }}"
                        alt="Gedung Kampus Fixora"
                        class="hero-image"
                    >
                </div>
            </section>

            <section class="service-grid">
                <article class="service-card">
                    <div class="service-icon blue">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path d="M9 4h6"/>
                            <path d="M9 2h6v4H9z"/>
                            <path d="M6 4H5a2 2 0 0 0-2 2v14h11"/>
                            <path d="M18 13v8M14 17h8"/>
                            <path d="M8 10h7M8 14h3"/>
                        </svg>
                    </div>

                    <h3 class="service-title">
                        Form Laporan
                    </h3>

                    <p class="service-description">
                        Sampaikan laporan kerusakan fasilitas kampus dengan
                        mengisi formulir yang telah disediakan.
                    </p>

                    <a
                        href="{{ url('/lapor-maintenance') }}"
                        class="service-link blue"
                    >
                        Buat Laporan Sekarang
                     
                    </a>
                </article>

                <article class="service-card">
                    <div class="service-icon green">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path d="M3 12a9 9 0 1 0 3-6.7"/>
                            <path d="M3 4v6h6"/>
                            <path d="M12 7v5l3 2"/>
                        </svg>
                    </div>

                    <h3 class="service-title">
                        Riwayat Laporan
                    </h3>

                    <p class="service-description">
                        Lihat laporan yang pernah dibuat dan pantau status
                        serta progres perbaikannya.
                    </p>

                    <a
                        href="{{ url('/riwayat-laporan') }}"
                        class="service-link green"
                    >
                        Cek Riwayat Laporan
                        
                    </a>
                </article>

                <article class="service-card">
                    <div class="service-icon purple">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path d="M4 5a3 3 0 0 1 3-3h5v18H7a3 3 0 0 0-3 3z"/>
                            <path d="M20 5a3 3 0 0 0-3-3h-5v18h5a3 3 0 0 1 3 3z"/>
                        </svg>
                    </div>

                    <h3 class="service-title">
                        Panduan Pelaporan
                    </h3>

                    <p class="service-description">
                        Pelajari cara membuat laporan yang lengkap agar
                        proses pemeriksaan dan penanganan lebih cepat.
                    </p>

                    <a
                        href="#panduan"
                        class="service-link purple"
                    >
                        Lihat Panduan
                        
                    </a>
                </article>
            </section>

            <section class="bottom-banner">
                <div class="banner-icon">
                    <svg
                        width="28"
                        height="28"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/>
                        <path d="m9 12 2 2 4-4"/>
                    </svg>
                </div>

                <div>
                    <div class="banner-title">
                        Bersama menjaga fasilitas kampus
                    </div>

                    <div class="banner-text">
                        Laporan Anda sangat berarti untuk kenyamanan dan
                        keamanan seluruh civitas kampus.
                    </div>
                </div>
            </section>

            <section
                class="info-section"
                id="panduan"
            >
                <h2>Panduan Pelaporan</h2>

                <div class="steps">
                    <article class="step">
                        <div class="step-number">1</div>

                        <h3>Lengkapi data laporan</h3>

                        <p>
                            Isi identitas, pilih gedung, ruangan, kategori
                            kerusakan, dan tingkat prioritas.
                        </p>
                    </article>

                    <article class="step">
                        <div class="step-number">2</div>

                        <h3>Lampirkan foto</h3>

                        <p>
                            Unggah foto kerusakan yang jelas agar admin dan
                            teknisi memahami kondisi fasilitas.
                        </p>
                    </article>

                    <article class="step">
                        <div class="step-number">3</div>

                        <h3>Simpan kode laporan</h3>

                        <p>
                            Gunakan kode laporan atau nomor telepon untuk
                            mengecek status dan progres perbaikan.
                        </p>
                    </article>
                </div>
            </section>

            <section
                class="info-section"
                id="kontak"
            >
                <h2>Kontak Layanan</h2>

                <p class="contact-text">
                    Apabila mengalami kendala saat menggunakan Fixora,
                    silakan hubungi bagian sarana dan prasarana kampus.
                </p>

                <div class="contact-card">
                    <a
                        href="mailto:{{ $contactEmail }}?subject={{ $emailSubject }}&body={{ $emailBody }}"
                        class="contact-item"
                        aria-label="Kirim email ke {{ $contactEmail }}"
                    >
                        <div class="contact-icon email">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="14"
                                    rx="2"
                                />

                                <path d="m3 7 9 6 9-6"/>
                            </svg>
                        </div>

                        <div class="contact-content">
                            <div class="contact-label">
                                Email
                            </div>

                            <div class="contact-value">
                                {{ $contactEmail }}
                            </div>

                            <div class="contact-action">
                                Klik untuk kirim email
                            </div>
                        </div>
                    </a>

                    <a
                        href="https://wa.me/{{ $whatsappNumber }}?text={{ $whatsappMessage }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="contact-item whatsapp-card"
                        aria-label="Hubungi WhatsApp {{ $whatsappDisplay }}"
                    >
                        <div class="contact-icon whatsapp">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    d="M21 11.5a8.5 8.5 0 0 1-12.6 7.4L3 21l2.1-5.2A8.5 8.5 0 1 1 21 11.5Z"
                                />

                                <path
                                    d="M8.3 7.8c.4 3.2 2.7 5.6 5.9 6"
                                />

                                <path d="m8 7 1.8-.5 1.1 2-1.1 1.2"/>
                                <path d="m13.6 13 1.2-1 2 .9-.5 1.8"/>
                            </svg>
                        </div>

                        <div class="contact-content">
                            <div class="contact-label">
                                WhatsApp
                            </div>

                            <div class="contact-value">
                                {{ $whatsappDisplay }}
                            </div>

                            <div class="contact-action">
                                Hubungi melalui WhatsApp
                              
                            </div>
                        </div>
                    </a>
                </div>
            </section>
        </section>
    </main>
</body>
</html>