@extends('admin.layout')

@section('content')
<div class="py-3 background">
    <div class="container">
        <div class="d-flex">
            <a href="{{ route('admin.products.index') }}" class="decoration_none"><h3 class="m_r text-capitalize">Product </h3></a><h3>- update</h3>
        </div>
    </div>
</div>
<form action="{{ route('admin.products.update', $product->id)}}" enctype="multipart/form-data" method="post">
    @csrf
    @method('PUT')
<div class="container my-4 ">
    <div class="row center">
        <div class="col-md-9 box_shadow p-3">
            <div class="row  my-3">
                @if(session()->has('success'))
                <div class="col-12">
                    <div class="alert alert-success">
                        {{session()->get('success')}}
                    </div>
                </div>
                @endif
            </div>
            <div class="row  my-3">
                <div class="col-3">
                    <input type="text" class="form-control" name="name" value="{{$product->name}}" placeholder="Name" aria-label="First name">
                    @error('name')
                    <p class="error_message m-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-3">
                    <input type="decimal" class="form-control" name="price" value="{{$product->price}}" placeholder="Price" aria-label="Price">
                    @error('price')
                    <div class="error_message m-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-3">
                    <label class="visually-hidden" for="specificSizeSelect">Preference</label>
                    <select class="form-select" id="specificSizeSelect" name="category_id">
                        <option selected value="{{$product->category->id}}">{{$product->category->name}}</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="error_message m-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-3">
                    <label class="visually-hidden" for="specificSizeSelect">Preference</label>
                    <select class="form-select" id="specificSizeSelect" name="brand_id">
                        <option selected value="{{$product->brand->id}}">{{$product->brand->name}}</option>
                        @foreach($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                    <div class="error_message m-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row my-3">
                <div class="col-6">
                    <div class="form-floating">
                        <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">{{$product->description}}</textarea>
                        <label for="floatingTextarea2">Description</label>
                    </div>
                    @error('description')
                    <div class="error_message m-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <input type="text" class="form-control mb-3" name="discount" value="{{$product->discount}}" placeholder="discount" aria-label="discount">
                    @error('discount')
                    <p class="error_message m-1">{{ $message }}</p>
                    @enderror
                    <input type="text" class="form-control" name="quantity" value="{{$product->quantity}}" placeholder="quantity" aria-label="quantity">
                    @error('quantity')
                    <p class="error_message m-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row center my-3">
                
                <div class="col-4">
                    <div class="input-group">
                        <input type="file" class="form-control" name="image" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>
                    @error('image')
                    <div class="error_message m-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-4">
                    
                    <label class="visually-hidden" for="specificSizeSelect">Preference</label>
                    <select class="form-select" id="specificSizeSelect" name="kind_id">
                        <option selected value="{{$product->kind->id}}">{{$product->kind->name}}</option>
                        @foreach($kinds as $kind)
                        <option value="{{$kind->id}}">{{$kind->name}}</option>
                        @endforeach
                    </select>
                    @error('kind_id')
                    <div class="error_message m-1">{{ $message }}</div>
                    @enderror
                    
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary w-100 px-5">Update</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 box_shadow p-2 m-1 img_size">
            <img src="/images/{{$product->image}}" alt="">
        </div>
    </div>
</div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection