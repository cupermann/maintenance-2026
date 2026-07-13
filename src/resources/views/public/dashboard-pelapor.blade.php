@php
    $services = [
        [
            'title' => 'Form Laporan',
            'description' => 'Sampaikan laporan kerusakan fasilitas kampus dengan mengisi formulir yang telah disediakan.',
            'url' => route('lapor-maintenance'),
            'label' => 'Buat Laporan Sekarang',
            'color' => 'blue',
            'icon' => 'report',
        ],
        [
            'title' => 'Riwayat Laporan',
            'description' => 'Lihat laporan yang pernah dibuat dan pantau status serta progres perbaikannya.',
            'url' => route('riwayat-laporan'),
            'label' => 'Cek Riwayat Laporan',
            'color' => 'green',
            'icon' => 'history',
        ],
        [
            'title' => 'Panduan Pelaporan',
            'description' => 'Pelajari cara membuat laporan yang lengkap agar proses pemeriksaan dan penanganan lebih cepat.',
            'url' => '#panduan',
            'label' => 'Lihat Panduan',
            'color' => 'purple',
            'icon' => 'guide',
        ],
    ];

    $steps = [
        [
            'title' => 'Lengkapi data laporan',
            'description' => 'Isi identitas, pilih gedung, ruangan, kategori kerusakan, dan tingkat prioritas.',
        ],
        [
            'title' => 'Lampirkan foto',
            'description' => 'Unggah foto kerusakan yang jelas agar admin dan teknisi memahami kondisi fasilitas.',
        ],
        [
            'title' => 'Simpan kode laporan',
            'description' => 'Gunakan kode laporan atau nomor telepon untuk mengecek status dan progres perbaikan.',
        ],
    ];

    $contactEmail = config('fixora.contact.email');
    $whatsappNumber = config('fixora.contact.whatsapp_number');
    $whatsappDisplay = config('fixora.contact.whatsapp_display');

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

    $emailLink = "mailto:{$contactEmail}"
        . "?subject={$emailSubject}"
        . "&body={$emailBody}";

    $whatsappLink = "https://wa.me/{$whatsappNumber}"
        . "?text={$whatsappMessage}";
@endphp

<x-layouts.pelapor title="Dashboard Pelapor | Fixora">
    <section class="dashboard-card">
        <section class="hero">
            <div class="hero-content">
                <h1 class="hero-title">
                    FIXORA
                </h1>

                <div class="hero-line"></div>

                <h2 class="hero-greeting">
                    Fix, Organize, Report, Act
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
                        aria-hidden="true"
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
            @foreach ($services as $service)
                <article class="service-card">
                    <div class="service-icon {{ $service['color'] }}">
                        @switch($service['icon'])
                            @case('report')
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    aria-hidden="true"
                                >
                                    <path d="M9 4h6"/>
                                    <path d="M9 2h6v4H9z"/>
                                    <path d="M6 4H5a2 2 0 0 0-2 2v14h11"/>
                                    <path d="M18 13v8M14 17h8"/>
                                    <path d="M8 10h7M8 14h3"/>
                                </svg>
                                @break

                            @case('history')
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    aria-hidden="true"
                                >
                                    <path d="M3 12a9 9 0 1 0 3-6.7"/>
                                    <path d="M3 4v6h6"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>
                                @break

                            @case('guide')
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    aria-hidden="true"
                                >
                                    <path d="M4 5a3 3 0 0 1 3-3h5v18H7a3 3 0 0 0-3 3z"/>
                                    <path d="M20 5a3 3 0 0 0-3-3h-5v18h5a3 3 0 0 1 3 3z"/>
                                </svg>
                                @break
                        @endswitch
                    </div>

                    <h3 class="service-title">
                        {{ $service['title'] }}
                    </h3>

                    <p class="service-description">
                        {{ $service['description'] }}
                    </p>

                    <a
                        href="{{ $service['url'] }}"
                        class="service-link {{ $service['color'] }}"
                    >
                        {{ $service['label'] }}
                    </a>
                </article>
            @endforeach
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
                    aria-hidden="true"
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
                @foreach ($steps as $index => $step)
                    <article class="step">
                        <div class="step-number">
                            {{ $index + 1 }}
                        </div>

                        <h3>
                            {{ $step['title'] }}
                        </h3>

                        <p>
                            {{ $step['description'] }}
                        </p>
                    </article>
                @endforeach
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
                    href="{{ $emailLink }}"
                    class="contact-item"
                    aria-label="Kirim email ke {{ $contactEmail }}"
                >
                    <div class="contact-icon email">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            aria-hidden="true"
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
                    href="{{ $whatsappLink }}"
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
                            aria-hidden="true"
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
</x-layouts.pelapor>