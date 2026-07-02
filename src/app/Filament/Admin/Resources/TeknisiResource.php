<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TeknisiResource\Pages;
use App\Models\Teknisi;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TeknisiResource extends Resource
{
    protected static ?string $model = Teknisi::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationGroup = 'Maintenance';

    protected static ?string $navigationLabel = 'Teknisi';

    protected static ?string $modelLabel = 'Teknisi';

    protected static ?string $pluralModelLabel = 'Teknisi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Akun Teknisi')
                    ->schema([
                        Forms\Components\Hidden::make('user_id')
                            ->default(fn () => User::where('email', 'teknisi@admin.com')->value('id'))
                            ->required(),

                        Forms\Components\Placeholder::make('akun_login_teknisi')
                            ->label('Akun Login Panel Teknisi')
                            ->content(function (): string {
                                $user = User::where('email', 'teknisi@admin.com')->first();

                                if (! $user) {
                                    return 'Akun teknisi@admin.com belum tersedia.';
                                }

                                return "{$user->name} - {$user->email}";
                            }),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Data Teknisi')
                    ->schema([
                        Forms\Components\TextInput::make('kode_teknisi')
                            ->label('Kode Teknisi')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\TextInput::make('nama_teknisi')
                            ->label('Nama Teknisi')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('no_telepon')
                            ->label('No Telepon')
                            ->tel()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('keahlian')
                            ->label('Keahlian')
                            ->maxLength(255),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'aktif' => 'Aktif',
                                'tidak_aktif' => 'Tidak Aktif',
                            ])
                            ->default('aktif')
                            ->required()
                            ->native(false),

                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_teknisi')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nama_teknisi')
                    ->label('Nama Teknisi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.email')
                    ->label('Akun Login')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.role')
                    ->label('Role Akun')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'teknisi' => 'Teknisi',
                        default => $state ?? '-',
                    })
                    ->color(fn (?string $state): string => match ($state) {
                        'teknisi' => 'success',
                        default => 'danger',
                    }),

                Tables\Columns\TextColumn::make('no_telepon')
                    ->label('No Telepon')
                    ->searchable(),

                Tables\Columns\TextColumn::make('keahlian')
                    ->label('Keahlian')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'aktif' => 'Aktif',
                        'tidak_aktif' => 'Tidak Aktif',
                        default => '-',
                    })
                    ->color(fn (?string $state): string => match ($state) {
                        'aktif' => 'success',
                        'tidak_aktif' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diupdate')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'aktif' => 'Aktif',
                        'tidak_aktif' => 'Tidak Aktif',
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
            'index' => Pages\ListTeknisis::route('/'),
            'create' => Pages\CreateTeknisi::route('/create'),
            'edit' => Pages\EditTeknisi::route('/{record}/edit'),
        ];
    }
}