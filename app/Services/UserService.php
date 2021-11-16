<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getWithSearch($search)
    {
        return $this->userRepository->getWithSearch($search);
    }

    public function create($data)
    {
        $dataCreate = [
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password)
        ];

        DB::beginTransaction();
        try {
            $user = $this->userRepository->create($dataCreate);
            DB::commit();
        } catch (Exception $e) {
            $user = false;
            DB::rollBack();
        }
        return $user;
    }
    
    public function update($data, $id)
    {
        $dataUpdate = [
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password)
        ];

        DB::beginTransaction();
        try {
            $user = $this->userRepository->update($dataUpdate, $id);
            DB::commit();
        } catch (Exception $e) {
            $user = false;
            DB::rollBack();
        }
        return $user;
    }

    public function edit($id)
    {
        return $this->userRepository->getById($id);
    }
    
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->delete($id);
            DB::commit();
        } catch (\Throwable $th) {
            $user = false;
            DB::rollBack();
        }
        return $user;
    }
}