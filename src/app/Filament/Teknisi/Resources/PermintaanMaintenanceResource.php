<?php

namespace App\Filament\Teknisi\Resources;

use App\Filament\Teknisi\Resources\PermintaanMaintenanceResource\Pages;
use App\Models\PermintaanMaintenance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PermintaanMaintenanceResource extends Resource
{
    protected static ?string $model = PermintaanMaintenance::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Maintenance';

    protected static ?string $navigationLabel = 'Laporan Masuk';

    protected static ?string $modelLabel = 'Laporan Masuk';

    protected static ?string $pluralModelLabel = 'Laporan Masuk';

    protected static ?int $navigationSort = 1;

    protected static bool $shouldRegisterNavigation = true;

    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'teknisi';
    }

    public static function canView($record): bool
    {
        return auth()->user()?->role === 'teknisi';
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Laporan')
                    ->schema([
                        Forms\Components\TextInput::make('kode_permintaan')
                            ->label('Kode Permintaan')
                            ->disabled(),

                        Forms\Components\TextInput::make('nama_pelapor')
                            ->label('Nama Pelapor')
                            ->disabled(),

                        Forms\Components\TextInput::make('no_telepon_pelapor')
                            ->label('No Telepon')
                            ->disabled(),

                        Forms\Components\TextInput::make('email_pelapor')
                            ->label('Email')
                            ->disabled(),

                        Forms\Components\TextInput::make('ruangan.nama_ruangan')
                            ->label('Ruangan')
                            ->disabled(),

                        Forms\Components\TextInput::make('kategoriKerusakan.nama_kategori')
                            ->label('Kategori Kerusakan')
                            ->disabled(),

                        Forms\Components\TextInput::make('judul')
                            ->label('Judul')
                            ->disabled()
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->disabled()
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('foto_kerusakan')
                            ->label('Foto Kerusakan')
                            ->disk('public')
                            ->directory('foto-kerusakan')
                            ->image()
                            ->disabled()
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\TextInput::make('prioritas')
                            ->label('Prioritas')
                            ->disabled(),

                        Forms\Components\TextInput::make('status')
                            ->label('Status')
                            ->disabled(),

                        Forms\Components\DateTimePicker::make('tanggal_laporan')
                            ->label('Tanggal Laporan')
                            ->disabled(),
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
                    ->getStateUsing(fn ($record) => $record->nama_pelapor ?: $record->user?->name ?: '-')
                    ->searchable(),

                Tables\Columns\TextColumn::make('no_telepon_pelapor')
                    ->label('No Telepon')
                    ->searchable(),

                Tables\Columns\TextColumn::make('ruangan.nama_ruangan')
                    ->label('Ruangan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('kategoriKerusakan.nama_kategori')
                    ->label('Kategori')
                    ->searchable(),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->limit(35),

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

                Tables\Columns\TextColumn::make('tanggal_laporan')
                    ->label('Tanggal Laporan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'diajukan' => 'Diajukan',
                        'diverifikasi' => 'Diverifikasi',
                        'ditugaskan' => 'Ditugaskan',
                        'diproses' => 'Dikerjakan',
                        'selesai' => 'Selesai',
                    ]),

                Tables\Filters\SelectFilter::make('prioritas')
                    ->label('Prioritas')
                    ->options([
                        'rendah' => 'Rendah',
                        'sedang' => 'Sedang',
                        'tinggi' => 'Tinggi',
                        'darurat' => 'Darurat',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermintaanMaintenances::route('/'),
            'view' => Pages\ViewPermintaanMaintenance::route('/{record}'),
        ];
    }
}