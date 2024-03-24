<div>
    <div class="steals ps-5">
        <div class="display-6 tertiary-color fw-bold py-5">Steals</div>
        <div class="wrapper ps-5">
            @foreach ($steals as $steal)
                <div class="stealsContainer">
                    <h1>{{ $steal->products->product_name }}</h1>
                    <h1>P {{ $steal->item_price }}</h1>
                </div>
            @endforeach
        </div>
    </div>
</div>
