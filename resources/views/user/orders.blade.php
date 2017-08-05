@extends('layouts.master')

@section('title', 'My Orders')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <header class="page-header">
                <h1 class="page-title">My Orders</h1>
            </header>
            @if(count($orders) > 0)
                @foreach($orders as $order)
                    <div class="panel panel-info custPanel">
                        <div class="panel-body">
                            <h5>Order #{{ $order->number }} on {{ $order->updated_at->format('F d, Y - h:i a')  }}</h5>
                            <ul class="list-group">
                                @foreach($order->cart->items as $item)
                                <li class="list-group-item">
                                    <span class="badge">$ {{ $item['price'] }}</span>
                                    {{  $item['item']['title'] . ' | ' . $item['quantity'] }} units
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="panel-footer custFooter">
                            <strong>Total Price: {{ $order->cart->total_price }}</strong>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info">You currently have no orders.</div>
            @endif
        </div>
    </div>
@endsection
