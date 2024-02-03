<?php

it('should return true when as many participants as places', function () {
    $event = \App\Models\Event::factory()
        ->forEventCategory()
        ->incoming()
        ->create([
            'max_places' => 1
        ]);

    $user = \App\Models\User::factory()->create();

    $user->events()->attach($event);

    expect($event->is_full)->toBeTrue();
});

it('should return true when more participants than places', function () {
    $event = \App\Models\Event::factory()
        ->forEventCategory()
        ->incoming()
        ->create([
            'max_places' => 0
        ]);

    $user = \App\Models\User::factory()->create();
    $user->events()->attach($event);

    expect($event->is_full)->toBeTrue();
});

it('should return false when less participants than places', function () {
    $event = \App\Models\Event::factory()
        ->forEventCategory()
        ->incoming()
        ->create([
            'max_places' => 1
        ]);

    expect($event->is_full)->toBeFalse();
});

it('should return false no place limit', function () {
    $event = \App\Models\Event::factory()
        ->forEventCategory()
        ->incoming()
        ->create([
            'max_places' => null
        ]);

    $user = \App\Models\User::factory()->create();
    $user->events()->attach($event);

    expect($event->is_full)->toBeFalse();
});
