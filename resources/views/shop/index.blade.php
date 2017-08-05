@extends('layouts.master')

@section('title', 'Products')
@section('content')

    @foreach($products->chunk(4) as $productChunk)
        <div class="row">
        @foreach($productChunk as $product)
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="{{ $product->image }}" alt="..." class="img-responsive">
                    <div class="caption">
                        <h3>{{ $product->title }}</h3>
                        <p class="description">{{ $product->description }}</p>
                        <div class="clearfix">
                            <div class="pull-left price">{{ $product->price }}</div>
                            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success pull-right" role="button">Add to Cart</a>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
        </div>
    @endforeach

@endsection