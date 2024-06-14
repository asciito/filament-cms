<?php

use Workbench\App\Livewire\CreateContent;

it('can render', function () {
    \Pest\Livewire\livewire(CreateContent::class)
        ->assertFormFieldExists('title')
        ->assertFormFieldExists('slug')
        ->assertSuccessful();
});
