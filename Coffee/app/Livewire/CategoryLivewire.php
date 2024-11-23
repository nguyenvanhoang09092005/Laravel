<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryLivewire extends Component
{
    public $categories = [];
    public $selectedCategory = null;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.CategoryLivewire');
    }
}
