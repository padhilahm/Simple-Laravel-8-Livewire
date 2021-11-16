<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getWithSearch($search)
    {
        return $this->user::where('email', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->paginate(5);
    }

    public function getById($id)
    {
        return $this->user::findOrFail($id);
    }

    public function create($data)
    {
        return $this->user::create($data);
    }
    
    public function update($data, $id)
    {
        return $this->user::where('id', $id)
                    ->update($data);
    }

    public function delete($id)
    {
        return $this->user::where('id', $id)
                    ->delete();
    }
}