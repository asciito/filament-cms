<?php

use Asciito\FilamentCms\Filament\Resources\PageResource;
use Asciito\FilamentCms\Filament\Resources\PageResource\Pages;
use Asciito\FilamentCms\Models\Page;
use Filament\Tables\Actions\DeleteAction;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\isSoftDeletableModel;
use function Pest\Livewire\livewire;

beforeEach(function () {
    actingAs($this->user);
});

it('can render', function () {
    get(PageResource::getUrl())->assertSuccessful();
});

it('can show pages', function () {
    $posts = Page::factory(10)->create();

    livewire(Pages\ListPages::class)
        ->assertCanSeeTableRecords($posts);
});

it('can create page', function () {
    livewire(Pages\CreatePage::class)
        ->fillForm([
            'title' => 'This is a test title',
            'body' => 'This is some test body',
        ])
        ->call('create')
        ->assertHasNoErrors();

    \Pest\Laravel\assertDatabaseCount('contents', 1);
    \Pest\Laravel\assertDatabaseHas('contents', [
        'title' => 'This is a test title',
        'slug' => 'this-is-a-test-title',
        'body' => 'This is some test body',
        'type' => 'page',
        'status' => \Asciito\FilamentCms\Enumerables\Status::DRAFT,
    ]);
});

it('can\'t use same title', function () {
    $page = Page::factory()->create([
        'title' => 'This is some title',
        'slug' => 'this-is-some-title',
        'body' => 'This is some test body',
    ]);

    livewire(PageResource\Pages\CreatePage::class)
        ->fillForm([
            'title' => 'This is some title',
            'body' => 'This is some test body',
        ])
        ->call('create')
        ->assertHasFormErrors([
            'slug' => 'unique',
        ])
        ->assertHasNoErrors([
            'body' => 'required|min:50|max:255',
        ]);

    \Pest\Laravel\assertDatabaseCount('contents', 1);
});

it('can create a page with a default page title', function () {
    Page::factory(10)->create();

    livewire(PageResource\Pages\CreatePage::class)
        ->fillForm([
            'body' => 'This is some test body',
        ])
        ->call('create')
        ->assertHasNoErrors();

    \Pest\Laravel\assertDatabaseHas('contents', [
        'title' => 'Your page title 11',
    ]);

    Page::factory(10)->create();

    livewire(PageResource\Pages\CreatePage::class)
        ->fillForm([
            'body' => 'This is some test body',
        ])
        ->call('create')
        ->assertHasNoErrors();

    \Pest\Laravel\assertDatabaseHas('contents', [
        'title' => 'Your page title 22',
    ]);
});

it('can retrieve data', function () {
    $page = Page::factory()->create();

    livewire(PageResource\Pages\EditPage::class, [
        'record' => $page->getRouteKey(),
    ])
        ->assertFormSet([
            'title' => $page->title,
            'slug' => $page->slug,
            'body' => $page->body,
            'status' => $page->status->value,
        ]);
});

it('can delete page', function () {
    $page = Page::factory()->create();

    livewire(PageResource\Pages\ListPages::class)
        ->assertTableActionExists(DeleteAction::class)
        ->callTableAction(DeleteAction::class, $page);

    expect(isSoftDeletableModel($page))->toBeTrue();

    \Pest\Laravel\assertDatabaseHas('contents', [
        'title' => $page->title,
        'type' => 'page',
        'status' => \Asciito\FilamentCms\Enumerables\Status::ARCHIVED,
    ]);
});

it('can publish a page', function () {
    $page = Page::factory()->create();

    livewire(PageResource\Pages\EditPage::class, ['record' => $page->getRouteKey()])
        ->fillForm([
            'status' => \Asciito\FilamentCms\Enumerables\Status::PUBLISHED,
        ])
        ->assertFormSet([
            'status' => \Asciito\FilamentCms\Enumerables\Status::PUBLISHED,
        ])
        ->call('save');

    \Pest\Laravel\assertDatabaseHas(Page::class, [
        'title' => $page->title,
        'slug' => $page->slug,
        'status' => \Asciito\FilamentCms\Enumerables\Status::PUBLISHED,
    ]);
});
