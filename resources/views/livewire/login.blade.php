<div>
    @if (session()->has('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
    @endif

    @if (session()->has('message2'))
    <div class="alert alert-success">
        {{ session('message2') }}
    </div>
    @endif
    <form>
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
        <button wire:click.prevent="auth" type="submit" class="btn btn-primary">Login</button>
    </form>
    <div class="text-center">
        No have account, <a href="/register">Regsiter here</a>
    </div>
</div>
