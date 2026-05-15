<?php

namespace App\Filament\Teknisi\Resources;

use App\Filament\Teknisi\Resources\PenugasanTeknisiResource\Pages;
use App\Models\PenugasanTeknisi;
use App\Models\ProgresPerbaikan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PenugasanTeknisiResource extends Resource
{
    protected static ?string $model = PenugasanTeknisi::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationGroup = 'Maintenance';

    protected static ?string $navigationLabel = 'Tugas Saya';

    protected static ?string $modelLabel = 'Tugas Saya';

    protected static ?string $pluralModelLabel = 'Tugas Saya';

    protected static ?int $navigationSort = 2;

    protected static bool $shouldRegisterNavigation = true;

    protected static function isTeknisi(): bool
    {
        $user = auth()->user();

        return $user && (
            $user->role === 'teknisi' ||
            $user->hasRole('teknisi')
        );
    }

    public static function canAccess(): bool
    {
        return static::isTeknisi();
    }

    public static function canViewAny(): bool
    {
        return static::isTeknisi();
    }

    public static function canView($record): bool
    {
        return static::isTeknisi();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        $teknisiId = auth()->user()?->teknisi?->id;

        return parent::getEloquentQuery()
            ->with([
                'permintaanMaintenance.user',
                'permintaanMaintenance.ruangan.gedung',
                'permintaanMaintenance.kategoriKerusakan',
                'permintaanMaintenance.progresPerbaikans',
                'teknisi.user',
                'admin',
            ])
            ->when(
                filled($teknisiId),
                fn (Builder $query) => $query->where('teknisi_id', $teknisiId),
                fn (Builder $query) => $query->whereRaw('1 = 0')
            );
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Penugasan')
                    ->schema([
                        Forms\Components\Placeholder::make('kode_permintaan')
                            ->label('Kode Permintaan')
                            ->content(fn ($record) => $record->permintaanMaintenance?->kode_permintaan ?? '-'),

                        Forms\Components\Placeholder::make('judul_laporan')
                            ->label('Judul Laporan')
                            ->content(fn ($record) => $record->permintaanMaintenance?->judul ?? '-'),

                        Forms\Components\Placeholder::make('pelapor')
                            ->label('Pelapor')
                            ->content(fn ($record) => $record->permintaanMaintenance?->nama_pelapor
                                ?: $record->permintaanMaintenance?->user?->name
                                ?: '-'),

                        Forms\Components\Placeholder::make('no_telepon')
                            ->label('No Telepon')
                            ->content(fn ($record) => $record->permintaanMaintenance?->no_telepon_pelapor ?? '-'),

                        Forms\Components\Placeholder::make('email')
                            ->label('Email')
                            ->content(fn ($record) => $record->permintaanMaintenance?->email_pelapor ?? '-'),

                        Forms\Components\Placeholder::make('admin_penugas')
                            ->label('Admin Penugas')
                            ->content(fn ($record) => $record->admin?->name ?? '-'),

                        Forms\Components\Placeholder::make('tanggal_penugasan')
                            ->label('Tanggal Penugasan')
                            ->content(fn ($record) => $record->tanggal_penugasan?->format('d M Y H:i') ?? '-'),

                        Forms\Components\Placeholder::make('catatan_penugasan')
                            ->label('Catatan Penugasan')
                            ->content(fn ($record) => $record->catatan_penugasan ?? '-')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Detail Laporan')
                    ->schema([
                        Forms\Components\Placeholder::make('ruangan')
                            ->label('Ruangan')
                            ->content(function ($record) {
                                $ruangan = $record->permintaanMaintenance?->ruangan;
                                $gedung = $ruangan?->gedung;

                                if (! $ruangan) {
                                    return '-';
                                }

                                return $gedung
                                    ? "{$ruangan->nama_ruangan} - {$gedung->nama_gedung}"
                                    : $ruangan->nama_ruangan;
                            }),

                        Forms\Components\Placeholder::make('kategori')
                            ->label('Kategori Kerusakan')
                            ->content(fn ($record) => $record->permintaanMaintenance?->kategoriKerusakan?->nama_kategori ?? '-'),

                        Forms\Components\Placeholder::make('prioritas')
                            ->label('Prioritas')
                            ->content(fn ($record) => ucfirst($record->permintaanMaintenance?->prioritas ?? '-')),

                        Forms\Components\Placeholder::make('status')
                            ->label('Status')
                            ->content(fn ($record) => match ($record->permintaanMaintenance?->status) {
                                'diajukan' => 'Diajukan',
                                'diverifikasi' => 'Diverifikasi',
                                'ditolak' => 'Ditolak',
                                'ditugaskan' => 'Ditugaskan',
                                'diproses' => 'Dikerjakan',
                                'selesai' => 'Selesai',
                                default => '-',
                            }),

                        Forms\Components\Placeholder::make('deskripsi')
                            ->label('Deskripsi Kerusakan')
                            ->content(fn ($record) => $record->permintaanMaintenance?->deskripsi ?? '-')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('permintaanMaintenance.foto_kerusakan')
                            ->label('Foto Kerusakan')
                            ->disk('public')
                            ->image()
                            ->disabled()
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('permintaanMaintenance.kode_permintaan')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('permintaanMaintenance.judul')
                    ->label('Judul')
                    ->searchable()
                    ->limit(35),

                Tables\Columns\TextColumn::make('permintaanMaintenance.nama_pelapor')
                    ->label('Pelapor')
                    ->getStateUsing(fn ($record) => $record->permintaanMaintenance?->nama_pelapor
                        ?: $record->permintaanMaintenance?->user?->name
                        ?: '-')
                    ->searchable(),

                Tables\Columns\TextColumn::make('permintaanMaintenance.no_telepon_pelapor')
                    ->label('No Telepon')
                    ->searchable(),

                Tables\Columns\TextColumn::make('permintaanMaintenance.ruangan.nama_ruangan')
                    ->label('Ruangan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('permintaanMaintenance.kategoriKerusakan.nama_kategori')
                    ->label('Kategori')
                    ->searchable(),

                Tables\Columns\TextColumn::make('permintaanMaintenance.prioritas')
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

                Tables\Columns\TextColumn::make('permintaanMaintenance.status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'diajukan' => 'Diajukan',
                        'diverifikasi' => 'Diverifikasi',
                        'ditolak' => 'Ditolak',
                        'ditugaskan' => 'Ditugaskan',
                        'diproses' => 'Dikerjakan',
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

                Tables\Columns\TextColumn::make('tanggal_penugasan')
                    ->label('Tanggal Penugasan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_laporan')
                    ->label('Status Laporan')
                    ->options([
                        'ditugaskan' => 'Ditugaskan',
                        'diproses' => 'Dikerjakan',
                        'selesai' => 'Selesai',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        if (! filled($data['value'])) {
                            return $query;
                        }

                        return $query->whereHas('permintaanMaintenance', function (Builder $query) use ($data) {
                            $query->where('status', $data['value']);
                        });
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Detail'),

                Tables\Actions\Action::make('mulai_dikerjakan')
                    ->label('Mulai Dikerjakan')
                    ->icon('heroicon-o-play')
                    ->color('primary')
                    ->visible(fn ($record): bool => in_array($record->permintaanMaintenance?->status, [
                        'ditugaskan',
                        'diverifikasi',
                    ]))
                    ->form([
                        Forms\Components\Textarea::make('deskripsi_progres')
                            ->label('Catatan Progres')
                            ->placeholder('Contoh: Teknisi mulai mengecek kerusakan.')
                            ->required()
                            ->rows(4),

                        Forms\Components\FileUpload::make('foto_progres')
                            ->label('Foto Progres')
                            ->image()
                            ->disk('public')
                            ->directory('foto-progres')
                            ->imageEditor(),
                    ])
                    ->action(function ($record, array $data): void {
                        ProgresPerbaikan::create([
                            'permintaan_maintenance_id' => $record->permintaan_maintenance_id,
                            'teknisi_id' => $record->teknisi_id,
                            'status_progres' => 'dikerjakan',
                            'deskripsi_progres' => $data['deskripsi_progres'],
                            'foto_progres' => $data['foto_progres'] ?? null,
                            'tanggal_progres' => now(),
                        ]);

                        $record->permintaanMaintenance?->update([
                            'status' => 'diproses',
                        ]);

                        Notification::make()
                            ->title('Progres berhasil diperbarui')
                            ->body('Status laporan berubah menjadi dikerjakan.')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('selesai')
                    ->label('Tandai Selesai')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record): bool => $record->permintaanMaintenance?->status === 'diproses')
                    ->requiresConfirmation()
                    ->modalHeading('Tandai perbaikan selesai?')
                    ->modalDescription('Status laporan akan berubah menjadi selesai dan dapat dipantau oleh pelapor.')
                    ->form([
                        Forms\Components\Textarea::make('deskripsi_progres')
                            ->label('Catatan Penyelesaian')
                            ->placeholder('Contoh: Lampu sudah diganti dan berfungsi normal.')
                            ->required()
                            ->rows(4),

                        Forms\Components\FileUpload::make('foto_progres')
                            ->label('Foto Hasil Perbaikan')
                            ->image()
                            ->disk('public')
                            ->directory('foto-progres')
                            ->imageEditor(),
                    ])
                    ->action(function ($record, array $data): void {
                        ProgresPerbaikan::create([
                            'permintaan_maintenance_id' => $record->permintaan_maintenance_id,
                            'teknisi_id' => $record->teknisi_id,
                            'status_progres' => 'selesai',
                            'deskripsi_progres' => $data['deskripsi_progres'],
                            'foto_progres' => $data['foto_progres'] ?? null,
                            'tanggal_progres' => now(),
                        ]);

                        $record->permintaanMaintenance?->update([
                            'status' => 'selesai',
                            'tanggal_selesai' => now(),
                        ]);

                        Notification::make()
                            ->title('Laporan selesai')
                            ->body('Status laporan berhasil diubah menjadi selesai.')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenugasanTeknisis::route('/'),
            'view' => Pages\ViewPenugasanTeknisi::route('/{record}'),
        ];
    }
}