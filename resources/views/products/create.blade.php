@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Product Create</h1>
        </div>
        <div class="row">
            <form method="POST" enctype="multipart/form-data" action={{route('product.store')}}>
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="{{old('title')}}">
                </div>
                @error('title')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description">{{old('description')}}</textarea>
                </div>
                @error('description')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">No</option>
                        @foreach ($categories as $category)
                            <option {{($category->id == old('category_id')) ? 'selected="selected"' : ''}}value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" accept=".jpg, .jpeg, .png, .bmp" class="form-control" name="image">
                </div>
                @error('image')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                <button type="submit" class="btn btn-primary btn-flat">Save</button>
            </form>
        </div>
    </div>
@endsection
