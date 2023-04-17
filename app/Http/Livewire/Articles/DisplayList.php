<?php

namespace App\Http\Livewire\Articles;

use App\Models\Article;
use Livewire\Component;

class DisplayList extends Component
{
    public bool $onlyPinned = false;

    public string $orderBy = 'desc';

    public function getArticlesProperty()
    {
        if ($this->onlyPinned) {
            return Article::ordered()->pinned()->get();
        }

        return Article::ordered()->get();
    }

    public function render()
    {
        return view('livewire.articles.display-list');
    }
}

