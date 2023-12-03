@extends('home.layout')

@section('index')
<div class="container p-2 my-2 min_hei center">
    @if(session('message'))
        <div class="alert alert-success">
            {{session('message')}}
            @php
                session()->forget('message');
            @endphp
        </div>
    @endif
    
</div>


@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous">
</script>

{{-- <script>
$(document).ready(function(){
    
});
</script> --}}