<?php

namespace Asciito\FilamentCms\Forms\Components;

use Asciito\FilamentCms\Forms\Fields\SlugInput;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class TitleSlug extends Component
{
    protected string $view = 'filament-cms::forms.components.text-slug';

    protected string $viewIdentifier = 'title-slug';

    final public function __construct(protected string $titleField, protected string $slugField)
    {
        //
    }

    public static function make(string $titleField = 'title', string $slugField = 'slug'): static
    {
        $static = app(static::class, ['titleField' => $titleField, 'slugField' => $slugField]);
        $static->configure();

        return $static;
    }

    public function getTitleField(): string
    {
        return $this->titleField;
    }

    public function getSlugField(): string
    {
        return $this->slugField;
    }

    public function setUp(): void
    {
        $this->childComponents(components: [
            TextInput::make($this->getTitleField())
                ->live(debounce: 250)
                ->afterStateUpdated(fn (?string $state, Set $set) => $set($this->getSlugField(), Str::slug($state))),
            SlugInput::make($this->getSlugField()),
        ]);
    }
}
