<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <button wire:click.prevent="cancel()" type="button" class="btn btn-primary" data-toggle="modal"
        data-target="#exampleModal">Add User</button>

    @if ($status)
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
                        <input type="hidden" wire:model="userId">
                        @endif
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Name:</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter Name" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput2">Email:</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter Email" wire:model="email">
                            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput2">Password:</label>
                            <input type="password" class="form-control" id="exampleFormControlInput2"
                                wire:model="password" placeholder="Enter password">
                            @error('password') <span class="text-danger">{{ $message }}</span>@enderror
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
    <div class="form-row">
        <div class="form-group col-md-8">
        </div>
        <div class="form-group col-md-4">
            <input wire:model="search" type="search" class="form-control" placeholder="Search user...">
        </div>
    </div>

    <table class="table table-bordered mt-0">
        <thead>

            <tr>
                <th width="10">No.</th>
                <th>Name</th>
                <th>Email</th>
                <th width="150px">Action</th>
            </tr>

        </thead>
        <tbody>
            @php
            $no = ($users->currentpage()-1)* $users->perpage() + 1
            @endphp
            @foreach($users as $user)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <button wire:click="edit({{ $user->id }})" class="btn btn-primary btn-sm" class="btn btn-primary"
                        data-toggle="modal" data-target="#exampleModal">Edit</button>
                    <button wire:click="delete({{ $user->id }})" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure!') || event.stopImmediatePropagation()">Delete</button>
                </td>
            </tr>
            @php
            $no++
            @endphp
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{ $users->links() }}
    </div>
</div>
