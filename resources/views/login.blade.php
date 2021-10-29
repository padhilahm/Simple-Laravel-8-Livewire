@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Login</h2>
                </div>
                <div class="card-body">
                    @livewire('login')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
