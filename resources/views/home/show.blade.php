@extends('home.layout')

@section('index')
<div class="container p-2 my-2 min_hei center" id="Products">
    
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('success'))
                <div class="alert alert-success text-center m-3" style="max-width: 580px;">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
            <div class="card text-bg-light m-3 box_shadow" style="max-width: 580px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/images/{{$product->image}}" class="img-fluid rounded-start p-2 productShow_img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><span class="text-bold">Title:</span> <span class="text-capitalize">{{$product->name}}</span></h5>
                            <p class="card-text"><span class="text-bold">Description:</span> {{$product->description}}</p>
                            <p class="card-text"><span class="text-bold">Price:</span> <span class="text-decoration-line-through">${{$product->price}} </span> <span class="text-danger">&nbsp;&nbsp; ${{$total_price}}</span></p>
                            <p class="card-text"><span class="text-bold">Brand:</span> {{$product->brand->name}}</p>
                            <p class="card-text"><span class="text-bold">Category:</span> {{$product->category->name}}</p>
                        </div>
                        <form action="{{ route('product.cash')}}" method="POST">
                            @csrf
                        
                            <div class="row mx-1 py-2">
                                <div class="col-md-6 mb-2">
                                    <label for="quantity" class="text-bold">Quantity: </label>
                                    <input type="number" min="1" name="quantity" class="form-control" id="quantity" value="1">
                                    <input type="hidden" name="total_price" value="{{$total_price}}">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    @if($errors->has('quantity'))
                                        <h4 class="error_message m-1">{{ $errors->first('quantity') }}</h4>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h4>Total price: <span class="red">$</span><span class="total_price red"> {{$total_price}}</span></h4>
                                </div>
                            </div>
                            <div class="row mx-1 py-2">
                                <div class="col-6">
                                    <button type="button" class="btn btn-success m-1" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    >Cash on delivery</button>
                                    
                                    {{-- modal --}}
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Are you sure you want to cash on delivery?</h4>
                                                <h4 class="red">Total price: $<span class="total_price"></span></h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                                <div class="col-6">
                                    <form action="{{ route('stripe.checkout') }}" method="get">
                                        <input type="hidden" name="quantity2" id="quantity2" value="">
                                        <input type="hidden" name="product_id2" value="{{$product->id}}">
                                        <input type="hidden" name="total_price2" value="{{$total_price}}">
                                        <button type="submit" class="btn btn-primary m-1">pay Now</button>
                                    </form>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
</div>


@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous">
</script>

<script>
$(document).ready(function(){
    const price = {!! json_encode($total_price) !!};
    let total_price = price;
    total_price = Math.ceil(total_price); 
    $('.total_price').text(total_price);
    $('#quantity2').val(1);
    $('#quantity').on('change', function(){
        let quantity = $(this).val();
        $('#quantity2').val(quantity);
        total_price = price * quantity;
        total_price = Math.ceil(total_price); 
        console.log(total_price);
        $('.total_price').text(total_price);
    })
})
</script>