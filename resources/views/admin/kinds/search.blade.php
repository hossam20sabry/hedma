@extends('admin.layout')

@section('content') 
<div class="py-3 background">
    <div class="container">
        <div class="d-flex">
            <a href="{{ route('admin.kinds.index') }}" class="decoration_none"><h3 class="m_r">Kinds </h3></a><h3>- search</h3>
        </div>
    </div>
</div>

<div class="container my-4 ">

</div>

<div class="container">
    @if ($kinds_result->count() == 0)
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
            @foreach ($kinds_result as $kind)
            <tr>
                    <th scope="row">{{$kind->id}}</th>
                    <td>{{$kind->name}}</td>
                    <td><a href="{{ route('admin.kinds.edit', $kind->id) }}" class="btn btn-primary">Update</a>
                    <form action="{{ route('admin.kinds.destroy', $kind->id) }}" method="post">
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