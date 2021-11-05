<div>
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form>
                <div class="input-group mb-3">
                <input wire:model='search' class="form-control" type="search" placeholder="Search">
                <button class="btn btn-outline-success" type="submit" wire:click.prevent='search'>Search</button>
            </div>
        </form>
        </div>
    </div>

    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4 mb-3">
            <div class="card" style="width: 18rem;">
                @if ($post->photo)
                <img class="card-img-top" src="{{ asset('/storage/'.$post->photo) }}" alt="Card image cap">
                @else
                <img class="card-img-top" src="https://source.unsplash.com/400x400/?computer" alt="Card image cap">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p>
                        <small class="text-muted">
                            <p>By. <a href="/posts?author={{ $post->user->id }}" class="text-decoration-none">{{
                                    $post->user->name }}</a>
                                {{ $post->created_at->diffForHumans() }}</p>
                                <p>
                                    {{ $post->category->name }}
                                </p>
                        </small>
                    </p>
                    <p class="card-text">{{ Str::substr($post->body, 0, 100) }}...</p>
                    <a href="/post?ids={{ $post->id }}" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>