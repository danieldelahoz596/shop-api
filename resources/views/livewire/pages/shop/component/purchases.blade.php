<div>

    <h3>Purchases</h3>
    <h5>Products sold: {{ $productsSoldCount }}</h5>
    @if ($sales->isEmpty())
    <p>No sales yet.</p>
    @else
    @foreach ($sales as $sale)
    <div>
        <p>{{ $sale->product_name }} -Item Price: {{ $sale->item_price }} - Quantity Sold: {{ $sale->item_quantity }}
        </p>
    </div>

    @endforeach
    @endif


</div>