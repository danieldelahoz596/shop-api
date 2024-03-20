<div>

    <form wire:submit.prevent="addProduct">

        <!-- Product Name -->
        <input type="text" wire:model="product_code" placeholder="Product Code">

        <!-- Product Name -->
        <input type="text" wire:model="product_name" placeholder="Product Name">

        <!-- Product Description -->
        <textarea wire:model="product_description" placeholder="Product Description"></textarea>

        <!-- Product Name -->
        <input type="text" wire:model="slug" placeholder="Slug">

        <!-- Product Price -->
        <input type="number" wire:model="product_price" placeholder="Product Price">

        <!-- Product Price -->
        <input type="number" wire:model="quantity" placeholder="Product Qty.">

        <!-- Product Brand -->
        <select wire:model="product_brand">
            @foreach ($brands as $brand)
            <option value="{{ $brand->name  }}">{{ $brand->name }}</option>
            @endforeach
        </select>

        <!-- Product Category -->
        <select wire:model="category_id">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <select wire:model="subcategory_id">
            @foreach ($subcategories as $subcategory)
            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
            @endforeach
        </select>

        <!-- Images Upload -->
        <input type="file" wire:model="images">

        <!-- Submit Button -->
        <button type="submit">List Product</button>

        <!-- Display Success Message -->
        @if (session()->has('message'))
        <div>{{ session('message') }}</div>
        @endif
    </form>
</div>