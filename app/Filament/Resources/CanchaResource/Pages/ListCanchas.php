<?php

namespace App\Filament\Resources\CanchaResource\Pages;

use App\Filament\Resources\CanchaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCanchas extends ListRecords
{
    protected static string $resource = CanchaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
