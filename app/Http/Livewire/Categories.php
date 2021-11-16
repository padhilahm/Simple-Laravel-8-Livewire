<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Services\CategoryService;
use Livewire\Component;
use Livewire\WithPagination;


class Categories extends Component
{
    public $name, $categoryId, $mode = 'Add', $status = false;
    public $updateMode = false;

    public $search;

    protected $queryString = ['search'];

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected CategoryService $categoryService;

    public function boot(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function render()
    {
        return view('livewire.categories', [
            'categories' => $this->categoryService->getWithPaginate()
        ]);
    }

    private function resetInputFields()
    {
        $this->name = '';
    }

    public function store()
    {
        $request = $this->validate([
            'name' => 'required'
        ]);

        $this->categoryService->create((object)$request);

        session()->flash('message', 'Category Aded');
        $this->resetInputFields();
        $this->status = true;
    }

    public function edit($id)
    {
        $this->validate([
            'name' => ''
        ]);

        $category = $this->categoryService->edit($id);
        $this->categoryId = $id;
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
        $request = $this->validate([
            'name' => 'required'
        ]);

        $this->categoryService->update((object)$request, $this->categoryId);

        $this->updateMode = false;
        $this->status = true;

        session()->flash('message', 'Category Updated');

        $this->resetInputFields();
    }

    public function delete($id)
    {
        $this->categoryService->delete($id);
        session()->flash('message', 'User deleted');
    }
}
