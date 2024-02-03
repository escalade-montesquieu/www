<?php

it('should return false when event is past', function () {
    $event = \App\Models\Event::factory()
        ->forEventCategory()
        ->past()
        ->create([
            'max_places' => null,
        ]);

    $user = \App\Models\User::factory()->create();

    expect($user->can('participate', $event))->toBeFalse();
});

it('should return false when as many participants as places', function () {
    $event = \App\Models\Event::factory()
        ->forEventCategory()
        ->incoming()
        ->create([
            'max_places' => 1
        ]);

    $user = \App\Models\User::factory()->create();
    $user->events()->attach($event);

    $anotherUser = \App\Models\User::factory()->create();

    expect($anotherUser->can('participate', $event))->toBeFalse();
});

it('should return false when more participants than places', function () {
    $event = \App\Models\Event::factory()
        ->forEventCategory()
        ->incoming()
        ->create([
            'max_places' => 0
        ]);

    $user = \App\Models\User::factory()->create();
    $user->events()->attach($event);

    $anotherUser = \App\Models\User::factory()->create();

    expect($anotherUser->can('participate', $event))->toBeFalse();
});

it('should return false when already participating', function () {
    $event = \App\Models\Event::factory()
        ->forEventCategory()
        ->incoming()
        ->create([
            'max_places' => null
        ]);

    $user = \App\Models\User::factory()->create();
    $user->events()->attach($event);

    expect($user->can('participate', $event))->toBeFalse();
});
