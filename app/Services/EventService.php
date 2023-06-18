<?php

namespace App\Services;

use App\Models\Event;

class EventService {

    public function __construct(Event $event)
    {
        $this->instance = $event;
    }

}
