<?php

namespace App\Filament\Resources\CharacterGroupResource\Pages;

use App\Filament\Resources\CharacterGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCharacterGroups extends ListRecords
{
    protected static string $resource = CharacterGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
