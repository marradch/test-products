@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if (session('alert-' . $msg))
                <div class="alert alert-success">
                    {{ session('alert-' . $msg) }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
            @endif
        @endforeach
        <div class="row">
            <div class="col">
                <h1>Products</h1>
                <div class="form-group">
                    <a href="{{route('product.create')}}" class="btn btn-info" role="button">Create</a>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->title}}</td>
                            <td>{{$product->category->title}}</td>
                            <td>
                                <a href="{{route('product.edit', ['product'=>$product])}}" class="btn btn-info" role="button">Update</a>
                                <form style="display: inline;" action="{{route('product.destroy', ['product'=>$product])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" class="btn btn-info" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
