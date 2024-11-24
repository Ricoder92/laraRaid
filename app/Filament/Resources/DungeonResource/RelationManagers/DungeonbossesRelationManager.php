<?php

namespace App\Filament\Resources\DungeonResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\DungeonBoss;
use Illuminate\Support\Facades\DB;

class DungeonbossesRelationManager extends RelationManager
{
    protected static string $relationship = 'dungeonbosses';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Boss Name'),

                Forms\Components\ToggleButtons::make('difficulties')
                    ->label('Select Difficulties')
                    ->multiple()
                    ->grouped()
                    ->inline()
                    ->options(function () {
                        $dungeon = $this->ownerRecord;

                        if ($dungeon) {
                            // Verfügbare Schwierigkeitsstufen aus dem Dungeon holen
                            return array_combine(
                                $dungeon->difficulties ?? ['normal', 'heroic', 'mythic'],
                                $dungeon->difficulties ?? ['normal', 'heroic', 'mythic']
                            );
                        }

                        // Standardwerte, falls kein Dungeon gefunden wird
                        return ['normal' => 'Normal', 'heroic' => 'Heroic', 'mythic' => 'Mythic'];
                    })
                    ->required()
                    ->hidden(fn ($record) => $record instanceof DungeonBoss) // Verstecke das Feld, wenn es sich um einen existierenden Boss handelt
                    ->default(function () {
                        $dungeon = $this->ownerRecord;
                        return $dungeon->difficulties ?? ['normal', 'heroic', 'mythic'];
                    })
                    ->columns(3), // Zeige die Checkboxen in 3 Spalten
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Boss Name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('difficulty')
                    ->label('Difficulty'),

                Tables\Columns\TextColumn::make('max_players')
                    ->label('Max. Players')
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->using(function (array $data) {
                        $dungeon = $this->ownerRecord;

                        if (!$dungeon) {
                            throw new \Exception('Dungeon not found.');
                        }

                        // Verfügbare max_players-Werte aus dem Dungeon holen
                        $maxPlayers = $dungeon->max_players ?? [];
                        if (empty($maxPlayers)) {
                            throw new \Exception('Max players data is incomplete.');
                        }

                        // Für jede gewählte Schwierigkeit einen Boss erstellen
                        $createdRecords = [];
                        foreach ($data['difficulties'] as $difficulty) {
                            $maxPlayersForDifficulty = $maxPlayers[$difficulty] ?? null;

                            if ($maxPlayersForDifficulty === null) {
                                throw new \Exception("Max players not defined for difficulty: {$difficulty}");
                            }

                            $createdRecords[] = DungeonBoss::create([
                                'name' => $data['name'],
                                'dungeon_id' => $dungeon->id,
                                'difficulty' => $difficulty,
                                'max_players' => $maxPlayersForDifficulty,
                            ]);
                        }

                        return $createdRecords[0];
                    })
                    ->disableCreateAnother(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->using(function (DungeonBoss $record, array $data) {
                        // Alle Bosse mit demselben Namen aktualisieren
                        $updatedRecords = DungeonBoss::where('name', $record->name)
                            ->where('dungeon_id', $dungeon->id)
                            ->update([
                                'name' => $data['name'], // Setze den neuen Namen
                            ]);

                        return $updatedRecords; // Rückgabe der aktualisierten Datensätze
                    }),
                Tables\Actions\DeleteAction::make()
                    #->action(function (DungeonBoss $record) {
                    #    DungeonBoss::where('name', $record->name)->where('dungeon_id', $dungeon->id)->delete();
                    #}),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    #->action(function (array $records) {
                    #    foreach ($records as $record) {
                    #        DungeonBoss::where('name', $record['name'])->where('dungeon_id', $dungeon->id)->delete();
                    #    }
                    #}),
            ]);
    }
}
