@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('category.show', ['category' => $product->category])}}">{{ $product->category->title }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col">
                <h1>{{ $product->title }}</h1>
                <img style="height: auto; width: auto; max-width: 300px; max-height: 300px;" class="card-img-top" src="{{ asset('storage/images/'.$product->image) }}" alt="Card image cap">
                <p>{{ $product->description }}</p>
            </div>
        </div>
    </div>
@endsection
