<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImageResource\Pages;
use App\Filament\Resources\ImageResource\RelationManagers;
use App\Models\Image;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Illuminate\Database\Eloquent\Model;

class ImageResource extends Resource
{
    protected static ?string $model = Image::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Images';


    public static function getModelLabel(): string
    {
        return __('Image');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('keyword')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('keyword')
                    ->searchable(isIndividual:true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->icon('heroicon-o-check')
                    ->color(fn (string $state, Model $record): string => match ($state) {
                        'pending' => 'info',
                        'processing' => 'warning',
                        'completed' => 'success',
                        'failed' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('progress')
                    ->searchable(),
                Tables\Columns\IconColumn::make('image')
                    ->icon('heroicon-o-photo')
                    ->label('Download Image')
                    ->default(1)
                    ->color('warning')
                    ->tooltip('Download this image')
                    ->action(fn (Model $record) => ($record->progress == 100) ?
                        response()->download(public_path().$record->getRawOriginal('path')): '')
            ])
            ->defaultSort('keyword')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->poll()
            ->deferLoading();
    }

    public static function infolist(Infolist $infolist): infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('keyword')->columnSpan('full'),
                Infolists\Components\TextEntry::make('prompt')->columnSpan('full'),
                Infolists\Components\ImageEntry::make('path')
                    ->label('Image')
                    ->width(850)
                    ->height(800)
                ,
                Infolists\Components\TextEntry::make('created_at')
                    ->label('Created At')
                    ->columnSpan('full')
                    ->since(),
                Infolists\Components\TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->columnSpan('full')
                    ->since(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListImages::route('/'),
        ];
    }


}
