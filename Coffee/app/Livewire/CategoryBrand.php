<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Store;
use Livewire\Component;

class CategoryBrand extends Component
{
    public $categories = [];
    public $selectedCategory = null;
    public $brands = [];
    public $selectedBrand = null;
    public $stores = [];
    public $selectedStore = null;

    public function mount()
    {
        $this->categories = Category::all();
        $this->brands = Brand::all();
        $this->stores = Store::all();
    }

    public function render()
    {
        return view('livewire.category-brand');
    }
}
