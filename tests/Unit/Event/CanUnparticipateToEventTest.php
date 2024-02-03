<?php

it('should return false when event is past', function () {
    $event = \App\Models\Event::factory()
        ->forEventCategory()
        ->past()
        ->create([
            'max_places' => null,
        ]);

    $user = \App\Models\User::factory()->create();

    expect($user->can('unparticipate', $event))->toBeFalse();
});

it('should return false when not participating', function () {
    $event = \App\Models\Event::factory()
        ->forEventCategory()
        ->incoming()
        ->create([
            'max_places' => null
        ]);

    $user = \App\Models\User::factory()->create();

    expect($user->can('unparticipate', $event))->toBeFalse();
});
