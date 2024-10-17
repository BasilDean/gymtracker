<?php

use App\Models\Menu;

it('can create a menu', function () {
    $menu = Menu::factory()->create();

    expect($menu->title)->toBeString()
        ->and(json_encode($menu->title, JSON_THROW_ON_ERROR))->toBeJson();
});

//it('can have type only private or public', function () {
//    expect(fn() => Menu::factory()->create(['type' => 'something']))->toThrow(Exception::class);
//});
it('must have a type', function () {
    expect(fn() => Menu::factory()->create(['type' => null]))->toThrow(Exception::class);
});

it('must have a placement', function () {
    expect(fn() => Menu::factory()->create(['placement' => null]))->toThrow(Exception::class);
});
