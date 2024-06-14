<?php

namespace Workbench\App\Livewire;

use Asciito\FilamentCms\Forms\Components\TitleSlug;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateContent extends Component implements HasForms
{
    use InteractsWithForms;

    public ?string $title = null;

    public function mount(): void
    {
        /** @phpstan-ignore-next-line  */
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TitleSlug::make(),
            ]);
    }

    public function create(): void
    {
        //
    }

    public function render(): View
    {
        return view('workbench::livewire.create-content');
    }
}
