<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\Field;

class ImportFolder extends Field
{
    protected string $view = 'forms.components.import-folder';

    protected function setUp(): void
    {
        parent::setUp();

        $this->registerListeners([
            'import-folder::change' => [
                function (Component $component, string $statePath): void {
                    if ($component->isDisabled()) {
                        return;
                    }

                    if ($statePath !== $component->getStatePath()) {
                        return;
                    }

                    dd($component);
                },
            ],
        ]);
    }


}
