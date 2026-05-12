<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
    @forelse($products as $product)
        <x-product.product-card :product="$product" :delay="$loop->index * 100" />
    @empty
        <div class="col-span-full text-center py-24 flex flex-col items-center">
            <img src="https://illustrations.popsy.co/gray/searching.svg" alt="Not Found" class="w-64 mb-8 opacity-50">
            <h4 class="text-2xl font-serif font-bold text-gray-400">Oops! Produk tidak ditemukan.</h4>
            <button @click="resetFilters" class="btn-premium mt-8">Reset Pencarian</button>
        </div>
    @endforelse
</div>

<div class="mt-20">
    {{ $products->links('vendor.pagination.premium') }}
</div>
