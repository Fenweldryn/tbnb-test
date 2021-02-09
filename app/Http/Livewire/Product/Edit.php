<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;

class Edit extends Component
{
    public $product = null;
    public $lastPageSeen = null;

    protected $rules = [
        'product.name' => 'required|min:3',
        'product.price' => 'required|min:1',
        'product.quantity' => "required|min:1"
    ];

    public function mount(Product $product)
    {
        $this->lastPageSeen = parse_url(url()->previous())['query'] ?? 1;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.product.edit');
    }

    public function submit()
    {
        $validated = $this->validate()['product'];
        
        $this->product->name = $validated['name'];
        $this->product->price = $validated['price'];
        $this->product->quantity = $validated['quantity'];
        $this->product->update();

        session()->flash('success', 'Product updated successfuly.');
        redirect('products?' . $this->lastPageSeen);
    }
}
