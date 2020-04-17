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
                <h1>Categories</h1>
                <div class="form-group">
                    <a href="{{route('category.create')}}" class="btn btn-info" role="button">Create</a>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->title}}</td>
                            <td>
                                <a href="{{route('category.edit', ['category'=>$category])}}" class="btn btn-info" role="button">Update</a>
                                <form style="display: inline;" action="{{route('category.destroy', ['category'=>$category])}}" method="POST">
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
