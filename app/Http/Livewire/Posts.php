<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Contracts\Cache\Store;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


class Posts extends Component
{
    public $title, $body, $post_id, $oldImage;
    public $photo, $category;
    public $updateMode = false;

    use WithPagination;

    use WithFileUploads;
 
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // $posts = Post::paginate(10);
        // dd($this->posts);
        // $this->photo = '';
        // $this->resetInputFields();
        return view('livewire.posts', [
            'posts' => Post::where('user_id', auth()->user()->id)
                            ->latest()
                            ->paginate(5),
            'categories' => Category::all()
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
        $this->validate([
            'title' => 'required',
            'body' => 'required',
            'photo' => 'image|file|max:1024',
            'category' => 'required'
        ]);

        if ($this->photo) {
            $photo = $this->photo->store('photos');
        }else{
            $photo = NULL;
        }

        Post::create([
            'user_id' => auth()->user()->id,
            'category_id' => $this->category,
            'title' => $this->title,
            'body' => $this->body,
            'photo' => $photo
        ]);
        
        session()->flash('message', 'Post Created');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->body = $post->body;
        $this->oldImage = $post->photo;
        $this->category = $post->category_id;
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
        $this->validate([
            'title' => 'required',
            'body' => 'required',
            'photo' => 'image|file|max:1024',
            'category' => 'required'
        ]);

        if ($this->photo) {
            $photo = $this->photo->store('photos');
            if($this->oldImage){
                Storage::delete($this->oldImage);
            }
            $post = Post::find($this->post_id);
            $post->update([
                'title' => $this->title,
                'body' => $this->body,
                'user_id' => auth()->user()->id,
                'photo' => $photo,
                'category_id' => $this->category
            ]);
        }else{
            $post = Post::find($this->post_id);
            $post->update([
                'title' => $this->title,
                'body' => $this->body,
                'user_id' => auth()->user()->id,
                'category_id' => $this->category
            ]);
        }
        // $photo = $this->photo->store('photos');

        $this->updateMode = 3;

        session()->flash('message', 'Post Updated');

        $this->resetInputFields();
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();
        if ($post->photo) {
            Storage::delete($post->photo);
        }
        Storage::delete('$this->oldImage');
        session()->flash('message', 'Post deleted');
    }

    public function foo()
    {
        // $this->updateMode = 1000;
        $this->updateMode = $this->updateMode - 1;
    }
}
