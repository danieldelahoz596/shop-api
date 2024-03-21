<div>


  <div class="container">
    <div class="display-1">List an item</div>
    <div class="row">
      <div class="col-6">
        <div class="photo-upload-container">
          <div class="photo-upload-wrapper">
            <div class="photo-upload-heading">
              <div class="h2">Photos</div>
              <h6>Add up to 6 photos. <a href=""> Here's how to take a good </a></h6>
            </div>
            <div class="photo-upload-grid">
              <div class="photo-upload">
                <label class="photo-upload-label">
                  <input type="file" name="image" style="display: none;">
                  <img class="img-fluid" src="{{ asset('assets/img/profile_listing/photo_holder.jpg') }}" alt="">
                </label>
              </div>
              <div class="photo-upload">
                <label class="photo-upload-label">
                  <input type="file" name="image" style="display: none;">
                  <img class="img-fluid" src="{{ asset('assets/img/profile_listing/photo_holder.jpg') }}" alt="">
                </label>
              </div>
              <div class="photo-upload">
                <label class="photo-upload-label">
                  <input type="file" name="image" style="display: none;">
                  <img class="img-fluid" src="{{ asset('assets/img/profile_listing/photo_holder.jpg') }}" alt="">
                </label>
              </div>
              <div class="photo-upload">
                <label class="photo-upload-label">
                  <input type="file" name="image" style="display: none;">
                  <img class="img-fluid" src="{{ asset('assets/img/profile_listing/photo_holder.jpg') }}" alt="">
                </label>
              </div>
              <div class="photo-upload">
                <label class="photo-upload-label">
                  <input type="file" name="image" style="display: none;">
                  <img class="img-fluid" src="{{ asset('assets/img/profile_listing/photo_holder.jpg') }}" alt="">
                </label>
              </div>
              <div class="photo-upload">
                <label class="photo-upload-label">
                  <input type="file" name="image" style="display: none;">
                  <img class="img-fluid" src="{{ asset('assets/img/profile_listing/photo_holder.jpg') }}" alt="">
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-6">
        <div class="product-info-container">
          <div class="product-info-wrapper">
            <div class="product-name-container pb-4">
              <h1>Product Name</h1>
              <div class="product-input position-relative" x-data="{name:''}">
                <input type="text" x-model="name" maxlength="50">
                <span class="text-limit" > <span x-text="name.length"></span>/50</span>
              </div>
            </div>
            <div class="product-description-container">
              <div class="product-description-wrapper">
                <div class="product-description-heading">
                  <h1>Description</h1>
                  <p class="m-0">Tell us about your unique item!</p>
                  <a href=""> Here are some tips for making a description</a>
                </div>
                <div class="product-description-input position-relative"  x-data="{text:''}">
                  <textarea name="textarea" x-model="text" maxlength="200"></textarea>
                  <div class="text-limit"><span x-text="text.length"></span>/200</div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


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