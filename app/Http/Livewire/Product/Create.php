<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductLog;

class Create extends Component
{
    public $name = null;
    public $price = null;
    public $quantity = null;

    protected $rules = [
        'name' => 'required|min:3',
        'price' => 'required|min:1',
        "quantity" => "required|min:1"
    ];

    public function render()
    {
        return view('livewire.product.create');
    }

    public function submit()
    {
        $validated = $this->validate();

        $product = Product::create($validated);       

        session()->flash('success', 'Product created successfuly.');
        $this->reset();
    }
}
