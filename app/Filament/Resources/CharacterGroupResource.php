<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CharacterGroupResource\Pages;
use App\Filament\Resources\CharacterGroupResource\RelationManagers;
use App\Models\CharacterGroup;
use App\Models\Character;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CharacterGroupResource extends Resource
{
    protected static ?string $model = CharacterGroup::class;

    protected static ?string $modelLabel = "Charaktergruppe";
    protected static ?string $pluralModelLabel = "Charaktergruppen";
    protected static ?string $navigationGroup = "Charakterverwaltung";
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Forms\Components\TextInput::make('name')
                    ->label('Group Name')
                    ->required()
                    ->maxLength(255),

               
            Forms\Components\BelongsToManyCheckboxList::make('characters')
                ->relationship('characters', 'name')
                ->columns(3),

                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Group Name'),
                TextColumn::make('characters_count')->label('Characters')->counts('characters'),
                TextColumn::make('characters_names')->grow()->label('Characters')->placeholder('No Characters')->getStateUsing(fn ($record) => $record->characters->pluck('name')->join(', ')), // Holt die Namen und verbindet sie mit Kommas
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
            'index' => Pages\ListCharacterGroups::route('/'),
            'create' => Pages\CreateCharacterGroup::route('/create'),
            'edit' => Pages\EditCharacterGroup::route('/{record}/edit'),
        ];
    }
}
