@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Categories</h2>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        @endif
                        @livewire('categories')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection