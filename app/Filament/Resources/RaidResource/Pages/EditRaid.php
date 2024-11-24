<?php

namespace App\Filament\Resources\RaidResource\Pages;

use App\Filament\Resources\RaidResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRaid extends EditRecord
{
    protected static string $resource = RaidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
