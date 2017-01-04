@extends('main_layout')

@section('content')

<div class="container" style="width: 60%">
    <h1>Your Cart</h1>
    <table class="table">
        <tbody>
            <tr>
                <td>
                    <b>Title</b>
                </td>
                <td>
                    <b>Amount</b>
                </td>
                <td>
                    <b>Price</b>
                </td>
                <td>
                    <b>Total</b>
                </td>
                <td>
                    <b>Delete</b>
                </td>
            </tr>
            @foreach($cart_books as $cart_item)
            <tr>
                <td>{{$cart_item->relBooks->title}}</td>
                <td>{{$cart_item->amount}}</td>
                <td>{{$cart_item->relBooks->price}}</td>
                <td>{{$cart_item->total}}</td>
                <td><a href="{{URL::route('delete_book_from_cart',array($cart_item->id))}}"</td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td><b>Total</b></td>
                <td><b>{{$cart_total}}</b></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <h1>Shipping</h1>
    <form action="/order" method="post" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label>Address</label>
        <textarea class="span4" name="address" rows="5"></textarea>
        <button class="btn btn-block btn-primary btn-large">Place Order</button>
    </form>
</div>
@stop

