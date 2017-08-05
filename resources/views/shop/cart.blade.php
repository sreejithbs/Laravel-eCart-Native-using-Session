@extends('layouts.master')

@section('title', 'Cart')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <header class="page-header">
            <h1 class="page-title">Your Cart</h1>
        </header>

    @if(Session::has('cart'))
        <table class="table table-bordered table-responsive" id="cart">
            <thead>
                <tr>
                    <th width="50%">Item</th>
                    <th width="20%">Price</th>
                    <th width="30%">Quantity</th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
            <tr>
                <td><img src="{{ $product['item']['image'] }}" width="70" />
                    <strong>{{ $product['item']['title'] }}</strong>
                </td>
                <td>
                    $ {{ $product['price'] }}
                </td>
                <td>
                    <form name="formUpdateQuantity" method="post" action="{{ route('cart.update') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="product_id" value="{{ $product['item']['id'] }}" />
                        <input type="text" name="quantity" class="quantity" value="{{ $product['quantity'] }}" />
                        <button class="btn btn-primary" type="submit" name="btn-submit"><i class="fa fa-refresh"></i></button>
                    </form>
                    <a href="{{ route('cart.delete',  $product['item']['id']) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        <div>
            Total: $ <span id="total_price">{{ $total }}</span>
        </div>
        <div style="display: inline-block;"> </div>
        <div class="pull-right">
            <a href="{{ route('cart.checkout') }}" class="btn btn-success">Checkout</a>
        </div>
        <br /><br /><br />
    @else
       <div class="alert alert-info">Your Cart is Empty.</div>
    @endif

@endsection