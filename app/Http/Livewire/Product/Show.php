<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class Show extends Component
{
    public $product = null;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        $logs = Activity::where('subject_id', $this->product->id)
            ->where('subject_type', 'App\Models\Product')
            ->orderBy('created_at', 'asc')
            ->get();            
        return view('livewire.product.show', compact(['logs']));
    }
}
