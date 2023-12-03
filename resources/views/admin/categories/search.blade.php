@extends('admin.layout')

@section('content') 
<div class="py-3 background">
    <div class="container">
        <div class="d-flex">
            <a href="{{ route('admin.categories.index') }}" class="decoration_none"><h3 class="m_r">Categories</h3></a><h3>search</h3>
        </div>
    </div>
</div>

<div class="container my-4 ">

</div>

<div class="container">
    @if ($categories_result->count() == 0)
        <h1 class="text-center">No categories</h1>
    @else
    <table class="table table-success table-striped">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Updae</th>
                <th scope="col">Delete</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($categories_result as $category)
            <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->name}}</td>
                    <td><a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">Update</a>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <td><button type="submit" class="btn btn-danger">Delete</button></td>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@endsection