<form wire:submit.prevent='store' enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleFormControlInput1">Title:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title"
            wire:model="title">
        @error('title') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput2">Body:</label>
        <textarea class="form-control" id="exampleFormControlInput2" wire:model="body"
            placeholder="Enter Body"></textarea>
        {{-- <input id="x" type="hidden" value="{{ $this->body }}">
        <trix-editor input="x"></trix-editor> --}}
        @error('body') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Category:</label>
        <select class="form-control" wire:model='category'>
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


{{-- <form>
    <div class="form-group">
        <label for="exampleFormControlInput1">Title:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title"
            wire:model="title">
        @error('title') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput2">Body:</label>
        <textarea class="form-control" id="exampleFormControlInput2" wire:model="body"
            placeholder="Enter Body"></textarea>
        <input id="x" type="hidden" value="{{ $this->body }}">
        <trix-editor input="x"></trix-editor>
        @error('body') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Photo:</label>
        <input type="file" class="form-control" placeholder="Enter Title" wire:model="photo">
        @error('photo') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <button wire:click.prevent="store()" class="btn btn-success">Save</button>
</form> --}}