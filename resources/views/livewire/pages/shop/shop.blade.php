<div>
    Success is as dangerous as failure. <br>

    @foreach ($products as $product)
        <ul>
            <li>{{ $product->id }} - {{ $product->category_id }} - {{ $product->subcategory_id }} -{{ $product->product_name }}</li>
        </ul>
    @endforeach

    {{ $products->links() }}
</div>
