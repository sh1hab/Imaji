<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Filament\Resources\ImageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;


class ViewImage1 extends ViewRecord
{
    protected static string $resource = ImageResource::class;

//    protected static string $view = 'filament.resources.images.pages.view';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Action::make('delete')
                ->requiresConfirmation()
                ->action(fn () => $this->image->delete()),
        ];
    }
}
