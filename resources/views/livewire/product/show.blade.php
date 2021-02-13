<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Product
        </h2>
    </x-slot>

    <a href="{{ route('products') }}" class="px-4 py-2 text-center border border-transparent bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-black font-bold rounded-lg mr-2">
        <i class="mr-2 fas fa-arrow-left"></i> Back
    </a>

    <div class='flex w-full mx-5 space-x-10 md:mx-0 mt-5'>
        @if (session()->has('success'))
            <div class="text-green-500 bg-white shadow-md rounded-md p-3 mb-5">
                <i class="fas fa-check mr-2"> {{ session('success') }}</i>
            </div>            
        @endif
        <div class=" flex-grow pr-7 border-r">
            <div class="sticky top-5">
                <div class="w-full">
                    <label for="name">Name</label>
                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" readonly value={{ $product->name }}>                    
                </div>
    
                <div class="w-full mt-5">
                    <label for="price">Price</label>
                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" readonly value="U$ {{ $product->price }}"> 
                </div>
    
                <div class="w-full mt-5">
                    <label for="quantity">Quantity</label>
                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" type="text"readonly value="{{ $product->quantity }} units">
                </div>
                
            </div>
        </div>
        <div class="flex-grow">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5">History ({{ $logs->count() }})</h2>
            
            @forelse ($logs as $log)
                <div class="w-full bg-white p-5 shadow-md rounded-lg mt-4">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-3">{{ \Carbon\Carbon::parse($log->created_at)->format('m/d/Y H:i:s') }}</h3>
                    <div>
                        <label for="name">Name</label>
                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" readonly value="{{ $log->properties['old']['name'] }}">                    
                    </div>
        
                    <div class="mt-5">
                        <label for="price">Price</label>
                        <input class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" readonly value="U$ {{ $log->properties['old']['price'] }}"> 
                    </div>
        
                    <div class="mt-5">
                        <label for="quantity">Quantity</label>
                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" readonly value="{{ $log->properties['old']['quantity'] }} units"> 
                    </div>
                </div>                
            @empty
                <div class="w-full bg-white p-5 shadow-md rounded-lg mt-4">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-3">No records found.</h3>
                    <a class="px-4 transition duration-200 focus:shadow-sm focus:ring-4 focus:ring-opacity-50 text-white py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block bg-blue-500 hover:bg-blue-600 focus-blue-700 focus:ring-blue-500" href="{{ route('products.edit', $product->slug) }}"> 
                        <i class="fas fa-pencil-alt mr-2"></i>
                        Make some changes
                    </a>
                </div>
            @endforelse
            
        </div>
       
    </div>
    
</div>
