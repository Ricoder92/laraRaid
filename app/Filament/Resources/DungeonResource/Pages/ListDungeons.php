<?php

namespace App\Filament\Resources\DungeonResource\Pages;

use App\Filament\Resources\DungeonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDungeons extends ListRecords
{
    protected static string $resource = DungeonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
