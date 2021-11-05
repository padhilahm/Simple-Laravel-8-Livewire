<div>
    <div class="row justify-content-center">

        <div class="card" style="width: 50rem;">
            @if ($post->photo)
            <img class="card-img-top" src="{{ asset("/storage/$post->photo") }}" alt="Card image cap">
            @else
            <img class="card-img-top" src="https://source.unsplash.com/400x200/?computer" alt="Card image cap">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p>
                    <small class="text-muted">
                        <p>By. <a href="/posts?author={{ $post->user->id }}" class="text-decoration-none">{{
                                $post->user->name }}</a>
                            {{ $post->created_at->diffForHumans() }}</p>
                    </small>
                </p>
                <p class="card-text">{{ $post->body }}</p>

                <div class="col text-right">
                    {{-- <a href="/" class="btn btn-primary btn-sm align-center">Back to home</a> --}}
                </div>

            </div>

            <div class="card-body">
                <hr>

                <div class="coment-bottom bg-white p-2 px-4">
                    @auth
                    {{-- @if ($activeComment) --}}
                    <div class="d-flex flex-row add-comment-section mt-4 mb-4">
                        {{-- <img class="img-fluid img-responsive rounded-circle mr-2" src="https://i.imgur.com/qdiP4DB.jpg" width="38"> --}}
                        <input wire:model.prevent='comment' type="text" class="form-control mr-3" placeholder="Add comment">
                        <button wire:click.prevent='submitComment' class="btn btn-primary" type="button">Comment</button>
                    </div>
                    {{-- @else
                        <button wire:click.prevent='addComment' class="btn btn-outline-success btn-sm align-center">Add Comment</button>
                        @endif --}}
                    @endauth
                        
                    @foreach ($comments as $comment)
                    <div class="commented-section mt-2">
                        <div class="d-flex flex-row align-items-center commented-user">
                            <h6 class="mr-2">{{ $comment->user->name }}</h6><span class="dot mb-1"></span><span class="mb-1 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="comment-text-sm">
                            <span>{{ $comment->comment }}</span> 
                            @auth
                            @if (auth()->user()->id == $comment->user->id)
                            <a wire:click='delete({{ $comment->id }})'><span style="cursor: pointer" class="text-danger">delete</span></a> 
                            @endif
                            @endauth
                        </div>
                        
                    </div>
                    @endforeach
                    
                </div>
            </div>

            
        </div>

    </div>
    <br>
</div>