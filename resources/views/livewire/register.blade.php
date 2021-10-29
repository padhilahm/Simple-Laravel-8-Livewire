<div>
    @if (session()->has('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
    @endif
    
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" wire:model="name" aria-describedby="emailHelp"
                placeholder="Enter name">
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="text" class="form-control" wire:model="email" aria-describedby="emailHelp"
                placeholder="Enter email">
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" wire:model="password" placeholder="Password">
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button wire:click.prevent="register" type="submit" class="btn btn-primary">Regiter</button>
    </form>
    <div class="text-center">
        Already account, <a href="/login">Login here</a>
    </div>
</div>
