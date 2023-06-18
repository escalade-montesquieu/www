<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Concerns\HasOptions;
use Filament\Forms\Components\Field;

class ThumbnailSelection extends Field
{
    use HasOptions;

    protected string $view = 'forms.components.thumbnail-selection';
}
