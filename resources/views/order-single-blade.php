@extends('layouts.main')
@section('styles')
<link href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css" rel="stylesheet">    
<link href="{{asset('css/products.css')}}" rel="stylesheet">
<link href="{{asset('css/swtch.css')}}" rel="stylesheet">
<link href="{{asset('css/order.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="content">
        
        <h1>Creando orden</h1>
        <p>Primero selecciona los productos que llevará la orden</p>
        
        
        <div>
        
            
            <div class="search-box">
                <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm search" aria-label="Recipient's username" aria-describedby="basic-addon2" name="search">
                    <div class="input-group-append">
                        <button class="btn btn-sm btn-success search-product">Buscar</button>
                    </div>
                    <div class="autocomplete-wrapper"></div>
                </div>
            </div>

        
            <ul class="list-group product-list">

                @foreach($products as $product)
                    <li class=" list-group-item product_{{$product->id}}" data-unit="{{$product->unit}}"  data-id="{{$product->id}}" data-label="{{$product->label}}" data-price="{{$product->unit_price}}">
                       
                        <span class="label">
                            {{$product->label}} 
                        </span>
                        
                        <div class="price">
                            <button type="button" class="btn btn-sm btn-light add-unit-product">
                                ${{$product->unit_price}} <span class="badge badge-dark">+1</span>
                            </button>
                        </div>
                    </li>
                @endforeach     
            </ul>
        </div>
        
    </div>
    
    <div class="fix">
        <div class="container">
            <button class="check-out-button btn btn-success btn-sm btn-block ">Levantar orden <span class="counter"></span></button>
        </div>
    </div>
    
@endsection
@section('scripts')
<script>
    let admin = false;
    @if(Auth::user()->role == 'admin'){
        admin = true;
    }
    @endif
    let clients = {!! $clients !!};
</script>

<script src="{{ asset('js/Form.js') }}"></script>
<script src="{{ asset('js/Modal.js') }}"></script>
<script src="{{ asset('js/Swtch.js') }}"></script>
<script src="{{ asset('js/Order.js') }}"></script>
<script src="{{ asset('js/orderFunctions.js') }}"></script>

@endsection
