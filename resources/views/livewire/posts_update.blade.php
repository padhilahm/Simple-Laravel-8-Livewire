<form wire:submit.prevent='update'>
    <input type="hidden" wire:model="post_id">
    <div class="form-group">
        <label for="exampleFormControlInput1">Title:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title" wire:model="title">
        @error('title') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Body:</label>
        <textarea type="email" class="form-control" id="exampleFormControlInput2" wire:model="body" placeholder="Enter Body"></textarea>
        {{-- <input id="x" type="hidden" value="{{ $this->body }}">
        <trix-editor input="x"></trix-editor> --}}
        @error('body') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Category:</label>
        <select class="form-control" wire:model='category'>
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
        @endif
    </div>
    <input type="hidden" wire:model='oldImage'>
    <button class="btn btn-dark">Update</button>
    <button wire:click.prevent="cancel()" class="btn btn-danger">Cancel</button>
</form>