<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RaidResource\Pages;
use App\Filament\Resources\RaidResource\RelationManagers;
use App\Models\Raid;
use App\Models\Dungeon;
use App\Models\User;
use App\Models\DungeonBoss;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;

class RaidResource extends Resource
{
    protected static ?string $model = Raid::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
    return $form
        ->schema([
            // Abschnitt: Raid-Details
            Section::make('Raid Details')
                ->description('Details for the raid')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->label('Raid Name')
                        ->columnSpan(6),
                ]),

            // Abschnitt: Dungeon- und Boss-Auswahl
            Section::make('Boss Selection')
                ->description('Select bosses based on dungeons.')
                ->schema([

                    // Dungeon-Auswahl
                    Select::make('selected_dungeons')
                        ->label('Select Dungeons')
                        ->relationship('dungeons', 'name') // Use the relationship from the Raid model
                        ->multiple() // Allow multiple selections
                        ->reactive()
                        ->preload() // Preload options for better performance
                        ->afterStateUpdated(function (callable $set, $state) {
                            // When dungeon selection is updated, update the bosses accordingly
                            $set('selected_bosses', []);  // Clear previously selected bosses
                        })
                        ->default(function ($record) {
                            if (!$record) {
                                return [];
                            }

                            // Load the dungeons associated with the raid bosses
                            $dungeonIds = DungeonBoss::whereIn('id', $record->raidEncounters->pluck('dungeon_boss_id'))
                                ->pluck('dungeon_id')
                                ->unique()
                                ->toArray();

                            return $dungeonIds;
                        })
                        ->searchable(), // Add a search bar to the dropdown

                    // Boss-Auswahl via Beziehung
                    Forms\Components\BelongsToManyCheckboxList::make('raidEncounters') // Beziehung zwischen Raid und Bossen
    ->label('Select Bosses')
    ->relationship('bosses', 'dungeon_boss_id') // Nutze die Beziehung
    ->default(function ($record) {
        if (!$record) {
            return [];
        }

        // Lade die IDs der ausgewählten Bosse
        return $record->raidEncounters->pluck('dungeon_boss_id')->toArray();
    })
    ->options(function (callable $get) {
        $selectedDungeons = $get('selected_dungeons');

        if (!$selectedDungeons) {
            return [];
        }

        // Hole die Bosse für die ausgewählten Dungeons und füge den Schwierigkeitsgrad hinzu
        return DungeonBoss::whereIn('dungeon_id', $selectedDungeons)
            ->get()
            ->mapWithKeys(function ($boss) {
                // Kombiniere den Bossnamen mit dem Schwierigkeitsgrad
                return [$boss->id => "{$boss->name} ({$boss->difficulty})"];
            })
            ->toArray();
    })
    ->columns(3), // Anzeige in 3 Spalten

                ]),
        ]);
}









    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
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
            'index' => Pages\ListRaids::route('/'),
            'create' => Pages\CreateRaid::route('/create'),
            'edit' => Pages\EditRaid::route('/{record}/edit'),
            'signups' => Pages\Signups::route('/{record}/signups'),
        ];
    }





 
}