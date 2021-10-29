<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public $name, $email, $password;

    public function render()
    {
        return view('livewire.register');
    }

    public function register()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);
        session()->flash('message2', 'Akun berhasil dibuat silahkan login');
        return redirect('login');
    }
}
