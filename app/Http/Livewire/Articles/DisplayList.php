<?php

namespace App\Http\Livewire\Articles;

use App\Models\Article;
use Livewire\Component;

class DisplayList extends Component
{
    public bool $onlyPinned = false;

    public string $orderBy = 'none';

    public function getArticlesProperty()
    {
        if ($this->onlyPinned) {
            return Article::pinned()->get();
        }

        if ($this->orderBy === 'none') {
            return Article::ordered()->get();
        }

        return Article::orderBy('created_at', $this->orderBy)->get();
    }

    public function render()
    {
        return view('livewire.articles.display-list');
    }
}

