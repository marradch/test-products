@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Category Update</h1>
        </div>
        <div class="row">
            <form method="POST" action={{route('category.update', ['category'=>$category])}}>
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="{{$category->title}}">
                </div>
                @error('title')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                <button type="submit" class="btn btn-primary btn-flat">Save</button>
            </form>
        </div>
    </div>
@endsection
