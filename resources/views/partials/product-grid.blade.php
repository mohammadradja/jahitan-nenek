<div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-10">
    @forelse($products as $product)
        <x-product.product-card :product="$product" :delay="$loop->index * 100" />
    @empty
        <div class="col-span-full py-32 text-center" data-aos="fade-up">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-50 rounded-[2rem] mb-8 transition-transform hover:rotate-12 duration-500">
                <i class="fas fa-search text-3xl text-gray-200"></i>
            </div>
            <h3 class="text-3xl font-serif font-bold text-dark-wool mb-4 italic">Kehangatan tidak ditemukan...</h3>
            <p class="text-gray-400 max-w-sm mx-auto mb-10 leading-relaxed font-medium text-sm">Maaf, kami tidak menemukan produk yang sesuai dengan kriteria Anda. Coba kata kunci lain atau hapus filter.</p>
            <button @click="resetFilters()" class="px-10 py-4 bg-dark-wool text-white rounded-2xl font-bold text-[10px] uppercase tracking-[0.2em] hover:bg-soft-rose transition-all shadow-2xl shadow-dark-wool/20">
                Hapus Semua Filter
            </button>
        </div>
    @endforelse
</div>

<div class="mt-20">
    {{ $products->links('vendor.pagination.premium') }}
</div>
