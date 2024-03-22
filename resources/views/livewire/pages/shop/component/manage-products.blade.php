<div>


  <div class="container">
    <div class="display-1 tertiary-color">List an item</div>
    <div class="row">
      <div class="col-6">
        <div class="photo-upload-container">
          <div class="photo-upload-wrapper">
            <div class="photo-upload-heading">
              <div class="h2 tertiary-color">Photos</div>
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
              <h1 class="tertiary-color">Product Name</h1>
              <div class="product-input position-relative" x-data="{name:''}">
                <input type="text" x-model="name" maxlength="50">
                <span class="text-limit"> <span x-text="name.length"></span>/50</span>
              </div>
            </div>
            <div class="product-description-container">
              <div class="product-description-wrapper">
                <div class="product-description-heading">
                  <h1 class="tertiary-color">Description</h1>
                  <p class="m-0">Tell us about your unique item!</p>
                  <a href=""> Here are some tips for making a description</a>
                </div>
                <div class="product-description-input position-relative" x-data="{text:''}">
                  <textarea name="textarea" x-model="text" maxlength="200"></textarea>
                  <div class="text-limit"><span x-text="text.length"></span>/200</div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row py-4">
      <div class="col-6">
        <div class="price-container">
          <div class="price-wrapper">
            <div class="price-input-container">
              <h2 class="fw-bold">Price</h2>
              <label class="price-label position-relative">
                <span class="price-icon"><i class="fa-solid fa-peso-sign"></i></span>
                <input type="number">
              </label>
            </div>
            <div class="accept-offer-container d-flex">
              <div class="accept-offer-wrapper">
                <input type="checkbox" class="checkbox" id="checkbox">
                <label class="switch" for="checkbox">
                  <span class="slider"></span>
                </label>
              </div>
              <div class="accept-offer-info">
                <h2 class="fw-bold">Accept offers</h2>
                <p class="m-0 w-75">Let buyers make an offer at a different price in buying the product</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="tags-container">
          <div class="tags-wrapper d-flex flex-column">
            <h3 class="fw-bold">
              Tags
            </h3>
            <p class="fw-medium tertiary-color">Let more people discover this!</p>
            <a href="">Tag tips</a>
            <label class="d-flex flex-column position-relative">
              <input type="text">
              <span class="limit-text position-absolute">0/10</span>
            </label>
          </div>
        </div>
      </div>
    </div>

    <div class="row py-4">
      <div class="col-6">
        <div class="about-item-container">
          <div class="about-item-wrapper d-flex flex-column" style="row-gap: 1rem;">
            <h3 class="fw-bold tertiary-color">About the Item</h3>

            <div class="category-select">
              <select class="form-select" aria-label="Default select example">
                <option selected>Category</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>

            <div class="Subcategory-select">
              <select class="form-select" aria-label="Default select example">
                <option selected>Subcategory</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>

            <div class="Condition-select">
              <select class="form-select" aria-label="Default select example">
                <option selected>Condition</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>

            <div class="Size-select">
              <select class="form-select" aria-label="Default select example">
                <option selected>Size</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="listing-container">
          <div class="listing-wrapper d-flex flex-column" style="row-gap: 1rem;">
            <h3 class="fw-bold tertiary-color">
              Enhance listing
            </h3>

            <div class="Color-select">
              <select class="form-select" aria-label="Default select example">
                <option selected>Color</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>

            <div class="Brand-select">
              <select class="form-select" aria-label="Default select example">
                <option selected>Brand</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>

            <div class="Style-select">
              <select class="form-select" aria-label="Default select example">
                <option selected>Style</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="measurement-container py-4">
      <div class="measurement-wrapper">
        <div class="measurement-heading pb-4">
          <div class="head-wrapper d-flex justify-content-between">
            <div class=" h3 fw-bold tertiary-color">Measurements
              <span class="muted-color">(Optional)</span>
            </div>

            <div class="guide-link"><a href="">Guide <span><i class="fa-solid fa-arrow-right"></i></span></a></div>
          </div>
          <p>You've got a 40% better chance of selling this item if you add measurements. Include as many as applicable.</p>
        </div>

        <div class="measurement-unit">
          <div class="unit-wrapper">
            <input type="radio" id="in" checked name="check-substitution-2" />
            <label class="btn btn-default fs-lg " for="in">In</label>
          </div>
          <div class="unit-wrapper">
            <input type="radio" id="cm" name="check-substitution-2" />
            <label class="btn btn-default fs-lg " for="cm">Cm</label>
          </div>
        </div>

        <div class="clothe-unit-container pt-4">
          <div class="clothe-unit-wrapper">
            <div class="clothe-container">
              <h3>Chest</h3>
              <label class="position-relative">
                <input type="number">
                <span class="clothe-unit">in</span>
              </label>
            </div>
            <div class="clothe-container">
              <h3>Shoulders</h3>
              <label class="position-relative">
                <input type="number">
                <span class="clothe-unit">in</span>
              </label>
            </div>
            <div class="clothe-container">
              <h3>Sleeve length</h3>
              <label class="position-relative">
                <input type="number">
                <span class="clothe-unit">in</span>
              </label>
            </div>
            <div class="clothe-container">
              <h3>Length</h3>
              <label class="position-relative">
                <input type="number">
                <span class="clothe-unit">in</span>
              </label>
            </div>
            <div class="clothe-container">
              <h3>Hem</h3>
              <label class="position-relative">
                <input type="number">
                <span class="clothe-unit">in</span>
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="shipping-container py-4">
      <div class="shipping-wrapper">
        <div class="shipping-heading">
          <h3 class="fw-bold tertiary-color pb-3">
            Shipping
          </h3>
        </div>
        <div class="shipping-details-wrapper">
          <div class="shipping-details">
            <div class="main-info d-flex justify-content-between">
              <p class="d-flex flex-column">
                <span class="muted-color fs-5 lh-1">Danielle Pestilos</span>
                <span class="muted-color fs-5 lh-1">+63 912 345 6780</span>
                <span class="muted-color fs-5 lh-1">Region, Province, City/Municipality, Barangay, House/Building No, Zip Code</span>
              </p>
              <div class="shipping-icon">
                <a href=""><i class="fa-solid fa-chevron-right"></i></a>
              </div>
            </div>
            <div class="additional-info pt-3  border-bottom">
              <span class="muted-color fs-5">
                Additional information
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="size-container py-4">
      <h3 class="fw-bold tertiary-color pb-3">Parcel Size</h3>
      <div class="size-wrapper">
        <div class="row">
          <div class="col-6">
            <div class="shipping-size-style d-flex flex-column">
              <div class="shipping-style">
                <h3>Weight</h3>
                <label class="position-relative">
                  <input type="number">
                  <span class="size-unit fs-lg">kg</span>
                </label>
              </div>
              <div class="dimension-style d-flex align-items-center">
                <div class="dimension-container d-flex justify-content-center align-items-center">
                  <span class="fs-lg">L</span>
                  <label>
                    <input type="number">
                    <span class="ps-2 fs-lg">cm</span>
                  </label>
                </div>
                <div><span>X</span></div>
                <div class="dimension-container d-flex justify-content-center align-items-center">
                  <span class="fs-lg">L</span>
                  <label>
                    <input type="number">
                    <span class="ps-2 fs-lg">cm</span>
                  </label>
                </div>
                <div><span>X</span></div>
                <div class="dimension-container d-flex justify-content-center align-items-center">
                  <span class="fs-lg">L</span>
                  <label>
                    <input type="number">
                    <span class="ps-2 fs-lg">cm</span>
                  </label>
                </div>
              </div>
              <div class="fee-style">
                <div class="shipping-style">
                  <h3>Shipping fee</h3>
                  <label class="position-relative">
                    <input type="number">
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="cod-container d-flex flex-column">
              <div class="cod-wrapper d-flex justify-content-between align-items-center">
                <span class="h3">Enable COD</span>
                <div class="cod-icon">
                  <input type="checkbox" class="cod-checkbox" id="cod-checkbox">
                  <label class="switch" for="cod-checkbox">
                    <span class="slider"></span>
                  </label>
                </div>
              </div>
              <div class="cod-wrapper d-flex justify-content-between align-items-center">
                <span class="h3">Standard Local</span>
                <div class="standard-icon">
                  <input type="checkbox" class="standard-checkbox" id="standard-checkbox">
                  <label class="switch" for="standard-checkbox">
                    <span class="slider"></span>
                  </label>
                </div>
              </div>
              <div class="cod-description">
                <p class="fs-5 fw-medium lh-1 tertiary-color">
                  Shipping settings will be applicable for this product only. Shipping fees displayed are base rates and will be subject to change depending on buyer and seller location. Economy Local base rates shown are only applicable to sellers in Metro Manila (and select Luzon cities) for shipments to VisMin, which will be 30% cheaper than Standard Local. Kindly contact your Relationship Manager to know more about Economy Local and how to activate it.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>


</div>