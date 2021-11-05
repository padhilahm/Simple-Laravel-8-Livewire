<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class PostSingle extends Component
{
    public $ids, $comment;
    public $activeComment = false;
    public $name;
 
    protected $queryString = ['ids'];

    public function render()
    {
        return view('livewire.post-single', [
            'post' => Post::where('id', $this->ids)->first(),
            'comments' => Post::find($this->ids)->comments
        ]);
    }

    public function addComment()
    {
        $this->name = auth()->user()->name;
        $this->comment = '';
        $this->activeComment = true;
    }

    public function submitComment()
    {
        // $this->name = auth()->user()->name;

        $this->validate([
            'comment' => 'required'
        ]);

        Comment::create([
            'comment' => $this->comment,
            'user_id' => auth()->user()->id,
            'post_id' => $this->ids
        ]);

        $this->comment = '';
        $this->activeComment = false;
    }

    public function delete($id)
    {
        $post = Comment::find($id);
        $post->delete();
    }
}
