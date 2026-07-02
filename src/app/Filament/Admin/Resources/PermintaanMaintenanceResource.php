<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PermintaanMaintenanceResource\Pages;
use App\Models\PermintaanMaintenance;
use App\Models\PenugasanTeknisi;
use App\Models\Teknisi;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PermintaanMaintenanceResource extends Resource
{
    protected static ?string $model = PermintaanMaintenance::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Maintenance';

    protected static ?string $navigationLabel = 'Permintaan Maintenance';

    protected static ?string $modelLabel = 'Permintaan Maintenance';

    protected static ?string $pluralModelLabel = 'Permintaan Maintenance';

    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'user',
                'ruangan',
                'ruangan.gedung',
                'kategoriKerusakan',
                'penugasanTeknisi',
                'penugasanTeknisi.teknisi',
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Pelapor')
                    ->description('Data pelapor dari form publik atau akun user yang login.')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Akun Pelapor')
                            ->relationship(
                                name: 'user',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn (Builder $query) => $query->where('role', 'user')
                            )
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->native(false)
                            ->helperText('Kosong jika laporan dibuat tanpa login.'),

                        Forms\Components\TextInput::make('nama_pelapor')
                            ->label('Nama Pelapor')
                            ->maxLength(255)
                            ->placeholder('Nama pelapor'),

                        Forms\Components\TextInput::make('no_telepon_pelapor')
                            ->label('No Telepon')
                            ->maxLength(30)
                            ->placeholder('Nomor telepon pelapor'),

                        Forms\Components\TextInput::make('email_pelapor')
                            ->label('Email')
                            ->email()
                            ->maxLength(255)
                            ->placeholder('Email pelapor'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Data Permintaan')
                    ->schema([
                        Forms\Components\TextInput::make('kode_permintaan')
                            ->label('Kode Permintaan')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Otomatis dibuat oleh sistem'),

                        Forms\Components\Select::make('ruangan_id')
                            ->label('Ruangan')
                            ->relationship('ruangan', 'nama_ruangan')
                            ->getOptionLabelFromRecordUsing(function ($record): string {
                                return "{$record->kode_ruangan} - {$record->nama_ruangan}";
                            })
                            ->searchable()
                            ->preload()
                            ->required()
                            ->native(false),

                        Forms\Components\Select::make('kategori_kerusakan_id')
                            ->label('Kategori Kerusakan')
                            ->relationship('kategoriKerusakan', 'nama_kategori')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->native(false),

                        Forms\Components\TextInput::make('judul')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('foto_kerusakan')
                            ->label('Foto Kerusakan')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('foto-kerusakan')
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Status Permintaan')
                    ->schema([
                        Forms\Components\Select::make('prioritas')
                            ->label('Prioritas')
                            ->options([
                                'rendah' => 'Rendah',
                                'sedang' => 'Sedang',
                                'tinggi' => 'Tinggi',
                                'darurat' => 'Darurat',
                            ])
                            ->default('sedang')
                            ->required()
                            ->native(false),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'diajukan' => 'Diajukan',
                                'diverifikasi' => 'Diverifikasi',
                                'ditolak' => 'Ditolak',
                                'ditugaskan' => 'Ditugaskan',
                                'diproses' => 'Diproses',
                                'selesai' => 'Selesai',
                            ])
                            ->default('diajukan')
                            ->required()
                            ->live()
                            ->native(false),

                        Forms\Components\Textarea::make('catatan_admin')
                            ->label('Catatan Admin / Alasan Penolakan / Catatan Penutupan')
                            ->helperText('Wajib diisi jika status laporan ditolak. Bisa juga digunakan untuk catatan penutupan laporan.')
                            ->required(fn (Get $get): bool => $get('status') === 'ditolak')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Tanggal')
                    ->schema([
                        Forms\Components\DateTimePicker::make('tanggal_laporan')
                            ->label('Tanggal Laporan')
                            ->default(now()),

                        Forms\Components\DateTimePicker::make('tanggal_verifikasi')
                            ->label('Tanggal Verifikasi'),

                        Forms\Components\DateTimePicker::make('tanggal_selesai')
                            ->label('Tanggal Selesai'),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_permintaan')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nama_pelapor')
                    ->label('Pelapor')
                    ->getStateUsing(function ($record): string {
                        return $record->nama_pelapor
                            ?: $record->user?->name
                            ?: '-';
                    })
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('no_telepon_pelapor')
                    ->label('No Telepon')
                    ->getStateUsing(function ($record): string {
                        return $record->no_telepon_pelapor
                            ?: $record->user?->phone
                            ?: '-';
                    })
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('email_pelapor')
                    ->label('Email')
                    ->getStateUsing(function ($record): string {
                        return $record->email_pelapor
                            ?: $record->user?->email
                            ?: '-';
                    })
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('ruangan.nama_ruangan')
                    ->label('Ruangan')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(function ($state, $record): string {
                        if (! $record->ruangan) {
                            return '-';
                        }

                        return "{$record->ruangan->kode_ruangan} - {$record->ruangan->nama_ruangan}";
                    }),

                Tables\Columns\TextColumn::make('kategoriKerusakan.nama_kategori')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->limit(35),

                Tables\Columns\TextColumn::make('penugasanTeknisi.teknisi.nama_teknisi')
                    ->label('Teknisi')
                    ->placeholder('Belum ditugaskan')
                    ->badge()
                    ->color(fn ($state): string => $state ? 'success' : 'gray')
                    ->toggleable(),

                Tables\Columns\ImageColumn::make('foto_kerusakan')
                    ->label('Foto')
                    ->disk('public')
                    ->square()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('prioritas')
                    ->label('Prioritas')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'rendah' => 'Rendah',
                        'sedang' => 'Sedang',
                        'tinggi' => 'Tinggi',
                        'darurat' => 'Darurat',
                        default => '-',
                    })
                    ->color(fn (?string $state): string => match ($state) {
                        'rendah' => 'gray',
                        'sedang' => 'info',
                        'tinggi' => 'warning',
                        'darurat' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'diajukan' => 'Diajukan',
                        'diverifikasi' => 'Diverifikasi',
                        'ditolak' => 'Ditolak',
                        'ditugaskan' => 'Ditugaskan',
                        'diproses' => 'Diproses',
                        'selesai' => 'Selesai',
                        default => '-',
                    })
                    ->color(fn (?string $state): string => match ($state) {
                        'diajukan' => 'gray',
                        'diverifikasi' => 'info',
                        'ditolak' => 'danger',
                        'ditugaskan' => 'warning',
                        'diproses' => 'primary',
                        'selesai' => 'success',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('catatan_admin')
                    ->label('Catatan Admin')
                    ->limit(45)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('tanggal_laporan')
                    ->label('Tanggal Laporan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_verifikasi')
                    ->label('Tanggal Verifikasi')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('prioritas')
                    ->label('Prioritas')
                    ->options([
                        'rendah' => 'Rendah',
                        'sedang' => 'Sedang',
                        'tinggi' => 'Tinggi',
                        'darurat' => 'Darurat',
                    ]),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'diajukan' => 'Diajukan',
                        'diverifikasi' => 'Diverifikasi',
                        'ditolak' => 'Ditolak',
                        'ditugaskan' => 'Ditugaskan',
                        'diproses' => 'Diproses',
                        'selesai' => 'Selesai',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('tolak_laporan')
                    ->label('Tolak Laporan')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record): bool => in_array($record->status, [
                        'diajukan',
                        'diverifikasi',
                    ], true))
                    ->modalHeading('Tolak Laporan')
                    ->modalDescription('Masukkan alasan penolakan agar pelapor mengetahui penyebab laporannya tidak diproses.')
                    ->form([
                        Forms\Components\Textarea::make('alasan_penolakan')
                            ->label('Alasan Penolakan')
                            ->placeholder('Contoh: Laporan tidak valid karena lokasi tidak jelas atau kerusakan tidak ditemukan.')
                            ->required()
                            ->minLength(10)
                            ->rows(4),
                    ])
                    ->action(function ($record, array $data): void {
                        $record->update([
                            'status' => 'ditolak',
                            'catatan_admin' => $data['alasan_penolakan'],
                            'tanggal_verifikasi' => now(),
                        ]);

                        Notification::make()
                            ->title('Laporan berhasil ditolak')
                            ->body('Alasan penolakan telah disimpan pada catatan admin.')
                            ->danger()
                            ->send();
                    }),

                Tables\Actions\Action::make('assign_teknisi')
                    ->label('Assign Teknisi')
                    ->icon('heroicon-o-user-plus')
                    ->color('warning')
                    ->visible(fn ($record): bool => ! in_array($record->status, [
                        'ditolak',
                        'selesai',
                    ], true))
                    ->form([
                        Forms\Components\Select::make('teknisi_id')
                            ->label('Pilih Teknisi')
                            ->options(function (): array {
                                return Teknisi::query()
                                    ->orderBy('nama_teknisi')
                                    ->pluck('nama_teknisi', 'id')
                                    ->toArray();
                            })
                            ->searchable()
                            ->preload()
                            ->required()
                            ->native(false),

                        Forms\Components\Textarea::make('catatan_penugasan')
                            ->label('Catatan Penugasan')
                            ->placeholder('Contoh: Mohon cek dan perbaiki kerusakan ini.')
                            ->rows(4),
                    ])
                    ->fillForm(function ($record): array {
                        return [
                            'teknisi_id' => $record->penugasanTeknisi?->teknisi_id,
                            'catatan_penugasan' => $record->penugasanTeknisi?->catatan_penugasan,
                        ];
                    })
                    ->action(function ($record, array $data): void {
                        PenugasanTeknisi::query()->updateOrCreate(
                            [
                                'permintaan_maintenance_id' => $record->id,
                            ],
                            [
                                'teknisi_id' => $data['teknisi_id'],
                                'admin_id' => Filament::auth()->id(),
                                'tanggal_penugasan' => now(),
                                'catatan_penugasan' => $data['catatan_penugasan'] ?? null,
                            ]
                        );

                        $record->update([
                            'status' => 'ditugaskan',
                            'tanggal_verifikasi' => $record->tanggal_verifikasi ?? now(),
                            'catatan_admin' => $data['catatan_penugasan'] ?? $record->catatan_admin,
                        ]);

                        Notification::make()
                            ->title('Teknisi berhasil ditugaskan')
                            ->body('Laporan ini sekarang masuk ke menu Tugas Saya di panel teknisi.')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('tutup_laporan')
                    ->label('Tutup Laporan')
                    ->icon('heroicon-o-lock-closed')
                    ->color('success')
                    ->visible(fn ($record): bool => $record->status === 'selesai')
                    ->modalHeading('Tutup Laporan')
                    ->modalDescription('Pastikan hasil perbaikan teknisi sudah sesuai sebelum laporan ditutup.')
                    ->form([
                        Forms\Components\Textarea::make('catatan_penutupan')
                            ->label('Catatan Penutupan')
                            ->placeholder('Contoh: Perbaikan sudah dicek dan fasilitas sudah kembali normal.')
                            ->required()
                            ->minLength(10)
                            ->rows(4),
                    ])
                    ->requiresConfirmation()
                    ->action(function ($record, array $data): void {
                        $record->update([
                            'catatan_admin' => $data['catatan_penutupan'],
                            'tanggal_selesai' => $record->tanggal_selesai ?? now(),
                        ]);

                        Notification::make()
                            ->title('Laporan berhasil ditutup')
                            ->body('Catatan penutupan laporan telah disimpan.')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\EditAction::make(),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermintaanMaintenances::route('/'),
            'create' => Pages\CreatePermintaanMaintenance::route('/create'),
            'edit' => Pages\EditPermintaanMaintenance::route('/{record}/edit'),
        ];
    }
}