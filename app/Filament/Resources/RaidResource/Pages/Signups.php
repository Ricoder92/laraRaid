<?php

namespace App\Filament\Resources\RaidResource\Pages;

use App\Filament\Resources\RaidResource;
use Filament\Resources\Pages\Page;
use Illuminate\View\View;
class Signups extends Page
{
    protected static string $resource = RaidResource::class;

    protected static string $view = 'filament.resources.raid-resource.pages.signups';


}
