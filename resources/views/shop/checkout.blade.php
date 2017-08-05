@extends('layouts.master')

@section('title', 'Checkout')
@section('content')
    <form action="{{ route('cart.checkout') }}" method="post" id="checkout-form">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <header class="page-header">
                    <h2 class="page-title">Secure Payment Form</h2>
                </header>
                <div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }}">
                    {{ Session::get('error') }}
                </div>

                <div class="form-group">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Billing Details</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" id="address" name="address" placeholder="Street Address" value="10777 Santa Monica Boulevard" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">City</label>
                                    <input type="text" id="city" name="city" placeholder="City" value="Los Angeles" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">State</label>
                                    <input type="text" id="state" name="state" placeholder="State" value="California" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Country</label>
                                    <input type="text" id="country" name="country" placeholder="Country" value="United States of America" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Postal Code</label>
                                    <input type="text" id="zip" name="zip" maxlength="9" placeholder="Zip/Postal Code" value="90025-4718" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Card Details  (Payment Integration using STRIPE)</h3>
                            </div>
                            <div class="panel-body">
                            <h5>You can use the card number <strong>4242424242424242</strong> with any CVC and a valid expiration date (any date in the future) for testing purpose.</h5>
                                <div class="form-group">
                                    <label for="">Card Holder's Name</label>
                                    <input type="text" id="card-name" name="card-name" maxlength="70" placeholder="Card Holder Name" value="Demo Name" class="card-holder-name form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Card Number</label>
                                    <input type="tel" id="card-number" maxlength="16" placeholder="Card Number" value="4242424242424242" class="card-number form-control" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="">Card Expiry Month</label>
                                            {!! Form::selectMonth('card-expiry-month', null, ['id' => 'card-expiry-month', 'class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Card Expiry Year</label>
                                            {!! Form::selectYear('card-expiry-year', date('Y'), date('Y')+5, 'S', ['id' => 'card-expiry-year', 'class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">CVC Code</label>
                                            <input type="tel" id="card-cvc" placeholder="" maxlength="4" class="card-cvc form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-success" type="submit">Pay Now</button>
                        </div>
                    </div>

                </div>
            </div>
    </form>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript" src="{{ asset('/js/stripe.js') }}"></script>
@endsection