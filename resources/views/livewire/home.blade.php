<div>
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4 mb-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://source.unsplash.com/400x400/?computer" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p>
                        <small class="text-muted">
                                <p>By. <a href="/posts?author={{ $post->user->id }}"
                                        class="text-decoration-none">{{ $post->user->name }}</a>
                                    {{ $post->created_at->diffForHumans() }}</p>
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
