<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Services\PostService;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;
    public $search;
    public $searchActive = false;

    protected PostService $postService;

    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    public function boot(PostService $postService)
    {
        $this->postService = $postService;
    }
    
    public function render()
    {
        if ($this->searchActive) {
            $this->searchActive = false;
            return view('livewire.home', [
                'posts' => $this->postService->getWithUserSearch($this->search)
            ]);
            
        }else{
            return view('livewire.home', [
                'posts' => $this->postService->getWithUser()
            ]);
        }
    }

    public function search()
    {
        $this->searchActive = true;
    }
}
