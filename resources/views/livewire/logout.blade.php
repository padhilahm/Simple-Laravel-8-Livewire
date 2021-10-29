<div>
    @auth
    <a wire:click='logout' class="link-secondary" style="cursor: pointer">Logout</a>
    @else
    <a wire:click='login' class="link-secondary" style="cursor: pointer">Login</a>
    @endauth
</div>
