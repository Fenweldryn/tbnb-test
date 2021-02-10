<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\ProductLog;
use Illuminate\Http\Request;

class Create extends Component
{
    public $products = [];    
    public $numberOfProductForms = 1;

    protected $rules = [
        'products' => 'required|array',
        'products.*.name' => 'required_with:products.*|min:3',
        'products.*.price' => 'required_with:products.*|min:1',
        'products.*.quantity' => 'required_with:products.*|min:1'
    ];

    public function render()
    {
        return view('livewire.product.create');
    }

    public function submit(Request $request)
    {
        $validatedProducts = $this->validate()['products'];
        foreach ($validatedProducts as $product) 
        {
            if (!empty($product)) {
                Product::create($product);                   
            }
        }

        session()->flash('success', 'Product(s) created successfuly.');
        $this->reset();
    }

    public function addProductForm()
    {
        $this->numberOfProductForms++;
        $this->products[$this->numberOfProductForms] = [];
    }
}
