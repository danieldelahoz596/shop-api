<div>
    <!-- Section for more items from the same seller -->
    @if(count($sellerProducts) > 0)
    <div class="recommendations-wrapper" style="margin-top: 20px;">
        <h3 style="margin-bottom: 20px; text-align: center;">More from this seller:</h3>
        <div class="recommendations"
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px; justify-items: center;">
            @foreach($sellerProducts as $product)
            <div class="recommended-product"
                style="border: 1px solid #ddd; padding: 16px; width: 180px; text-align: center;">
                <img src="{{ $product->image_path }}" alt="{{ $product->product_name }}"
                    style="width: 100%; height: auto; margin-bottom: 8px;">
                <div style="margin-bottom: 4px; font-weight: bold;">{{ $product->product_name }}</div>
                <div style="margin-top: 8px; font-size: 18px; color: #000;">${{ number_format($product->price, 2) }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Section for items from the same category -->
    @if(count($categoryProducts) > 0)
    <div class="recommendations-wrapper" style="margin-top: 20px;">
        <h3 style="margin-bottom: 20px; text-align: center;">You might also like:</h3>
        <div class="recommendations"
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px; justify-items: center;">
            @foreach($categoryProducts as $product)
            <div class="recommended-product"
                style="border: 1px solid #ddd; padding: 16px; width: 180px; text-align: center;">
                <img src="{{ $product->image_path }}" alt="{{ $product->product_name }}"
                    style="width: 100%; height: auto; margin-bottom: 8px;">
                <div style="margin-bottom: 4px; font-weight: bold;">{{ $product->product_name }}</div>
                <div style="margin-top: 8px; font-size: 18px; color: #000;">${{ number_format($product->price, 2) }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>