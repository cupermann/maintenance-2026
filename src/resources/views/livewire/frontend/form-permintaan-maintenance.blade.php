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

        .form-control::placeholder {
            color: #64748b;
        }

        .form-control:focus {
            border-color: rgba(56, 189, 248, 0.75);
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.12);
            background: rgba(7, 16, 29, 0.85);
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
                    Kode permintaan kamu:
                    <strong>{{ $kode_berhasil }}</strong>
                </div>
                <div style="margin-top: 4px; font-size: 13px;">
                    Simpan kode ini untuk mengecek status laporan.
                </div>
            </div>
        @endif

        <form wire:submit.prevent="submit">
            <div class="form-grid">
                <div class="form-field">
                    <label class="form-label">Nama Pelapor</label>
                    <input type="text" wire:model.defer="nama_pelapor" class="form-control" placeholder="Masukkan nama">
                    @error('nama_pelapor') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-field">
                    <label class="form-label">No Telepon</label>
                    <input type="text" wire:model.defer="no_telepon_pelapor" class="form-control" placeholder="Contoh: 08123456789">
                    @error('no_telepon_pelapor') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-field">
                    <label class="form-label">Email Opsional</label>
                    <input type="email" wire:model.defer="email_pelapor" class="form-control" placeholder="nama@email.com">
                    @error('email_pelapor') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-field">
                    <label class="form-label">Prioritas</label>
                    <select wire:model.defer="prioritas" class="form-control">
                        <option value="rendah">Rendah</option>
                        <option value="sedang">Sedang</option>
                        <option value="tinggi">Tinggi</option>
                        <option value="darurat">Darurat</option>
                    </select>
                    @error('prioritas') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-field">
                    <label class="form-label">Ruangan</label>
                    <select wire:model.defer="ruangan_id" class="form-control">
                        <option value="">Pilih ruangan</option>
                        @foreach ($ruangans as $ruangan)
                            <option value="{{ $ruangan->id }}">
                                {{ $ruangan->kode_ruangan }} - {{ $ruangan->nama_ruangan }}
                                @if ($ruangan->gedung)
                                    / {{ $ruangan->gedung->nama_gedung }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('ruangan_id') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-field">
                    <label class="form-label">Kategori Kerusakan</label>
                    <select wire:model.defer="kategori_kerusakan_id" class="form-control">
                        <option value="">Pilih kategori</option>
                        @foreach ($kategoriKerusakans as $kategori)
                            <option value="{{ $kategori->id }}">
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_kerusakan_id') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-field full">
                    <label class="form-label">Judul Kerusakan</label>
                    <input type="text" wire:model.defer="judul" class="form-control" placeholder="Contoh: AC ruang kelas tidak dingin">
                    @error('judul') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-field full">
                    <label class="form-label">Deskripsi Kerusakan</label>
                    <textarea wire:model.defer="deskripsi" class="form-control" placeholder="Jelaskan detail kerusakan yang terjadi"></textarea>
                    @error('deskripsi') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-field full">
                    <label class="form-label">Foto Kerusakan</label>
                    <input type="file" wire:model="foto_kerusakan" class="form-control" accept="image/*">
                    @error('foto_kerusakan') <div class="error-message">{{ $message }}</div> @enderror

                    <div wire:loading wire:target="foto_kerusakan" style="margin-top: 8px; font-size: 12px; color: #93c5fd;">
                        Mengunggah foto...
                    </div>
                </div>
            </div>

            <button type="submit" class="submit-button" wire:loading.attr="disabled" wire:target="submit">
                <span wire:loading.remove wire:target="submit">Kirim Laporan</span>
                <span wire:loading wire:target="submit">Mengirim...</span>
            </button>
        </form>

        <a href="{{ url('/') }}" class="back-link">
            ← Kembali ke halaman login
        </a>
    </div>
</div>