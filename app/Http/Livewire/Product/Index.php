<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    public $itemsShownPerPage = 9;

    public function render()
    {
        return view('livewire.product.index', [
            'products' => Product::orderBy('name', 'asc')->paginate($this->itemsShownPerPage)
        ]);
    }
}
