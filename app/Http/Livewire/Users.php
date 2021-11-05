<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    public $name, $email, $user_id, $password, $mode = 'Add', $status = false;
    public $updateMode = false;

    public $search;

    protected $queryString = ['search'];

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // $posts = Post::paginate(10);
        // dd($this->posts);
        return view('livewire.users', [
            'users' => User::where('email', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%')
                ->paginate(5)
        ]);
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);

        session()->flash('message', 'User Aded');
        $this->resetInputFields();
        $this->status = true;
    }

    public function edit($id)
    {
        $this->validate([
            'name' => '',
            'email' => '',
            'password' => ''
        ]);

        $post = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $post->name;
        $this->email = $post->email;
        $this->password = '';
        $this->mode = 'Edit';

        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->validate([
            'name' => '',
            'email' => '',
            'password' => ''
        ]);
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $post = User::find($this->user_id);
        $post->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);

        $this->updateMode = false;
        $this->status = true;

        session()->flash('message', 'User Updated');

        $this->resetInputFields();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User deleted');
    }
}
