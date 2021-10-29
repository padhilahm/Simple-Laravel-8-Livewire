<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostSingle extends Component
{
    public $ids;
 
    protected $queryString = ['ids'];

    public function render()
    {
        return view('livewire.post-single', [
            'post' => Post::where('id', $this->ids)->first()
        ]);
    }
}
