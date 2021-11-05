<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;


class Categories extends Component
{
    public $name, $category_id, $mode = 'Add', $status = false;
    public $updateMode = false;

    public $search;

    protected $queryString = ['search'];

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.categories', [
            'categories' => Category::paginate(6)
        ]);
    }

    private function resetInputFields()
    {
        $this->name = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'name' => 'required'
        ]);

        Category::create([
            'name' => $this->name
        ]);

        session()->flash('message', 'Category Aded');
        $this->resetInputFields();
        $this->status = true;
    }

    public function edit($id)
    {
        $this->validate([
            'name' => ''
        ]);

        $category = Category::findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->mode = 'Edit';

        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->validate([
            'name' => ''
        ]);
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'name' => 'required'
        ]);

        $category = Category::find($this->category_id);
        $category->update([
            'name' => $this->name
        ]);

        $this->updateMode = false;
        $this->status = true;

        session()->flash('message', 'Category Updated');

        $this->resetInputFields();
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        session()->flash('message', 'User deleted');
    }
}
