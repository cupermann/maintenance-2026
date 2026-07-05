<div>
    <style>
        .report-form-wrapper {
            width: 100%;
        }

        .success-box {
            margin-bottom: 22px;
            padding: 18px;
            border-radius: 18px;
            background: rgba(34, 197, 94, 0.12);
            border: 1px solid rgba(34, 197, 94, 0.28);
            color: #bbf7d0;
        }

        .success-box strong {
            color: #ffffff;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .form-field {
            margin-bottom: 16px;
        }

        .form-field.full {
            grid-column: span 2;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #cbd5e1;
        }

        .required-mark {
            color: #f87171;
        }

        .form-control {
            width: 100%;
            min-height: 46px;
            box-sizing: border-box;
            border-radius: 14px;
            border: 1px solid rgba(148, 163, 184, 0.22);
            background: rgba(7, 16, 29, 0.62);
            color: #f8fafc;
            font-size: 14px;
            padding: 0 15px;
            outline: none;
            transition: 0.2s ease;
        }

        textarea.form-control {
            min-height: 110px;
            padding-top: 13px;
            resize: vertical;
        }

        input[type="file"].form-control {
            padding: 10px 15px;
        }

        .form-control::placeholder {
            color: #64748b;
        }

        .form-control:focus {
            border-color: rgba(56, 189, 248, 0.75);
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.12);
            background: rgba(7, 16, 29, 0.85);
        }

        .form-control:disabled {
            cursor: not-allowed;
            opacity: 0.55;
            background: rgba(15, 23, 42, 0.50);
        }

        .field-helper {
            margin-top: 7px;
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.5;
        }

        .loading-message {
            margin-top: 7px;
            color: #93c5fd;
            font-size: 12px;
        }

        .error-message {
            margin-top: 7px;
            font-size: 12px;
            color: #fca5a5;
        }

        .submit-button {
            width: 100%;
            height: 48px;
            border: 0;
            border-radius: 15px;
            cursor: pointer;
            color: #ffffff;
            font-weight: 700;
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            box-shadow: 0 12px 30px rgba(37, 99, 235, 0.28);
            transition: 0.2s ease;
        }

        .submit-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 36px rgba(37, 99, 235, 0.35);
        }

        .submit-button:disabled {
            cursor: not-allowed;
            opacity: 0.7;
        }

        .back-link {
            display: inline-block;
            margin-top: 16px;
            color: #7dd3fc;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-field.full {
                grid-column: span 1;
            }
        }
    </style>

    <div class="report-form-wrapper">
        @if ($kode_berhasil)
            <div class="success-box">
                <strong>Laporan berhasil dikirim.</strong>

                <div style="margin-top: 8px;">
                    Kode permintaan Anda:
                    <strong>{{ $kode_berhasil }}</strong>
                </div>

                <div style="margin-top: 4px; font-size: 13px;">
                    Simpan kode ini untuk mengecek status laporan.
                </div>
            </div>
        @endif

        <form wire:submit.prevent="submit">
            <div class="form-grid">
                {{-- Nama Pelapor --}}
                <div class="form-field">
                    <label class="form-label" for="nama_pelapor">
                        Nama Pelapor
                        <span class="required-mark">*</span>
                    </label>

                    <input
                        id="nama_pelapor"
                        type="text"
                        wire:model.defer="nama_pelapor"
                        class="form-control"
                        placeholder="Masukkan nama"
                    >

                    @error('nama_pelapor')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nomor Telepon --}}
                <div class="form-field">
                    <label class="form-label" for="no_telepon_pelapor">
                        No. Telepon
                        <span class="required-mark">*</span>
                    </label>

                    <input
                        id="no_telepon_pelapor"
                        type="text"
                        wire:model.defer="no_telepon_pelapor"
                        class="form-control"
                        placeholder="Contoh: 08123456789"
                    >

                    @error('no_telepon_pelapor')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-field">
                    <label class="form-label" for="email_pelapor">
                        Email Opsional
                    </label>

                    <input
                        id="email_pelapor"
                        type="email"
                        wire:model.defer="email_pelapor"
                        class="form-control"
                        placeholder="nama@email.com"
                    >

                    @error('email_pelapor')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Prioritas --}}
                <div class="form-field">
                    <label class="form-label" for="prioritas">
                        Prioritas
                        <span class="required-mark">*</span>
                    </label>

                    <select
                        id="prioritas"
                        wire:model.defer="prioritas"
                        class="form-control"
                    >
                        <option value="rendah">Rendah</option>
                        <option value="sedang">Sedang</option>
                        <option value="tinggi">Tinggi</option>
                        <option value="darurat">Darurat</option>
                    </select>

                    @error('prioritas')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Gedung --}}
                <div class="form-field">
                    <label class="form-label" for="gedung_id">
                        Gedung
                        <span class="required-mark">*</span>
                    </label>

                    <select
                        id="gedung_id"
                        wire:model.live="gedung_id"
                        class="form-control"
                    >
                        <option value="">Pilih gedung</option>

                        @foreach ($gedungs as $gedung)
                            <option value="{{ $gedung->id }}">
                                {{ $gedung->nama_gedung }}
                            </option>
                        @endforeach
                    </select>

                    <div
                        wire:loading
                        wire:target="gedung_id"
                        class="loading-message"
                    >
                        Memuat daftar ruangan...
                    </div>

                    @error('gedung_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Ruangan --}}
                <div class="form-field">
                    <label class="form-label" for="ruangan_id">
                        Ruangan
                        <span class="required-mark">*</span>
                    </label>

                    <select
                        id="ruangan_id"
                        wire:key="ruangan-select-{{ $gedung_id ?? 'kosong' }}"
                        wire:model="ruangan_id"
                        class="form-control"
                        @disabled(blank($gedung_id))
                    >
                        <option value="">
                            @if (blank($gedung_id))
                                Pilih gedung terlebih dahulu
                            @elseif ($ruangans->isEmpty())
                                Tidak ada ruangan pada gedung ini
                            @else
                                Pilih ruangan
                            @endif
                        </option>

                        @foreach ($ruangans as $ruangan)
                            <option value="{{ $ruangan->id }}">
                                {{ $ruangan->kode_ruangan }}
                                -
                                {{ $ruangan->nama_ruangan }}
                            </option>
                        @endforeach
                    </select>

                    @if (blank($gedung_id))
                        <div class="field-helper">
                            Pilih gedung agar daftar ruangan dapat ditampilkan.
                        </div>
                    @endif

                    @error('ruangan_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kategori Kerusakan --}}
                <div class="form-field full">
                    <label class="form-label" for="kategori_kerusakan_id">
                        Kategori Kerusakan
                        <span class="required-mark">*</span>
                    </label>

                    <select
                        id="kategori_kerusakan_id"
                        wire:model.defer="kategori_kerusakan_id"
                        class="form-control"
                    >
                        <option value="">Pilih kategori</option>

                        @foreach ($kategoriKerusakans as $kategori)
                            <option value="{{ $kategori->id }}">
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>

                    @error('kategori_kerusakan_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Judul --}}
                <div class="form-field full">
                    <label class="form-label" for="judul">
                        Judul Kerusakan
                        <span class="required-mark">*</span>
                    </label>

                    <input
                        id="judul"
                        type="text"
                        wire:model.defer="judul"
                        class="form-control"
                        placeholder="Contoh: AC ruang kelas tidak dingin"
                    >

                    @error('judul')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="form-field full">
                    <label class="form-label" for="deskripsi">
                        Deskripsi Kerusakan
                        <span class="required-mark">*</span>
                    </label>

                    <textarea
                        id="deskripsi"
                        wire:model.defer="deskripsi"
                        class="form-control"
                        placeholder="Jelaskan kondisi, lokasi, dan dampak kerusakan yang terjadi"
                    ></textarea>

                    @error('deskripsi')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Foto --}}
                <div class="form-field full">
                    <label class="form-label" for="foto_kerusakan">
                        Foto Kerusakan
                        <span class="required-mark">*</span>
                    </label>

                    <input
                        id="foto_kerusakan"
                        type="file"
                        wire:model="foto_kerusakan"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp,image/*"
                    >

                    <div class="field-helper">
                        Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    </div>

                    @error('foto_kerusakan')
                        <div class="error-message">{{ $message }}</div>
                    @enderror

                    <div
                        wire:loading
                        wire:target="foto_kerusakan"
                        class="loading-message"
                    >
                        Mengunggah foto...
                    </div>
                </div>
            </div>

            <button
                type="submit"
                class="submit-button"
                wire:loading.attr="disabled"
                wire:target="submit,foto_kerusakan"
            >
                <span wire:loading.remove wire:target="submit">
                    Kirim Laporan
                </span>

                <span wire:loading wire:target="submit">
                    Mengirim...
                </span>

                <span wire:loading wire:target="foto_kerusakan">
                    Menunggu unggahan foto...
                </span>
            </button>
        </form>

        <a
            href="{{ route('pelapor.dashboard') }}"
            class="back-link"
        >
            ← Kembali ke Dashboard Pelapor
        </a>
    </div>
</div>