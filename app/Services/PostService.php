<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Storage;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;   
    }

    public function getAll()
    {
        return $this->postRepository->getAll();
    }
    
    public function getById($id)
    {
        return $this->postRepository->getById($id);
    }
    
    public function getCommentByPostId($id)
    {
        return $this->postRepository->getCommentByPostId($id);
    }

    public function getWithUser()
    {
        return $this->postRepository->getWithUser();
    }

    public function getWithUserSearch($search)
    {
        return $this->postRepository->getWithUserSearch($search);
    }

    public function create($data)
    {
        if ($data->photo) {
            $photo = $data->photo->store('photos');
        }else{
            $photo = NULL;
        }

       $data = [
            'user_id' => auth()->user()->id,
            'category_id' => $data->category,
            'title' => $data->title,
            'body' => $data->body,
            'photo' => $photo
        ];

        DB::beginTransaction();
        try {
            $post = $this->postRepository->create($data);
            DB::commit();
        } catch (Exception $e) {
            $post = false;
            DB::rollBack();
        }

        return $post;
    }

    public function edit($id)
    {
        $post = $this->postRepository->getById($id);

        return [
            'postId' => $id,
            'title' => $post->title,
            'body' => $post->body,
            'photo' => $post->photo,
            'categoryId' => $post->category_id
        ];
    }

    public function update($data, $id)
    {
        $photo = false;
        $post = $this->postRepository->getById($id);
        if ($data->photo) {
            $oldImage = $post->photo;
            $photo = $data->photo->store('photos');
            $dataUpdate = [
                'title' => $data->title,
                'body' => $data->body,
                'user_id' => auth()->user()->id,
                'photo' => $photo,
                'category_id' => $data->category
            ];
        }else{
            $dataUpdate = [
                'title' => $data->title,
                'body' => $data->body,
                'user_id' => auth()->user()->id,
                'category_id' => $data->category
            ];    
        }

        DB::beginTransaction();
        try {
            $post = $this->postRepository->update($dataUpdate, $id);
            DB::commit();

            if ($post) {
                if ($data->photo) {
                    Storage::delete($oldImage);
                }
            }
        } catch (Exception $e) {
            $post = false;
            DB::rollBack();

            if ($photo) {
                Storage::delete($photo);
            }
        }

        return $post;
    }

    public function delete($id)
    {
        $data = $this->postRepository->getById($id);
        $oldImage = $data->photo;

        DB::beginTransaction();
        try {
            $post = $this->postRepository->delete($id);
            DB::commit();

            if ($post) {
                if ($oldImage) {
                    Storage::delete($data->photo);
                }
            }
        } catch (Exception $e) {
            $post = false;
            DB::rollBack();
        }
        
        return $post;
    }
}