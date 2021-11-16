<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Services\UserService;
use Livewire\Component;

class Register extends Component
{
    public $name, $email, $password;

    protected UserService $userService;

    public function boot(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function render()
    {
        return view('livewire.register');
    }

    public function register()
    {
        $request = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $this->userService->create((object)$request);

        session()->flash('message2', 'Akun berhasil dibuat silahkan login');
        return redirect('login');
    }
}
