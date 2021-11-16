<div>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
  
    @if($updateMode === 1)
    <form wire:submit.prevent='update'>
        <input type="hidden" wire:model.lazy="postId">
        <div class="form-group">
            <label for="exampleFormControlInput1">Title:</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title" wire:model.lazy="title">
            @error('title') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2">Body:</label>
            <textarea type="email" class="form-control" id="exampleFormControlInput2" wire:model.lazy="body" placeholder="Enter Body"></textarea>
            {{-- <input id="x" type="hidden" value="{{ $this->body }}">
            <trix-editor input="x"></trix-editor> --}}
            @error('body') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Category:</label>
            <select class="form-control" wire:model.lazy='category'>
                <option value=""> - category - </option>
                @foreach ($categories as $categori)
                    <option @if ($category == $categori->id)
                        selected
                    @endif value="{{ $categori->id }}">{{ $categori->name }}</option>
                @endforeach
            </select>
            @error('category') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Photo:</label>
            <input type="file" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title" wire:model="photo">
            <div wire:loading wire:target="photo">Uploading <progress max="100" x-bind:value="progress"></progress></div>
            @error('photo') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            @if ($photo)
            <label for="exampleFormControlInput1">Photo Preview:</label>
            <img src="{{ $photo->temporaryUrl() }}" style="width: 100">
            @else
            <label for="exampleFormControlInput1">Photo Preview:</label>
            <img src="storage/{{ $oldImage }}" style="width: 100">
            @endif
        </div>
        <input type="hidden" wire:model.lazy='oldImage'>
        <button class="btn btn-dark">Update</button>
        <button wire:click.prevent="cancel()" class="btn btn-danger">Cancel</button>
    </form>
    @elseif($updateMode === 0)
    <form wire:submit.prevent='store' enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleFormControlInput1">Title:</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title"
                wire:model.lazy="title">
            @error('title') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    
        <div class="form-group">
            <label for="exampleFormControlInput2">Body:</label>
            <textarea class="form-control" id="exampleFormControlInput2" wire:model.lazy="body"
                placeholder="Enter Body"></textarea>
            {{-- <input id="x" type="hidden" value="{{ $this->body }}">
            <trix-editor input="x"></trix-editor> --}}
            @error('body') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    
        <div class="form-group">
            <label for="exampleFormControlInput1">Category:</label>
            <select class="form-control" wire:model.lazy='category'>
                <option value=""> - category - </option>
                @foreach ($categories as $categori)
                    <option value="{{ $categori->id }}">{{ $categori->name }}</option>
                @endforeach
            </select>
            @error('category') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    
        <div class="form-group">
            <label for="exampleFormControlInput1">Photo:</label>
            <input type="file" class="form-control" placeholder="Enter Title" wire:model="photo">
            <div wire:loading wire:target="photo">Uploading <progress max="100" x-bind:value="progress"></progress></div>
            @error('photo') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    
        <div class="form-group">
            @if ($photo)
            <label for="exampleFormControlInput1">Photo Preview:</label>
            <img src="{{ $photo->temporaryUrl() }}" style="width: 100">
            @endif
        </div>
    
        <button type="submit" class="btn btn-success">Save</button>
        <button wire:click.prevent="cancel()" class="btn btn-danger">Cancel</button>
    </form>
    
    @else
        <button wire:click='add' class="btn btn-success">Add Post</button>
    @endif


    {{-- <div wire:poll.keep-alive.1000ms='foo'>
        {{ $updateMode }}
    </div> --}}
    @if ($updateMode !== 0 && $updateMode !== 1)
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th width="10">No.</th>
                <th>Title</th>
                <th>Body</th>
                <th>Date</th>
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = ($posts->currentpage()-1)* $posts->perpage() + 1
            @endphp
            @foreach($posts as $post)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ Str::substr($post->body, 0, 100) }}...</td>
                <td>{{ $post->created_at }}</td>
                <td>
                <button wire:click="edit({{ $post->id }})" class="btn btn-primary btn-sm">Edit</button>
                    <button wire:click="delete({{ $post->id }})" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure!') || event.stopImmediatePropagation()">Delete</button>
                </td>
            </tr>
            @php
                $no++
            @endphp
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{ $posts->links() }}
    </div>
    @endif
</div>

