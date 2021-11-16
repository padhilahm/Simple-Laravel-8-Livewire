<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    protected $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll()
    {
        return $this->post::where('user_id', auth()->user()->id)
                    ->latest()
                    ->paginate(5);
    }

    public function getById($id)
    {
        return $this->post::findOrFail($id);
    }
    
    public function getCommentByPostId($id)
    {
        return $this->post::find($id)->comments;
    }
    
    public function getWithUser()
    {
        return $this->post::with('user')
                    ->latest()
                    ->paginate(6);
    }

    public function getWithUserSearch($search)
    {
        return $this->post::with('user')
                    ->where('title', 'like', '%' . $search . '%')
                    ->latest()
                    ->paginate(6);
    }

    public function create($data)
    {
        return $this->post::create($data);
    }

    public function update($data, $id)
    {
        return $this->post::where('id', $id)
                    ->update($data);
    }

    public function delete($id)
    {
        return $this->post::where('id', $id)
                    ->delete();
    }

}