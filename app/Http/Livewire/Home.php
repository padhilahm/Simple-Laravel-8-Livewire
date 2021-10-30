<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;
    public $search;
    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        return view('livewire.home', [
            'posts' => Post::with('user')
                    ->where('title', 'like', '%' . $this->search . '%')
                    ->latest()->paginate(6)
        ]);
    }

    public function search()
    {
        return view('livewire.home', [
            'posts' => Post::with('user')->latest()->paginate(6)
        ]);
    }
}
