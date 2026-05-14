<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PenugasanTeknisiResource\Pages;
use App\Filament\Admin\Resources\PenugasanTeknisiResource\RelationManagers;
use App\Models\PenugasanTeknisi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenugasanTeknisiResource extends Resource
{
    protected static ?string $model = PenugasanTeknisi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('permintaan_maintenance_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('teknisi_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('admin_id')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('tanggal_penugasan'),
                Forms\Components\Textarea::make('catatan_penugasan')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('permintaan_maintenance_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('teknisi_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('admin_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_penugasan')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
