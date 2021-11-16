<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use App\Services\PostService;
use App\Services\CommentService;

class PostSingle extends Component
{
    public $ids, $comment, $postId;
    public $activeComment = false;
    public $name;
 
    protected $queryString = ['ids'];

    protected PostService $postService;
    protected CommentService $commentService;

    public function boot(PostService $postService, CommentService $commentService)
    {
        $this->postService = $postService;
        $this->commentService = $commentService;
    }

    public function render()
    {
        return view('livewire.post-single', [
            'post' => $this->postService->getById($this->ids),
            'comments' => $this->postService->getCommentByPostId($this->ids)
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
        $this->validate([
            'comment' => 'required',
        ]);

        $data = [
            'comment' => $this->comment,
            'postId' => $this->ids
        ];

        $this->commentService->create((object)$data);

        $this->comment = '';
        $this->activeComment = false;
    }

    public function delete($id)
    {
        $this->commentService->delete($id);
    }
}
