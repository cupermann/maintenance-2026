<div>
    <style>
        .history-wrapper {
            width: 100%;
        }

        .search-panel {
            padding: 24px;
            border-radius: 18px;
            background: rgba(5, 19, 35, 0.52);
            border: 1px solid rgba(148, 163, 184, 0.18);
        }

        .search-title {
            margin-bottom: 7px;

            color: #ffffff;
            font-size: 20px;
            font-weight: 800;
        }

        .search-description {
            margin-bottom: 18px;

            color: #9fb0c6;
            font-size: 13px;
            line-height: 1.6;
        }

        .search-form {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 12px;
        }

        .search-input {
            width: 100%;
            min-height: 52px;
            padding: 0 17px;

            color: #f8fafc;
            font-size: 14px;

            outline: none;
            border-radius: 14px;
            border: 1px solid rgba(148, 163, 184, 0.22);
            background: rgba(3, 15, 29, 0.70);

            transition: 0.2s ease;
        }

        .search-input::placeholder {
            color: #64748b;
        }

        .search-input:focus {
            border-color: rgba(56, 189, 248, 0.75);
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.12);
        }

        .search-button {
            min-width: 110px;
            min-height: 52px;
            padding: 0 24px;

            cursor: pointer;
            color: #ffffff;
            font-weight: 800;

            border: 0;
            border-radius: 14px;
            background: linear-gradient(135deg, #2563eb, #38bdf8);

            box-shadow: 0 12px 26px rgba(37, 99, 235, 0.24);
        }

        .search-button:disabled {
            cursor: not-allowed;
            opacity: 0.65;
        }

        .error-message {
            margin-top: 8px;
            color: #fca5a5;
            font-size: 12px;
        }

        .result-list {
            display: flex;
            flex-direction: column;
            gap: 24px;

            margin-top: 26px;
        }

        .report-card {
            overflow: hidden;

            border-radius: 20px;
            border: 1px solid rgba(148, 163, 184, 0.20);
            background: rgba(12, 35, 62, 0.82);
        }

        .report-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;

            padding: 24px;

            background:
                linear-gradient(
                    90deg,
                    rgba(30, 64, 105, 0.88),
                    rgba(17, 43, 74, 0.88)
                );

            border-bottom: 1px solid rgba(148, 163, 184, 0.16);
        }

        .report-code {
            margin-bottom: 7px;

            color: #60a5fa;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        .report-title {
            margin-bottom: 7px;

            color: #ffffff;
            font-size: 21px;
            font-weight: 800;
        }

        .report-date {
            color: #9fb0c6;
            font-size: 12px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 105px;
            padding: 8px 13px;

            font-size: 12px;
            font-weight: 800;

            border-radius: 999px;
        }

        .status-diajukan {
            color: #dbeafe;
            background: rgba(59, 130, 246, 0.16);
            border: 1px solid rgba(96, 165, 250, 0.26);
        }

        .status-diverifikasi {
            color: #cffafe;
            background: rgba(6, 182, 212, 0.15);
            border: 1px solid rgba(34, 211, 238, 0.24);
        }

        .status-ditugaskan {
            color: #fef3c7;
            background: rgba(245, 158, 11, 0.15);
            border: 1px solid rgba(251, 191, 36, 0.25);
        }

        .status-diproses {
            color: #fde68a;
            background: rgba(217, 119, 6, 0.17);
            border: 1px solid rgba(245, 158, 11, 0.26);
        }

        .status-selesai {
            color: #bbf7d0;
            background: rgba(34, 197, 94, 0.14);
            border: 1px solid rgba(74, 222, 128, 0.24);
        }

        .status-ditolak {
            color: #fecaca;
            background: rgba(239, 68, 68, 0.14);
            border: 1px solid rgba(248, 113, 113, 0.24);
        }

        .report-body {
            padding: 24px;
        }

        .closing-box {
            margin-bottom: 22px;
            padding: 17px;

            color: #bbf7d0;
            font-size: 13px;
            line-height: 1.65;

            border-radius: 14px;
            background: rgba(34, 197, 94, 0.10);
            border: 1px solid rgba(74, 222, 128, 0.22);
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;

            margin-bottom: 22px;
        }

        .detail-item {
            padding: 16px;

            border-radius: 14px;
            background: rgba(5, 19, 35, 0.42);
            border: 1px solid rgba(148, 163, 184, 0.13);
        }

        .detail-label {
            margin-bottom: 7px;

            color: #7f94ae;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            color: #f8fafc;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.5;
        }

        .description-box {
            margin-bottom: 22px;
            padding: 18px;

            border-radius: 14px;
            background: rgba(5, 19, 35, 0.42);
            border: 1px solid rgba(148, 163, 184, 0.13);
        }

        .description-title {
            margin-bottom: 8px;

            color: #ffffff;
            font-size: 14px;
            font-weight: 800;
        }

        .description-text {
            color: #b8c6d8;
            font-size: 13px;
            line-height: 1.7;
        }

        .rejection-box {
            margin-bottom: 22px;
            padding: 17px;

            color: #fecaca;
            font-size: 13px;
            line-height: 1.65;

            border-radius: 14px;
            background: rgba(239, 68, 68, 0.10);
            border: 1px solid rgba(248, 113, 113, 0.22);
        }

        .progress-section {
            padding-top: 23px;
            border-top: 1px solid rgba(148, 163, 184, 0.16);
        }

        .progress-heading {
            display: flex;
            align-items: center;
            gap: 10px;

            margin-bottom: 21px;

            color: #ffffff;
            font-size: 18px;
            font-weight: 800;
        }

        .timeline {
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 18px;

            padding-left: 31px;
        }

        .timeline::before {
            position: absolute;
            top: 8px;
            bottom: 8px;
            left: 10px;

            width: 2px;
            content: '';

            background: rgba(96, 165, 250, 0.28);
        }

        .timeline-item {
            position: relative;

            padding: 20px;

            border-radius: 16px;
            background: rgba(5, 19, 35, 0.48);
            border: 1px solid rgba(148, 163, 184, 0.15);
        }

        .timeline-dot {
            position: absolute;
            top: 24px;
            left: -29px;

            width: 16px;
            height: 16px;

            border: 4px solid #0f2d4e;
            border-radius: 50%;
            background: #38bdf8;

            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
        }

        .timeline-status {
            margin-bottom: 5px;

            color: #ffffff;
            font-size: 15px;
            font-weight: 800;
        }

        .timeline-meta {
            margin-bottom: 12px;

            color: #8195af;
            font-size: 11px;
        }

        .timeline-description {
            color: #b8c6d8;
            font-size: 13px;
            line-height: 1.7;
        }

        .progress-photo-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;

            margin-top: 16px;
        }

        .progress-photo-link {
            display: block;
            overflow: hidden;

            min-height: 155px;

            border-radius: 13px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(2, 12, 24, 0.40);
        }

        .progress-photo {
            display: block;

            width: 100%;
            height: 170px;

            object-fit: cover;

            transition: transform 0.25s ease;
        }

        .progress-photo-link:hover .progress-photo {
            transform: scale(1.04);
        }

        .empty-progress {
            padding: 20px;

            color: #93a4b9;
            font-size: 13px;
            text-align: center;

            border-radius: 14px;
            border: 1px dashed rgba(148, 163, 184, 0.22);
        }

        .empty-result {
            margin-top: 24px;
            padding: 36px 24px;

            text-align: center;

            border-radius: 18px;
            background: rgba(5, 19, 35, 0.42);
            border: 1px dashed rgba(148, 163, 184, 0.22);
        }

        .empty-result-title {
            margin-bottom: 7px;

            color: #ffffff;
            font-size: 17px;
            font-weight: 800;
        }

        .empty-result-text {
            color: #93a4b9;
            font-size: 13px;
            line-height: 1.6;
        }

        @media (max-width: 900px) {
            .detail-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .progress-photo-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 620px) {
            .search-form {
                grid-template-columns: 1fr;
            }

            .search-button {
                width: 100%;
            }

            .report-header {
                flex-direction: column;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }

            .progress-photo-grid {
                grid-template-columns: 1fr;
            }

            .progress-photo {
                height: 210px;
            }
        }
    </style>

    <div class="history-wrapper">
        <section class="search-panel">
            <h2 class="search-title">
                Cek Riwayat Laporan
            </h2>

            <p class="search-description">
                Masukkan kode permintaan, nomor telepon, atau email pelapor.
            </p>

            <form
                wire:submit.prevent="cari"
                class="search-form"
            >
                <input
                    type="text"
                    wire:model.defer="keyword"
                    class="search-input"
                    placeholder="Contoh: PM-202607050001 atau 08123456789"
                >

                <button
                    type="submit"
                    class="search-button"
                    wire:loading.attr="disabled"
                    wire:target="cari"
                >
                    <span wire:loading.remove wire:target="cari">
                        Cari
                    </span>

                    <span wire:loading wire:target="cari">
                        Mencari...
                    </span>
                </button>
            </form>

            @error('keyword')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror
        </section>

        @if ($sudahDicari)
            @if ($laporans->isEmpty())
                <section class="empty-result">
                    <div class="empty-result-title">
                        Laporan tidak ditemukan
                    </div>

                    <div class="empty-result-text">
                        Periksa kembali kode laporan, nomor telepon,
                        atau email yang dimasukkan.
                    </div>
                </section>
            @else
                <div class="result-list">
                    @foreach ($laporans as $laporan)
                        @php
                            $statusLabel = match ($laporan->status) {
                                'diajukan' => 'Diajukan',
                                'diverifikasi' => 'Diverifikasi',
                                'ditolak' => 'Ditolak',
                                'ditugaskan' => 'Ditugaskan',
                                'diproses' => 'Diproses',
                                'selesai' => 'Selesai',
                                default => ucfirst(
                                    str_replace('_', ' ', $laporan->status ?? '-')
                                ),
                            };

                            $statusClass = match ($laporan->status) {
                                'diajukan' => 'status-diajukan',
                                'diverifikasi' => 'status-diverifikasi',
                                'ditolak' => 'status-ditolak',
                                'ditugaskan' => 'status-ditugaskan',
                                'diproses' => 'status-diproses',
                                'selesai' => 'status-selesai',
                                default => 'status-diajukan',
                            };

                            $progresList = $laporan
                                ->progresPerbaikans
                                ->sortByDesc('tanggal_progres');
                        @endphp

                        <article
                            class="report-card"
                            wire:key="laporan-{{ $laporan->id }}"
                        >
                            <header class="report-header">
                                <div>
                                    <div class="report-code">
                                        {{ $laporan->kode_permintaan }}
                                    </div>

                                    <h2 class="report-title">
                                        {{ $laporan->judul }}
                                    </h2>

                                    <div class="report-date">
                                        Dilaporkan
                                        {{ optional($laporan->tanggal_laporan)->format('d M Y H:i') ?? '-' }}
                                    </div>
                                </div>

                                <span class="status-badge {{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </header>

                            <div class="report-body">
                                <div class="detail-grid">
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            Pelapor
                                        </div>

                                        <div class="detail-value">
                                            {{ $laporan->nama_pelapor
                                                ?: $laporan->user?->name
                                                ?: '-' }}
                                        </div>
                                    </div>

                                    <div class="detail-item">
                                        <div class="detail-label">
                                            Gedung
                                        </div>

                                        <div class="detail-value">
                                            {{ $laporan->ruangan?->gedung?->nama_gedung ?? '-' }}
                                        </div>
                                    </div>

                                    <div class="detail-item">
                                        <div class="detail-label">
                                            Ruangan
                                        </div>

                                        <div class="detail-value">
                                            @if ($laporan->ruangan)
                                                {{ $laporan->ruangan->kode_ruangan }}
                                                -
                                                {{ $laporan->ruangan->nama_ruangan }}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>

                                    <div class="detail-item">
                                        <div class="detail-label">
                                            Kategori
                                        </div>

                                        <div class="detail-value">
                                            {{ $laporan->kategoriKerusakan?->nama_kategori ?? '-' }}
                                        </div>
                                    </div>

                                    <div class="detail-item">
                                        <div class="detail-label">
                                            Prioritas
                                        </div>

                                        <div class="detail-value">
                                            {{ ucfirst($laporan->prioritas ?? '-') }}
                                        </div>
                                    </div>

                                    <div class="detail-item">
                                        <div class="detail-label">
                                            Teknisi
                                        </div>

                                        <div class="detail-value">
                                            {{ $laporan->penugasanTeknisi?->teknisi?->nama_teknisi
                                                ?? 'Belum ditugaskan' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="description-box">
                                    <div class="description-title">
                                        Deskripsi Kerusakan
                                    </div>

                                    <div class="description-text">
                                        {{ $laporan->deskripsi }}
                                    </div>
                                </div>

                                @if ($laporan->status === 'ditolak' && $laporan->catatan_admin)
                                    <div class="rejection-box">
                                        <strong>Alasan penolakan:</strong><br>
                                        {{ $laporan->catatan_admin }}
                                    </div>
                                @endif

                                @if ($laporan->status === 'selesai' && $laporan->catatan_admin)
                                    <div class="closing-box">
                                        <strong>Pesan penutupan dari admin:</strong><br>
                                        {{ $laporan->catatan_admin }}
                                    </div>
                                @endif

                                <section class="progress-section">
                                    <h3 class="progress-heading">
                                        <svg
                                            width="22"
                                            height="22"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path d="M4 4v16"/>
                                            <path d="M4 8h10"/>
                                            <path d="M4 16h16"/>
                                            <circle cx="16" cy="8" r="2"/>
                                            <circle cx="20" cy="16" r="2"/>
                                        </svg>

                                        Progres Perbaikan
                                    </h3>

                                    @if ($progresList->isEmpty())
                                        <div class="empty-progress">
                                            Belum ada pembaruan progres dari teknisi.
                                        </div>
                                    @else
                                        <div class="timeline">
                                            @foreach ($progresList as $progres)
                                                @php
                                                    $statusProgres = $progres->status_progres
                                                        ?? $progres->status
                                                        ?? null;

                                                    $labelStatusProgres = match ($statusProgres) {
                                                        'mulai_dikerjakan' => 'Mulai Dikerjakan',
                                                        'dikerjakan' => 'Sedang Dikerjakan',
                                                        'selesai' => 'Selesai',
                                                        default => 'Pembaruan Progres',
                                                    };

                                                    $fotoProgres = $progres->foto_progres;

                                                    if (is_string($fotoProgres)) {
                                                        $hasilDecode = json_decode(
                                                            $fotoProgres,
                                                            true
                                                        );

                                                        $fotoProgres = is_array($hasilDecode)
                                                            ? $hasilDecode
                                                            : [$fotoProgres];
                                                    }

                                                    if (! is_array($fotoProgres)) {
                                                        $fotoProgres = [];
                                                    }
                                                @endphp

                                                <article
                                                    class="timeline-item"
                                                    wire:key="progres-{{ $progres->id }}"
                                                >
                                                    <span class="timeline-dot"></span>

                                                    <div class="timeline-status">
                                                        {{ $labelStatusProgres }}
                                                    </div>

                                                    <div class="timeline-meta">
                                                        {{ $progres->teknisi?->nama_teknisi ?? 'Teknisi' }}

                                                        ·

                                                        {{ optional($progres->tanggal_progres)->format('d M Y H:i')
                                                            ?? optional($progres->created_at)->format('d M Y H:i')
                                                            ?? '-' }}
                                                    </div>

                                                    <div class="timeline-description">
                                                        {{ $progres->deskripsi_progres
                                                            ?: 'Tidak ada catatan progres.' }}
                                                    </div>

                                                    @if (count($fotoProgres) > 0)
                                                        <div class="progress-photo-grid">
                                                            @foreach ($fotoProgres as $foto)
                                                                @php
                                                                    $foto = ltrim($foto, '/');

                                                                    $fotoUrl = str_starts_with($foto, 'http://')
                                                                        || str_starts_with($foto, 'https://')
                                                                            ? $foto
                                                                            : (
                                                                                str_starts_with($foto, 'storage/')
                                                                                    ? asset($foto)
                                                                                    : asset('storage/' . $foto)
                                                                            );
                                                                @endphp

                                                                <a
                                                                    href="{{ $fotoUrl }}"
                                                                    target="_blank"
                                                                    class="progress-photo-link"
                                                                    title="Buka foto ukuran penuh"
                                                                >
                                                                    <img
                                                                        src="{{ $fotoUrl }}"
                                                                        alt="Foto progres {{ $labelStatusProgres }}"
                                                                        class="progress-photo"
                                                                        loading="lazy"
                                                                    >
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </article>
                                            @endforeach
                                        </div>
                                    @endif
                                </section>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</div>