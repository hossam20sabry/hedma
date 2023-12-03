@extends('admin.layout')

@section('content') 
<div class="py-3 background">
    <div class="container">
        <div class="d-flex">
            <a href="{{ route('admin.categories.index') }}" class="decoration_none"><h3 class="m_r">Categories</h3></a><h3>update</h3>
        </div>
    </div>
</div>
<div class="container my-4 ">
    <div class="row">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
        @endif
        <div class="col-md-6 box_shadow p-3">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <input type="text" name="name" class="form-control" value="{{ $category->name }}" placeholder="Category name" aria-label="First name">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary w-100">Update</button>
                    </div>
                    @error('name')
                    <div class="row">
                        <div class="col-12 m-2">
                            <div class="alert alert-danger">{{ $message }}</div>    
                        </div>
                    </div>
                                    
                    @enderror
                </div>
            </form>
        </div>
        
    </div>
</div>


@endsection