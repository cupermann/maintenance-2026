<div>
    <style>
        .search-box {
            margin-bottom: 26px;
            padding: 24px;
            border-radius: 24px;
            background: rgba(15, 23, 42, 0.58);
            border: 1px solid rgba(148, 163, 184, 0.20);
        }

        .search-title {
            margin: 0 0 8px;
            color: #ffffff;
            font-size: 20px;
            font-weight: 800;
        }

        .search-desc {
            margin: 0 0 18px;
            color: #9fb4c9;
            font-size: 14px;
            line-height: 1.6;
        }

        .search-row {
            display: flex;
            gap: 12px;
        }

        .search-input {
            flex: 1;
            min-height: 48px;
            border-radius: 15px;
            border: 1px solid rgba(148, 163, 184, 0.22);
            background: rgba(7, 16, 29, 0.72);
            color: #f8fafc;
            font-size: 14px;
            padding: 0 15px;
            outline: none;
        }

        .search-input:focus {
            border-color: rgba(56, 189, 248, 0.75);
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.12);
        }

        .search-button {
            min-height: 48px;
            padding: 0 22px;
            border: 0;
            border-radius: 15px;
            cursor: pointer;
            color: #ffffff;
            font-weight: 800;
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            box-shadow: 0 12px 30px rgba(37, 99, 235, 0.28);
        }

        .error-message {
            margin-top: 8px;
            font-size: 12px;
            color: #fca5a5;
        }

        .empty-box {
            padding: 24px;
            border-radius: 22px;
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(148, 163, 184, 0.18);
            color: #9fb4c9;
            text-align: center;
        }

        .report-list {
            display: grid;
            gap: 18px;
        }

        .report-card-item {
            padding: 24px;
            border-radius: 24px;
            background: rgba(15, 23, 42, 0.58);
            border: 1px solid rgba(148, 163, 184, 0.20);
        }

        .report-top {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
        }

        .report-code {
            color: #7dd3fc;
            font-size: 13px;
            font-weight: 800;
        }

        .report-title {
            margin: 5px 0 0;
            color: #ffffff;
            font-size: 20px;
            font-weight: 800;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            height: 32px;
            padding: 0 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .status-blue {
            color: #bfdbfe;
            background: rgba(59, 130, 246, 0.16);
            border: 1px solid rgba(59, 130, 246, 0.26);
        }

        .status-cyan {
            color: #a5f3fc;
            background: rgba(6, 182, 212, 0.16);
            border: 1px solid rgba(6, 182, 212, 0.26);
        }

        .status-red {
            color: #fecaca;
            background: rgba(239, 68, 68, 0.16);
            border: 1px solid rgba(239, 68, 68, 0.26);
        }

        .status-purple {
            color: #ddd6fe;
            background: rgba(139, 92, 246, 0.16);
            border: 1px solid rgba(139, 92, 246, 0.26);
        }

        .status-yellow {
            color: #fde68a;
            background: rgba(245, 158, 11, 0.16);
            border: 1px solid rgba(245, 158, 11, 0.26);
        }

        .status-green {
            color: #bbf7d0;
            background: rgba(34, 197, 94, 0.16);
            border: 1px solid rgba(34, 197, 94, 0.26);
        }

        .status-gray {
            color: #cbd5e1;
            background: rgba(148, 163, 184, 0.16);
            border: 1px solid rgba(148, 163, 184, 0.26);
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 18px;
        }

        .detail-item {
            padding: 14px;
            border-radius: 16px;
            background: rgba(7, 16, 29, 0.52);
            border: 1px solid rgba(148, 163, 184, 0.12);
        }

        .detail-label {
            margin-bottom: 5px;
            color: #94a3b8;
            font-size: 12px;
            font-weight: 700;
        }

        .detail-value {
            color: #e2e8f0;
            font-size: 14px;
            line-height: 1.5;
        }

        .progress-section {
            margin-top: 18px;
            padding-top: 18px;
            border-top: 1px solid rgba(148, 163, 184, 0.18);
        }

        .progress-title {
            margin: 0 0 14px;
            color: #ffffff;
            font-size: 16px;
            font-weight: 800;
        }

        .timeline {
            display: grid;
            gap: 12px;
        }

        .timeline-item {
            position: relative;
            padding: 14px 14px 14px 42px;
            border-radius: 16px;
            background: rgba(7, 16, 29, 0.48);
            border: 1px solid rgba(148, 163, 184, 0.12);
        }

        .timeline-dot {
            position: absolute;
            top: 17px;
            left: 16px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #38bdf8;
            box-shadow: 0 0 0 5px rgba(56, 189, 248, 0.12);
        }

        .timeline-status {
            color: #ffffff;
            font-size: 14px;
            font-weight: 800;
        }

        .timeline-desc {
            margin-top: 5px;
            color: #9fb4c9;
            font-size: 13px;
            line-height: 1.6;
        }

        .timeline-date {
            margin-top: 6px;
            color: #64748b;
            font-size: 12px;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #7dd3fc;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .search-row {
                flex-direction: column;
            }

            .report-top {
                flex-direction: column;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="search-box">
        <h2 class="search-title">
            Cek Riwayat Laporan
        </h2>

        <p class="search-desc">
            Masukkan kode permintaan, nomor telepon, atau email pelapor untuk melihat status dan progres perbaikan.
        </p>

        <form wire:submit.prevent="cari">
            <div class="search-row">
                <input
                    type="text"
                    wire:model.defer="keyword"
                    class="search-input"
                    placeholder="Contoh: PM-20260515034115-631 atau 08123456789"
                >

                <button type="submit" class="search-button">
                    Cari
                </button>
            </div>

            @error('keyword')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </form>
    </div>

    @if ($sudahDicari && $laporans->isEmpty())
        <div class="empty-box">
            Data laporan tidak ditemukan. Pastikan kode permintaan atau nomor telepon sudah benar.
        </div>
    @endif

    @if ($laporans->isNotEmpty())
        <div class="report-list">
            @foreach ($laporans as $laporan)
                <div class="report-card-item">
                    <div class="report-top">
                        <div>
                            <div class="report-code">
                                {{ $laporan->kode_permintaan }}
                            </div>

                            <h3 class="report-title">
                                {{ $laporan->judul }}
                            </h3>
                        </div>

                        <span class="status-badge {{ $this->getStatusClass($laporan->status) }}">
                            {{ $this->getStatusLabel($laporan->status) }}
                        </span>
                    </div>

                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Pelapor</div>
                            <div class="detail-value">
                                {{ $laporan->nama_pelapor ?? $laporan->user?->name ?? '-' }}
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">No Telepon</div>
                            <div class="detail-value">
                                {{ $laporan->no_telepon_pelapor ?? '-' }}
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Ruangan</div>
                            <div class="detail-value">
                                {{ $laporan->ruangan?->nama_ruangan ?? '-' }}
                                @if ($laporan->ruangan?->gedung)
                                    / {{ $laporan->ruangan->gedung->nama_gedung }}
                                @endif
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Kategori</div>
                            <div class="detail-value">
                                {{ $laporan->kategoriKerusakan?->nama_kategori ?? '-' }}
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Prioritas</div>
                            <div class="detail-value">
                                {{ ucfirst($laporan->prioritas) }}
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Tanggal Laporan</div>
                            <div class="detail-value">
                                {{ $laporan->tanggal_laporan ? $laporan->tanggal_laporan->format('d M Y H:i') : '-' }}
                            </div>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Deskripsi</div>
                        <div class="detail-value">
                            {{ $laporan->deskripsi }}
                        </div>
                    </div>

                    <div class="progress-section">
                        <h4 class="progress-title">
                            Progres Perbaikan
                        </h4>

                        @php
                            $progresList = $laporan->progresPerbaikans
                                ->sortByDesc('tanggal_progres');
                        @endphp

                        @if ($progresList->isEmpty())
                            <div class="empty-box">
                                Belum ada progres perbaikan. Laporan masih dalam proses verifikasi atau penugasan.
                            </div>
                        @else
                            <div class="timeline">
                                @foreach ($progresList as $progres)
                                    <div class="timeline-item">
                                        <div class="timeline-dot"></div>

                                        <div class="timeline-status">
                                            {{ ucfirst($progres->status_progres ?? $progres->status ?? 'Progres') }}
                                        </div>

                                        <div class="timeline-desc">
                                            {{ $progres->deskripsi_progres ?? $progres->catatan ?? $progres->deskripsi ?? '-' }}
                                        </div>

                                         @if ($progres->teknisi)
                                            <div class="timeline-desc">
                                                Teknisi: {{ $progres->teknisi->nama_teknisi }}
                                            </div>
                                        @endif

                                        <div class="timeline-date">
                                            {{ $progres->tanggal_progres ? $progres->tanggal_progres->format('d M Y H:i') : $progres->created_at?->format('d M Y H:i') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <a href="{{ route('pelapor.dashboard') }}" class="back-link">
        ← Kembali ke Dashboard Pelapor
    </a>
</div>