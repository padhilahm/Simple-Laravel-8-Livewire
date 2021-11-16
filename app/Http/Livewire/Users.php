<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    public $name, $email, $userId, $password, $mode = 'Add', $status = false;
    public $updateMode = false;

    public $search;

    protected $queryString = ['search'];

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected UserService $userService;

    public function boot(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function render()
    {
        return view('livewire.users', [
            'users' => $this->userService->getWithSearch($this->search)
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
        $request = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        
        $this->userService->create((object)$request);

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

        $post = $this->userService->edit($id);
        $this->userId = $id;
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
        $request = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $this->userService->update((object)$request, $this->userId);

        $this->updateMode = false;
        $this->status = true;

        session()->flash('message', 'User Updated');

        $this->resetInputFields();
    }

    public function delete($id)
    {
        $this->userService->delete($id);
        session()->flash('message', 'User deleted');
    }
}
