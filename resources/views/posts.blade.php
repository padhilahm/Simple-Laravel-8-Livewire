@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>CRUD Posts</h2>
                    </div>
                    <div class="card-body">
                        Welcom, {{ auth()->user()->name }}
                        <br>
                        <br>
                        @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        @endif
                        @livewire('posts')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection