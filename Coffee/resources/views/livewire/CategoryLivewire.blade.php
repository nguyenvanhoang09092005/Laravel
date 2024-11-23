<div class="cols gap22">



    <fieldset class="category ">
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

</div>
