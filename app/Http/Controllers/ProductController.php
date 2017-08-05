<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Product;
use App\Order;
use App\Cart;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Error\Card;
use Stripe\Error\InvalidRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getIndex()
    {
        $products = Product::all();
        return view('shop.index', compact('products'));
    }

    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $old_cart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($old_cart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        $success = $product->title . " has been added to your cart.";
        return redirect()->route('product.index')->with('success', $success);
    }

    public function getRemoveFromCart(Request $request, $id)
    {
        $product = Product::find($id);
        $old_cart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($old_cart);
        $remove = $cart->remove($product, $product->id);

        $message = [];
        $message['type'] = 'alert-success';
        $message['text'] = $product->title . " has been removed from your cart.";

        if($remove == 2) {
            $request->session()->forget('cart');
        } else if($remove == 1) {
            $request->session()->put('cart', $cart);
        } else {
            $message['type'] = 'alert-danger';
            $message['text'] = 'Your cart is empty.';
        }
        return redirect()->route('product.index', compact('message'));
    }

    public function postUpdateCart(Request $request) {

        $this->validate($request, [
            'quantity' => 'required|numeric|min:1'
        ]);

        $message = [];

        if( Session::has('cart') ) {
            $product_id = $request['product_id'];
            $product = Product::find($product_id);
            $old_cart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($old_cart);
            $update = $cart->update($product, $product->id, $request['quantity']);

            $request->session()->put('cart', $cart);

            $message['type'] = 'alert-success';
            $message['text'] = $product->title . " has been updated.";
        } else {
            $message['type'] = 'alert-danger';
            $message['text'] = 'Your cart is empty.';
        }

        return redirect()->route('cart', compact('message'));
    }

    public function getCart()
    {
        if(! Session::has('cart') ) {
            return view('shop.cart');
        }

        $old_cart = Session::get('cart');
        $cart = new Cart($old_cart);

        return view('shop.cart', ['products' => $cart->items, 'total' => $cart->total_price]);
    }

    public function getCheckout()
    {
        if(! Session::has('cart') ) {
            return view('shop.cart');
        }

        $old_cart = Session::get('cart');
        $cart = new Cart($old_cart);

        return view('shop.checkout', ['products' => $cart->items, 'total' => $cart->total_price]);
    }

    public function postCheckout(Request $request)
    {
        if(! Session::has('cart') ) {
            return redirect()->route('cart');
        }

       $this->validate($request, [
           'address' => 'required',
           'country' => 'required',
           'state' => 'required',
           'city' => 'required',
           'zip' => 'required',
       ]);

        $old_cart = Session::get('cart');
        $cart = new Cart($old_cart);

        Stripe::setApiKey('sk_test_YSCNd9Qe19xJWVd1xKpLQ842'); //test secret key

        // Create the charge on Stripe's servers - this will charge the user's card
        try {
            $order_number = rand(1000, 9999);
            $charge = Charge::create(array(
                "amount" => $cart->total_price * 100, // amount in cents converted to dollars
                "currency" => "usd",
                "source" => $request->stripeToken, // obtained with Stripe.js
                "description" => "Order #" . $order_number . " - " . date('F d, Y g:ia') //uniqid() based on microtime
            ));

            $order = new Order();
            $order->number = $order_number;
            $order->cart = serialize($cart);
            $order->payment_id = $charge->id;
            $order->address = $request->input('address');
            $order->city = $request->input('city');
            $order->state = $request->input('state');
            $order->country = $request->input('country');
            $order->zip = $request->input('zip');
            
            Auth::user()->orders()->save($order);

        } catch (InvalidRequest $e) {
            return redirect()->route('cart.checkout')->with('error', $e->getMessage());
        } catch (Card $e) {
            return redirect()->route('cart.checkout')->with('error', $e->getMessage());
        }

        Session::forget('cart');
        return redirect()->route('product.index')->with('success', 'Your Order # ' . $order_number . ' was successful');
    }
}
