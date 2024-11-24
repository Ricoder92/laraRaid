<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DungeonResource\RelationManagers\DungeonbossesRelationManager;

use App\Filament\Resources\DungeonResource\Pages;
use App\Filament\Resources\DungeonResource\RelationManagers;
use App\Models\Dungeon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DungeonResource extends Resource
{
    protected static ?string $model = Dungeon::class;

    protected static ?string $modelLabel = "Dungeon/Raid";
    protected static ?string $pluralModelLabel = "Dungeons/Raids";
    protected static ?string $navigationGroup = "Stammdaten";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
    return $form
        ->schema([
            // Raid Info Section
            Forms\Components\Section::make('Raid Info')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Dungeon Name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Select::make('expansion')
                        ->label('Expansion')
                        ->options([
                            'Classic' => 'Classic',
                            'Burning Crusade' => 'Burning Crusade',
                            'Wrath of the Lich King' => 'Wrath of the Lich King',
                            'Cataclysm' => 'Cataclysm',
                            'Pandaria' => 'Pandaria',
                            'Warlords of Draenor' => 'Warlords of Draenor',
                            'Legion' => 'Legion',
                            'Battle for Azeroth' => 'Battle for Azeroth',
                            'Shadowlands' => 'Shadowlands',
                            'The War Within' => 'The War Within',
                        ])
                        ->required(),
                ]),

            // Raid Schwierigkeitsgrad Section
            Forms\Components\Section::make('Raid Schwierigkeit')
                ->schema([
                    ToggleButtons::make('difficulties')
                        ->multiple()
                        ->grouped()
                        ->inline()
                        ->reactive()
                        ->columnSpan(6)
                        ->options([
                            'normal' => 'Normal',
                            'heroic' => 'Heroic',
                            'mythic' => 'Mythic',
                        ])
                        ->required(),

                    // Dynamische Felder für max_players basierend auf den ausgewählten Schwierigkeitsstufen
                    ...collect(['normal', 'heroic', 'mythic'])->map(function ($difficulty) {
                        return Forms\Components\TextInput::make("max_players.{$difficulty}")
                            ->label("Max Players for " . ucfirst($difficulty))
                            ->numeric()
                            ->default(40) // Setze hier Standardwerte je nach Schwierigkeitsstufe
                            ->required()
                            ->columnSpan(1)
                            ->hidden(fn (callable $get) => !in_array($difficulty, $get('difficulties'))) // Versteckt das Feld, wenn die Schwierigkeit nicht ausgewählt wurde
                            ->reactive();
                    })->toArray(),
                ])->columns(6),

        ]);
}



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Dungeon Name'),
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
           DungeonbossesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDungeons::route('/'),
            'create' => Pages\CreateDungeon::route('/create'),
            'edit' => Pages\EditDungeon::route('/{record}/edit'),
        ];
    }


}
