<?php

namespace App\Filament\Resources\DungeonResource\Pages;

use App\Filament\Resources\DungeonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDungeon extends EditRecord
{
    protected static string $resource = DungeonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
