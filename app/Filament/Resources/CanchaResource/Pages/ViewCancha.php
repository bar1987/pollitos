<?php

namespace App\Filament\Resources\CanchaResource\Pages;

use App\Filament\Resources\CanchaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCancha extends ViewRecord
{
    protected static string $resource = CanchaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
