<?php

namespace App\Http\Livewire\Articles;

use App\Models\Article;
use Livewire\Component;

class DisplayList extends Component
{
    public bool $onlyThreeLatest = false;

    public string $orderBy = 'desc';

    public function getArticlesProperty()
    {
        if ($this->onlyThreeLatest) {
            return Article::threeLatest()->get();
        }

        return Article::orderBy('created_at', $this->orderBy)->get();
    }

    public function render()
    {
        return view('livewire.articles.display-list');
    }
}

