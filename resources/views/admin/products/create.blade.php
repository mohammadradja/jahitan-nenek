@extends('layouts.dashboard')

@section('role_name', 'Admin')
@section('page_title', 'Tambah Produk Baru')

@section('dashboard_content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-10 lg:p-16">
                <div class="flex items-center space-x-4 mb-12">
                    <div class="w-12 h-12 bg-soft-rose/10 rounded-2xl flex items-center justify-center text-soft-rose">
                        <i class="fas fa-box-open text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-serif font-bold text-dark-wool">Informasi Produk Baru</h3>
                        <p class="text-sm text-gray-400">Tambahkan mahakarya rajutan terbaru ke dalam koleksi Anda.</p>
                    </div>
                </div>

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8" x-data="{
                        createPriceMinDisplay: @json(old('price_min')
                                ? 'Rp ' . number_format((int) old('price_min'), 0, ',', '.')
                                : (old('price')
                                    ? 'Rp ' . number_format((int) old('price'), 0, ',', '.')
                                    : '')),
                        createPriceMaxDisplay: @json(old('price_max')
                                ? 'Rp ' . number_format((int) old('price_max'), 0, ',', '.')
                                : (old('price')
                                    ? 'Rp ' . number_format((int) old('price'), 0, ',', '.')
                                    : '')),
                        formatRupiah(value) {
                            const digits = String(value ?? '').replace(/[^0-9]/g, '');
                            if (!digits) {
                                return '';
                            }
                    
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(Number(digits));
                        },
                        parseRupiah(value) {
                            return String(value ?? '').replace(/[^0-9]/g, '');
                        },
                        syncCurrencyFields() {
                            const priceMin = this.parseRupiah(this.createPriceMinDisplay);
                            const priceMax = this.parseRupiah(this.createPriceMaxDisplay);
                    
                            this.$refs.price.value = priceMin || priceMax;
                            this.$refs.priceMin.value = priceMin || priceMax;
                            this.$refs.priceMax.value = priceMax || priceMin;
                        }
                    }" x-on:submit="syncCurrencyFields()">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Nama
                                Produk</label>
                            <input type="text" name="name" id="name" class="input-premium"
                                placeholder="Contoh: Cardigan Klasik" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Slug
                                (URL)</label>
                            <input type="text" name="slug" id="slug" class="input-premium"
                                placeholder="cardigan-klasik" value="{{ old('slug') }}" required>
                            @error('slug')
                                <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Kategori
                                Koleksi</label>
                            <select name="category_id" class="input-premium appearance-none" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Stok
                                Awal</label>
                            <input type="number" name="stock" min="0" class="input-premium" placeholder="Contoh: 10"
                                value="{{ old('stock') }}" required>
                            <p class="mt-2 text-[11px] text-gray-400">Jumlah stok awal yang siap dipesan pelanggan.</p>
                            @error('stock')
                                <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Estimasi
                                    Harga Dari (Rp)</label>
                                <input type="hidden" name="price" x-ref="price" value="{{ old('price') }}">
                                <input type="hidden" name="price_min" x-ref="priceMin" value="{{ old('price_min') }}">
                                <input type="hidden" name="price_max" x-ref="priceMax" value="{{ old('price_max') }}">
                                <input type="text" inputmode="numeric" class="input-premium" placeholder="Rp 150.000"
                                    x-model="createPriceMinDisplay"
                                    @input="createPriceMinDisplay = formatRupiah(createPriceMinDisplay)" required>
                                <p class="mt-2 text-[11px] text-gray-400">Harga estimasi terendah, otomatis diformat Rupiah.</p>
                                @error('price')
                                    <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}
                                    </p>
                                @enderror
                                @error('price_min')
                                    <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Estimasi
                                    Harga Sampai (Rp)</label>
                                <input type="text" inputmode="numeric" class="input-premium" placeholder="Rp 250.000"
                                    x-model="createPriceMaxDisplay"
                                    @input="createPriceMaxDisplay = formatRupiah(createPriceMaxDisplay)">
                                <p class="mt-2 text-[11px] text-gray-400">Kosongkan jika harga estimasi hanya satu angka.</p>
                                @error('price_max')
                                    <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-span-2">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Upload
                                Gambar Produk</label>
                            <x-ui.image-upload name="image_file" required />
                            @error('image_file')
                                <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label
                                class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Deskripsi
                                Produk</label>
                            <textarea name="description" class="input-premium h-40 py-4 resize-none"
                                placeholder="Tuliskan detail pakaian, bahan, ukuran, dan nuansa warnanya...">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="pt-10 flex items-center space-x-4 border-t border-gray-50">
                        <button type="submit" class="btn-premium px-12 py-4 shadow-xl shadow-soft-rose/20">
                            Simpan Produk
                        </button>
                        <a href="{{ route('admin.products.index') }}"
                            class="px-8 py-4 font-bold text-gray-400 hover:text-dark-wool transition-colors">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('name').addEventListener('input', function() {
                let slug = this.value.toLowerCase()
                    .replace(/[^\w ]+/g, '')
                    .replace(/ +/g, '-');
                document.getElementById('slug').value = slug;
            });
        </script>
    @endpush
@endsection
