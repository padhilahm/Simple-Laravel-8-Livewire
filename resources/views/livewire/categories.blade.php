<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <button wire:click.prevent="cancel()" type="button" class="btn btn-primary" data-toggle="modal"
        data-target="#exampleModal">Add Category</button>
        <br><br>

    @if ($status == true)
    <script>
        $(document).ready(function () {
            $('#exampleModal').modal('hide');
        });

    </script>
    @endif

    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $mode }} user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @if ($updateMode)
                        <input type="hidden" wire:model="category_id">
                        @endif
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Name:</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter Name" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    @if ($updateMode)
                    <button wire:click.prevent="update()" class="btn btn-success" id="buttons">Update</button>
                    @else
                    <button wire:click.prevent="store()" class="btn btn-success" id="buttons">Save</button>
                    @endif

                </div>

            </div>
        </div>
    </div>

    <table class="table table-bordered mt-0">
        <thead>

            <tr>
                <th width="10">No.</th>
                <th>Category</th>
                <th width="150px">Action</th>
            </tr>

        </thead>
        <tbody>
            @php
            $no = ($categories->currentpage()-1)* $categories->perpage() + 1
            @endphp

            @foreach($categories as $category)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <button wire:click="edit({{ $category->id }})" class="btn btn-primary btn-sm" class="btn btn-primary"
                        data-toggle="modal" data-target="#exampleModal">Edit</button>
                    <button wire:click="delete({{ $category->id }})" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure!') || event.stopImmediatePropagation()">Delete</button>
                </td>
            </tr>
            @php
            $no++
            @endphp
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $categories->links() }}
    </div>

</div>
