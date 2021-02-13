<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}             
        </h2>
    </x-slot>

    <div wire:loading class='block mt-5'>
        <i class="fas fa-spinner fa-pulse fa-5x"></i>
    </div>
    @if (session()->has('success'))
        <div class="text-green-500 bg-white shadow-md rounded-md p-3 mb-5">
            <i class="fas fa-check mr-2"> {{ session('success') }}</i>
        </div>            
    @endif

    <a type="button" 
        href={{ route('products.create') }}
        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-white tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 mb-3">
        <i class="fas fa-plus mr-1"></i> New Product
    </a>      

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-7 mt-5 mx-3 md:mx-0" wire:loading.class="invisible">
        @forelse($products as $product)
          <div class="flex flex-wrap bg-white rounded-lg border-l-8 border-blue-800 w-full" wire:key="card-{{ $product->id }}">
            <div class="rounded-lg w-full">          
              <div class="w-full p-4">
                <div class='relative'>
                  <h2 class="font-bold text-2xl text-blue-700 inline uppercase">{{$product->name}}</h2>                 
                </div>
                <div class="py-2 text-gray-600">                                 
                    <p class="mt-1">
                       U$ {{ $product->price }}
                    </p>                                      
                    <p class='mt-1'>
                       {{ $product->quantity }} units
                    </p>                        
                    
                </div>
              </div>
            </div>
               
            <div class='w-full'>
                <div class="p-4 flex space-x-4 self-end w-full">
                    <a type="button" href="" class="w-1/2 px-4 py-3 text-center bg-gray-200 text-gray-400 hover:bg-red-600 hover:text-black font-bold rounded-lg disabled:opacity-50 disabled:cursor-default">
                        <i class="fas fa-trash"></i>
                    </a>
                    <a type="button" href="{{ route('products.show', $product->slug) }}" class="w-1/2 px-4 py-3 text-center bg-gray-200 text-gray-400 hover:bg-yellow-400 hover:text-black font-bold rounded-lg disabled:opacity-50 disabled:cursor-default">
                        <i class="fas fa-history"></i>
                    </a>
                    <a type="button" href="{{ route('products.edit', $product->slug) }}" class="w-1/2 px-4 py-3 text-center text-gray-400 bg-gray-200 rounded-lg hover:bg-blue-700 hover:text-white font-bold disabled:opacity-50 disabled:cursor-default">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    </div>
                </div>
          </div>          
          @empty
            No records found.
        @endforelse
    </div>
    <div class='mt-5'>
        {{ $products->links() }}
    </div>

    @push('scripts')
        <script>
            window.onscroll = function(ev) {
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                    window.livewire.emit('loadMore')
                }
            };
        </script>
    @endpush
</div>
