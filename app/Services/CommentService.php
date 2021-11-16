<?php

namespace App\Services;

use App\Repositories\CommentRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function create($data)
    {
        $dataCreate = [
            'comment' => $data->comment,
            'user_id' => auth()->user()->id,
            'post_id' => $data->postId
        ];

        DB::beginTransaction();
        try {
            $comment = $this->commentRepository->create($dataCreate);
            DB::commit();
        } catch (Exception $e) {
            $comment = false;
            DB::rollBack();
        }
        return $comment;
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $comment = $this->commentRepository->delete($id);
            DB::commit();
        } catch (\Throwable $th) {
            $comment = false;
            DB::rollBack();
        }
        return $comment;
    }
}