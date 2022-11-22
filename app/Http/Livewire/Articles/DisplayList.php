<?php

namespace App\Http\Livewire\Articles;

use App\Models\Article;
use Livewire\Component;

class DisplayList extends Component
{
    public bool $onlyOnHomepage = false;

    public string $orderBy = 'desc';

    public function getArticlesProperty()
    {
        if($this->onlyOnHomepage) {
            return Article::onHomepage()->get();
        }

        return Article::orderBy('updated_at', $this->orderBy)->get();
    }

    public function render()
    {
        return view('livewire.articles.display-list');
    }
}

