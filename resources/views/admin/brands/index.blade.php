@extends('admin.layout')

@section('content') 
<div class="py-3 background">
    <div class="container">
        <div class="d-flex">
            <a href="{{ route('admin.brands.index') }}" class="decoration_none"><h3 class="m_r">Brands</h3></a>
        </div>
    </div>
</div>
<div class="container my-4 ">
    <div class="row">
    
        <div class="col-md-6 box_shadow p-3 my-1">
            <form action="{{ route('admin.brands.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <input type="text" name="name" class="form-control" placeholder="Brand name" aria-label="First name">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary w-100">create</button>
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
        <div class="col-md-6 box_shadow p-3 my-1">
            <form class="d-flex" action="{{ route('admin.brands.search') }}" method="get" role="search">
                
                <input class="form-control me-2" name="text" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</div>
<div class="container">
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
            @foreach ($brands as $brand)
            <tr>
                    <th scope="row">{{$brand->id}}</th>
                    <td class="text-capitalize">{{$brand->name}}</td>
                    <td><a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-primary">Update</a>
                    <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <td><button type="submit" class="btn btn-danger">Delete</button></td>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection