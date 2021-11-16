<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }
    
    public function getWithPaginate()
    {
        return $this->categoryRepository->getWithPaginate();
    }

    public function create($data)
    {
        $dataCreate = [
            'name' => $data->name
        ];

        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->create($dataCreate);
            DB::commit();
        } catch (Exception $e) {
            $category = false;
            DB::rollBack();
        }
        return $category;
    }
    
    public function update($data, $id)
    {
        $dataUpdate = [
            'name' => $data->name
        ];

        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->update($dataUpdate, $id);
            DB::commit();
        } catch (Exception $e) {
            $category = false;
            DB::rollBack();
        }
        return $category;
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->delete($id);
            DB::commit();
        } catch (Exception $e) {
            $category = false;
            DB::rollBack();
        }
        return $category;
    }
    
    public function edit($id)
    {
        return $this->categoryRepository->getById($id);
    }
}