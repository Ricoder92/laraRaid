<?php

namespace App\Filament\Resources\RaidResource\Pages;

use App\Filament\Resources\RaidResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRaids extends ListRecords
{
    protected static string $resource = RaidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
