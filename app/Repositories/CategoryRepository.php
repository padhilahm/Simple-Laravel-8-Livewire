<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAll()
    {
        return $this->category::all();
    }
    
    public function getById($id)
    {
        return $this->category::findOrFail($id);
    }
    
    public function getWithPaginate()
    {
        return $this->category::paginate(6);
    }

    public function create($data)
    {
        return $this->category::create($data);
    }
    
    public function delete($id)
    {
        return $this->category::where('id', $id)
                    ->delete();
    }
    
    public function update($data, $id)
    {
        return $this->category::where('id', $id)
                    ->update($data);
    }
}