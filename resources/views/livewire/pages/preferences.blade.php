<div>
    <form wire:submit.prevent="savePreferences">
        <div class="container">
            <div class="py-5" style="min-height: 800px;">
                <div class="text-center">
                    <h3 class="fw-bolder onboarding-title">What are you shopping for?</h3>
                    <p>Or are you shopping for everyone? <br> You can select them all!</p>
                </div>

                <div class="row mb-5">
                    @foreach ($categories as $category)
                        <div class="col">
                            <div class="px-3 py-2 onboarding-category" onclick="this.querySelector('input').click();">
                                <label onclick="this.querySelector('input').click();">
                                    <input type="checkbox" value="{{ $category->id }}" wire:change="fetchSubCategories()" onclick="event.stopPropagation();" class="form-check-input">
                                    {{ $category->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center">
                    <h3 class="fw-bolder onboarding-title">Let's curate your style</h3>
                    <p>Choose styles that represent <br> you the most!</p>
                </div>

                <div class="row mb-5">
                    @foreach ($subcategories as $subcategory)
                        <div class="col-md-3 mt-2">
                            <div class="px-3 py-2 onboarding-category" onclick="this.querySelector('input').click();">
                                <label onclick="this.querySelector('input').click();">
                                    <input type="checkbox" value="{{ $subcategory->id }}" onclick="event.stopPropagation();" class="form-check-input">
                                    {{ $subcategory->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center">
                    <h3 class="fw-bolder onboarding-title">Items you are into lately</h3>
                    <p>Let us know so we can give you a <br> beter Buudl experience!</p>
                </div>

                <div class="row mb-5">
                    @foreach ($subsubcategories as $subsubcategory)
                        <div class="col-md-3 mt-2">
                            <div class="px-3 py-2 onboarding-category" onclick="this.querySelector('input').click();">
                                <label onclick="this.querySelector('input').click();">
                                    <input type="checkbox" value="{{ $subsubcategory->id }}" onclick="event.stopPropagation();" class="form-check-input">
                                    {{ $subsubcategory->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                @error('preferences') <span class="error">{{ $message }}</span> @enderror

                <button class="btn btn-block btn-primary w-100 signIn text-white">Continue</button>
            </div>
        </div>
    </form>
</div>
