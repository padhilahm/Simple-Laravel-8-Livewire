<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;
 
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        return view('livewire.home', [
            'posts' => Post::with('user')->latest()->paginate(6)
        ]);
    }
}
