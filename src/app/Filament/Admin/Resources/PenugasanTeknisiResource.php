<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PenugasanTeknisiResource\Pages;
use App\Models\PenugasanTeknisi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PenugasanTeknisiResource extends Resource
{
    protected static ?string $model = PenugasanTeknisi::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationGroup = 'Maintenance';

    protected static ?string $navigationLabel = 'Penugasan Teknisi';

    protected static ?string $modelLabel = 'Penugasan Teknisi';

    protected static ?string $pluralModelLabel = 'Penugasan Teknisi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Penugasan')
                    ->schema([
                        Forms\Components\Select::make('permintaan_maintenance_id')
                            ->label('Kode Permintaan')
                            ->relationship('permintaanMaintenance', 'kode_permintaan')
                            ->getOptionLabelFromRecordUsing(function ($record): string {
                                $pelapor = $record->nama_pelapor
                                    ?: $record->user?->name
                                    ?: 'Tanpa nama';

                                return "{$record->kode_permintaan} - {$record->judul} - {$pelapor}";
                            })
                            ->searchable()
                            ->preload()
                            ->required()
                            ->native(false),

                        Forms\Components\Select::make('teknisi_id')
                            ->label('Teknisi')
                            ->relationship('teknisi', 'nama_teknisi')
                            ->getOptionLabelFromRecordUsing(function ($record): string {
                                return "{$record->nama_teknisi} - {$record->keahlian}";
                            })
                            ->searchable()
                            ->preload()
                            ->required()
                            ->native(false),

                        Forms\Components\Hidden::make('admin_id')
                            ->default(fn () => auth()->id())
                            ->required(),

                        Forms\Components\DateTimePicker::make('tanggal_penugasan')
                            ->label('Tanggal Penugasan')
                            ->default(now())
                            ->required(),

                        Forms\Components\Textarea::make('catatan_penugasan')
                            ->label('Catatan Penugasan')
                            ->rows(4)
                            ->placeholder('Contoh: Mohon teknisi segera mengecek AC di ruangan tersebut.')
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
                    ->label('Kode Permintaan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('permintaanMaintenance.judul')
                    ->label('Judul Laporan')
                    ->searchable()
                    ->limit(35),

                Tables\Columns\TextColumn::make('permintaanMaintenance.nama_pelapor')
                    ->label('Pelapor')
                    ->getStateUsing(function ($record): string {
                        return $record->permintaanMaintenance?->nama_pelapor
                            ?: $record->permintaanMaintenance?->user?->name
                            ?: '-';
                    })
                    ->searchable(),

                Tables\Columns\TextColumn::make('teknisi.nama_teknisi')
                    ->label('Teknisi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('admin.name')
                    ->label('Admin')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_penugasan')
                    ->label('Tanggal Penugasan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('catatan_penugasan')
                    ->label('Catatan')
                    ->limit(40)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
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
            'index' => Pages\ListPenugasanTeknisis::route('/'),
            'create' => Pages\CreatePenugasanTeknisi::route('/create'),
            'edit' => Pages\EditPenugasanTeknisi::route('/{record}/edit'),
        ];
    }
}