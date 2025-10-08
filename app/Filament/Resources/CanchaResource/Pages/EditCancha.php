<?php

namespace App\Filament\Resources\CanchaResource\Pages;

use App\Filament\Resources\CanchaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCancha extends EditRecord
{
    protected static string $resource = CanchaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
