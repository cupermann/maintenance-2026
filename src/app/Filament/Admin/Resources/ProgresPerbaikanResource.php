<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProgresPerbaikanResource\Pages;
use App\Filament\Admin\Resources\ProgresPerbaikanResource\RelationManagers;
use App\Models\ProgresPerbaikan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgresPerbaikanResource extends Resource
{
    protected static ?string $model = ProgresPerbaikan::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationGroup = 'Maintenance';

    protected static ?string $navigationLabel = 'Progres Perbaikan';

    protected static ?string $modelLabel = 'Progres Perbaikan';

    protected static ?string $pluralModelLabel = 'Progres Perbaikan';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Progres Perbaikan')
                    ->schema([
                        Forms\Components\Select::make('permintaan_maintenance_id')
                            ->label('Permintaan Maintenance')
                            ->relationship('permintaanMaintenance', 'kode_permintaan')
                            ->getOptionLabelFromRecordUsing(function ($record): string {
                                return "{$record->kode_permintaan} - {$record->judul}";
                            })
                            ->searchable()
                            ->preload()
                            ->required()
                            ->native(false),

                        Forms\Components\Select::make('teknisi_id')
                            ->label('Teknisi')
                            ->relationship('teknisi', 'nama_teknisi')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->native(false),

                        Forms\Components\Select::make('status_progres')
                            ->label('Status Progres')
                            ->options([
                                'dikerjakan' => 'Dikerjakan',
                                'selesai' => 'Selesai',
                            ])
                            ->required()
                            ->native(false),

                        Forms\Components\DateTimePicker::make('tanggal_progres')
                            ->label('Tanggal Progres')
                            ->default(now())
                            ->required(),

                        Forms\Components\Textarea::make('deskripsi_progres')
                            ->label('Deskripsi Progres')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('foto_progres')
                            ->label('Foto Progres')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('foto-progres')
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

                Tables\Columns\TextColumn::make('teknisi.nama_teknisi')
                    ->label('Teknisi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status_progres')
                    ->label('Status Progres')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'dikerjakan' => 'Dikerjakan',
                        'mulai_dikerjakan' => 'Dikerjakan',
                        'selesai' => 'Selesai',
                        default => $state ? ucfirst(str_replace('_', ' ', $state)) : '-',
                    })
                    ->color(fn (?string $state): string => match ($state) {
                        'dikerjakan', 'mulai_dikerjakan' => 'warning',
                        'selesai' => 'success',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('deskripsi_progres')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\ImageColumn::make('foto_progres')
                    ->label('Foto')
                    ->disk('public')
                    ->square(),

                Tables\Columns\TextColumn::make('tanggal_progres')
                    ->label('Tanggal Progres')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_progres')
                    ->label('Status Progres')
                    ->options([
                        'dikerjakan' => 'Dikerjakan',
                        'mulai_dikerjakan' => 'Dikerjakan',
                        'selesai' => 'Selesai',
                    ]),
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
            ->defaultSort('tanggal_progres', 'desc');
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
            'index' => Pages\ListProgresPerbaikans::route('/'),
            'create' => Pages\CreateProgresPerbaikan::route('/create'),
            'edit' => Pages\EditProgresPerbaikan::route('/{record}/edit'),
        ];
    }
}
