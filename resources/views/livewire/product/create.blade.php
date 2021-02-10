<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            New Product
        </h2>
    </x-slot>

    <form wire:submit.prevent="submit" class='grid gap-4 grid-cols-1 md:grid-cols-2 w-auto mx-5 md:mx-0 md:w-auto'>        
        <div>   

            @if (session()->has('success'))
                <div class="text-green-500 bg-white shadow-md rounded-md p-3 mb-5">
                    <i class="fas fa-check mr-2"> {{ session('success') }}</i>
                </div>            
            @endif      

            @for ($i = 1; $i <= $numberOfProductForms; $i++)
                <div class="shadow-md rounded-md bg-white p-5 mb-5">
                    @if ($i !== 1)
                        <button class="float-right mr-2">
                            <i class="fas fa-times"></i>                        
                        </button>
                    @endif

                    <div class="col-span-1">
                        <label for="products.{{ $i-1 }}.name">Name</label>
                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" wire:model.debounce.300ms="products.{{ $i-1 }}.name" placeholder="">
                        <x-jet-input-error for="products.{{ $i-1 }}.name" class="mt-2" />
                    </div>
    
                    <div class="col-span-1 mt-5">
                        <label for="products.{{ $i-1 }}.price">Price</label>
                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" wire:model.debounce.300ms="products.{{ $i-1 }}.price" placeholder="">
                        <x-jet-input-error for="products.{{ $i-1 }}.price" class="mt-2" />
                    </div>
    
                    <div class="col-span-1 mt-5">
                        <label for="products.{{ $i-1 }}.quantity">Quantity</label>
                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" wire:model.debounce.300ms="products.{{ $i-1 }}.quantity" placeholder="">
                        <x-jet-input-error for="products.{{ $i-1 }}.quantity" class="mt-2" />
                    </div>
                </div>  
            @endfor
            <div class="col-span-12 mt-5 inline-flex w-full flex-row-reverse">
                <div wire:loading wire:target="submit">
                    <i class="fas fa-spinner fa-pulse fa-2x"></i>
                </div>

                <button type="submit" 
                    wire:loading.class="invisible"                 
                    wire:target="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-white tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    <i class="fas fa-save mr-1"></i> Save
                </button>    

                <button type="button" 
                    wire:click="addProductForm"
                    class="inline-flex mr-3 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-white tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    <i class="fas fa-plus mr-1"></i> Add More
                </button>    
                
                <a href="{{ route('products') }}" class="px-4 py-2 text-center border border-transparent bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-black font-bold rounded-lg mr-3">
                    <i class="mr-2 fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>  
    </form>
    
</div>
