<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Services\PostService;
use Livewire\WithFileUploads;
use App\Services\CategoryService;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;


class Posts extends Component
{
    protected PostService $postService;
    protected CategoryService $categoryService;

    protected $paginationTheme = 'bootstrap';
    public $title, $body, $postId, $oldImage, $photo, $category, $updateMode = false;
    public $trixId;

    use WithPagination;
    use WithFileUploads;

    public function boot(PostService $postService, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }
 
    public function render()
    {
        return view('livewire.posts', [
            'posts' => $this->postService->getAll(),
            'categories' => $this->categoryService->getAll()
        ]);
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->body = '';
        $this->photo = '';
        $this->oldImage = '';
        $this->category = '';
    }

    public function store()
    {
        $request = $this->validate([
            'title' => 'required',
            'body' => 'required',
            'photo' => 'image|file|max:1024',
            'category' => 'required'
        ]);

        $this->postService->create((object)$request);
        
        session()->flash('message', 'Post Created');
        $this->resetInputFields();
        $this->updateMode = false;
    }

    public function edit($id)
    {
        $post = $this->postService->edit($id);
        $this->postId = $id;
        $this->title = $post['title'];
        $this->body = $post['body'];
        $this->oldImage = $post['photo'];
        $this->category = $post['categoryId'];
        $this->photo = '';
        $this->updateMode = 1;
    }

    public function add()
    {
        $this->resetInputFields();
        $this->updateMode = 0;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $request = $this->validate([
            'title' => 'required',
            'body' => 'required',
            'photo' => 'image|file|max:1024',
            'category' => 'required'
        ]);

        $this->postService->update((object)$request, $this->postId);

        $this->updateMode = 3;

        session()->flash('message', 'Post Updated');

        $this->resetInputFields();
        $this->updateMode = false;
    }

    public function delete($id)
    {
        $this->postService->delete($id);
        session()->flash('message', 'Post deleted');
    }

    public function foo()
    {
        // $this->updateMode = 1000;
        $this->updateMode = $this->updateMode - 1;
    }
}
