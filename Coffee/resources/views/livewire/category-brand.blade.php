<div class="cols gap22">


    <fieldset class="brand col">
        <div class="body-title mb-10">Brand <span class="tf-color-1">*</span></div>
        <div class="select">
            <select class="body-title mb-10" name="brand_id" wire:model="selectedBrand">
                <option value="">Choose Brand</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                @endforeach
            </select>
        </div>
    </fieldset>

    <fieldset class="category col-5">
        <div class="body-title mb-10">Category <span class="tf-color-1">*</span></div>
        <div class="select">
            <select class="body-title mb-10" name="category_id" wire:model="selectedCategory">
                <option value="">Select A Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
    </fieldset>

    <fieldset class="store col">
        <div class="body-title mb-10">Store <span class="tf-color-1">*</span></div>
        <div class="select mb-10">
            <select class="body-title mb-10" name="store_id" wire:model="selectedStore">
                <option value="">Choose Store</option>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                @endforeach
            </select>
        </div>
    </fieldset>


</div>
