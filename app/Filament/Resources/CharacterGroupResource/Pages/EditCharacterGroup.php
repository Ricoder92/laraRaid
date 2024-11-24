<?php

namespace App\Filament\Resources\CharacterGroupResource\Pages;

use App\Filament\Resources\CharacterGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCharacterGroup extends EditRecord
{
    protected static string $resource = CharacterGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
