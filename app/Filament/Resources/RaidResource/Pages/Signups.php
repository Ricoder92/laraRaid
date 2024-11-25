<?php

namespace App\Filament\Resources\RaidResource\Pages;

use Filament\Resources\Pages\Concerns\InteractsWithRecord;

use App\Filament\Resources\RaidResource;
use Filament\Resources\Pages\Page;
use Illuminate\View\View;
use App\Models\RaidEncounter;

class Signups extends Page
{
    protected static string $resource = RaidResource::class;

    protected static string $view = 'filament.resources.raid-resource.pages.signups';

    use InteractsWithRecord;
    
    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    public function getViewData(): array
    {
        return [
            'raid' => $this->record,
            'raidEncounters' => RaidEncounter::where('raid_id', $this->record->id)->get(),
        ];
    }
}
