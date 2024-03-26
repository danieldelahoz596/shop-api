<div>
    @if(count($cartItems) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
            <tr>
                <td>{{ $item->product->product_name }}</td>
                <td>${{ number_format($item->product->price, 2) }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->quantity * $item->product->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th>${{ number_format($total, 2) }}</th>
            </tr>
        </tfoot>
    </table>
    @if(count($cartItems) > 0)
    <button wire:click="checkout" class="btn btn-primary">Checkout</button>
    @endif
    @else
    <p>Your cart is empty.</p>
    @endif
</div>