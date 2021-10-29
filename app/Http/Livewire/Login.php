<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;



class Login extends Component
{
    public $email;
    public $password;
    
    public function render()
    {
        return view('livewire.login');
    }

    public function auth()
    {
        $credential = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credential)){
            return redirect('posts');
        }else{
            session()->flash('message', 'Email atau password salah');
            // return redirect('login');
        }
    }
}
