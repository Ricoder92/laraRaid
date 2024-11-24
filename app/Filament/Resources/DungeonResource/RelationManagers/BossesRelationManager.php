<?php

namespace App\Filament\Resources\DungeonResource\RelationManagers;

use App\Models\Boss;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BossesRelationManager extends RelationManager
{
    protected static string $relationship = 'bosses';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Boss Name')
                    ->maxLength(255),
            ]);
    }

public function table(Table $table): Table
{
    return $table
        ->recordTitleAttribute('name')
        ->columns([
            Tables\Columns\TextColumn::make('name'),
        ])
        ->filters([])
        ->headerActions([
            Tables\Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data) {
                    // Überprüfe, ob ein Name übergeben wurde
                    if (!isset($data['name']) || empty($data['name'])) {
                        throw new \Exception('Boss name cannot be empty.');
                    }

                    // Aktuellen Dungeon abrufen
                    $dungeon = $this->ownerRecord;

                    if (!$dungeon) {
                        throw new \Exception('Dungeon not found.');
                    }

                    // Schwierigkeitsstufen aus dem Dungeon abrufen
                    $difficulties = $dungeon->difficulties ?? ['Normal', 'Heroic', 'Mythic'];

                    // Für jede Schwierigkeitsstufe einen Boss erstellen
                    foreach ($difficulties as $difficulty) {
                        Boss::create([
                            'name' => "{$data['name']}", // Kombiniere Name mit Schwierigkeitsgrad
                            'dungeon_id' => $dungeon->id,
                            'difficulty' => $difficulty,
                        ]);
                    }

                    // Rückgabe verhindern, da Bosse manuell erstellt werden
                    return [];
                })
                ->before(function ($data) {
                    // Validierung vor der Erstellung
                    if (empty($data['name'])) {
                        throw new \Exception('Boss name cannot be empty.');
                    }
                })
                ->disableCreateAnother(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}



}
