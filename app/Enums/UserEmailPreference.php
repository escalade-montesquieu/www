<?php

namespace App\Enums;

use App\Traits\CastableToArrayLabelEnum;

enum UserEmailPreference: string
{
    use CastableToArrayLabelEnum;

    case EVENT_CREATION = 'event_creation';
    case EVENT_REMINDER = 'event_reminder';
    case FORUM_MESSAGE_MENTION = 'forum_message_mention';

    public function toLabel(): string
    {
        return match ($this) {
            self::EVENT_CREATION => "Création d'évènement",
            self::EVENT_REMINDER => "Rappel d'évènement",
            self::FORUM_MESSAGE_MENTION => "Mention dans un message",
        };
    }

    public static function toArray(): array
    {
        $list = [];
        foreach (self::cases() as $case) {
            $list[$case->value] = $case->toLabel();
        }

        return $list;
    }
}
