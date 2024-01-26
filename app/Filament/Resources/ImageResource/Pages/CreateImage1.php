<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Filament\Resources\ImageResource;
use App\Services\OpenAi\ChatService;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateImage1 extends CreateRecord
{
    protected static string $resource = ImageResource::class;

    /**
     * @param array $data
     * @return Model
     */
    protected function handleRecordCreation(array $data): Model
    {
        return static::getModel()::create($data);
    }

    protected function afterCreate(): void
    {
//
    }
}
