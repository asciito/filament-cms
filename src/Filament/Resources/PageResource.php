<?php

namespace Asciito\FilamentCms\Filament\Resources;

use Asciito\FilamentCms\Filament\Resources\PageResource\Pages;
use Asciito\FilamentCms\Models\Enumerables\Status;
use Asciito\FilamentCms\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(components: [
                Forms\Components\TextInput::make('title')
                    ->dehydrateStateUsing(function (?string $state, Forms\Set $set) {
                        if (empty($state)) {
                            $id = Page::latest('id')->first()?->id + 1;

                            $state = "Your page title $id";

                            $set('title', $state);
                        }

                        return $state;
                    }),
                Forms\Components\TextInput::make('slug')
                    ->unique(table: Page::class, ignoreRecord: true)
                    ->dehydrateStateUsing(fn (?string $state, Forms\Get $get) => $state ?: Str::slug($get('title')))
                    ->mutateStateForValidationUsing(fn (?string $state, Forms\Get $get) => $state ?: Str::slug($get('title'))),
                Forms\Components\RichEditor::make('body'),
                Forms\Components\Select::make('status')
                    ->default('draft')
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (Status $state) => $state->name)
                    ->color(fn (Status $state) => match ($state) {
                        Status::DRAFT => \Filament\Support\Colors\Color::Gray,
                        Status::PUBLISHED => \Filament\Support\Colors\Color::Blue,
                        Status::ARCHIVED => \Filament\Support\Colors\Color::Yellow,
                    }),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
