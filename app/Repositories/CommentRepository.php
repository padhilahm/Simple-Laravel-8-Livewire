<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function create($data)
    {
        return $this->comment::create($data);
    }
    
    public function delete($id)
    {
        return $this->comment::where('id', $id)
                    ->delete();
    }
}  