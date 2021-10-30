<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
  
    @if($updateMode)
        @include('livewire.posts_update')
    @else
        @include('livewire.posts_create')
    @endif
  
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
</div>

