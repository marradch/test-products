@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->title }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col">
                <h1>{{ $category->title }}</h1>
            </div>
        </div>
        <div class="card-deck">
            @foreach ($category->products as $product)
                <div class="card">
                    <!--<img class="card-img-top" style="height: auto; width: auto; max-width: 300px; max-height: 300px;" src="{{ asset('storage/images/'.$product->image) }}" alt="Card image cap">-->
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <a href="{{ route('product.show', ['product' => $product]) }}" class="btn btn-primary">Show product</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
