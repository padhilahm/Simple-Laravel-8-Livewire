<div>
    <div class="row justify-content-center">
        
        <div class="card" style="width: 50rem;">
            <img class="card-img-top" src="https://source.unsplash.com/400x200/?computer" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p>
                    <small class="text-muted">
                        <p>By. <a href="/posts?author={{ $post->user->id }}"
                                class="text-decoration-none">{{ $post->user->name }}</a>
                            {{ $post->created_at->diffForHumans() }}</p>
                    </small>
                </p>
                <p class="card-text">{{ $post->body }}</p>
                <div class="col text-right">
                    <a href="/" class="btn btn-primary btn-sm align-center">Back to home</a>
                </div>
            </div>

        </div>
       
    </div>
    <br>
</div>
