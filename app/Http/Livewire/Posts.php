<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;


class Posts extends Component
{
    public $title, $body, $post_id;
    public $updateMode = false;

    use WithPagination;
 
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // $posts = Post::paginate(10);
        // dd($this->posts);
        return view('livewire.posts', [
            'posts' => Post::where('user_id', auth()->user()->id)
                            ->latest()
                            ->paginate(5)
        ]);
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->body = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Post::create([
            'user_id' => auth()->user()->id,
            'title' => $this->title,
            'body' => $this->body
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

        $this->updateMode = true;
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
        ]);

        $post = Post::find($this->post_id);
        $post->update([
            'title' => $this->title,
            'body' => $this->body,
            'user_id' => auth()->user()->id
        ]);

        $this->updateMode = false;

        session()->flash('message', 'Post Updated');

        $this->resetInputFields();
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post deleted');
    }
}
