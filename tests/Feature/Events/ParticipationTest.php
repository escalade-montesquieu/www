<?php

test('user can participate to incoming not full event', function () {

    $event = \App\Models\Event::factory()->incoming()->create([]);
});
