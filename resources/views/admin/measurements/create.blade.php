@extends('layouts.dashboard')

@section('role_name', 'Admin')
@section('page_title', 'Tambah Ukuran Pelanggan')

@section('dashboard_content')
<div class="max-w-4xl animate__animated animate__fadeIn">
    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-10 lg:p-16">
            <div class="flex items-center space-x-4 mb-12">
                <div class="w-12 h-12 bg-soft-rose/10 rounded-2xl flex items-center justify-center text-soft-rose">
                    <i class="fas fa-ruler-combined text-xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-serif font-bold text-dark-wool">Input Data Antropometri</h3>
                    <p class="text-sm text-gray-400">Pastikan pengukuran dilakukan dengan teliti untuk hasil rajutan yang sempurna.</p>
                </div>
            </div>

            <form action="{{ route('admin.measurements.store') }}" method="POST" class="space-y-10">
                @csrf
                <!-- Customer Selection -->
                <div class="space-y-4">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Pilih Pelanggan</label>
                    <select name="user_id" class="input-premium appearance-none" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Measurement Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Lingkar Dada (Chest)</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="chest" class="input-premium pr-12" placeholder="0.00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-bold text-gray-300">CM</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Lingkar Pinggang (Waist)</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="waist" class="input-premium pr-12" placeholder="0.00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-bold text-gray-300">CM</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Lingkar Pinggul (Hip)</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="hip" class="input-premium pr-12" placeholder="0.00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-bold text-gray-300">CM</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Lebar Bahu (Shoulder)</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="shoulder" class="input-premium pr-12" placeholder="0.00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-bold text-gray-300">CM</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Panjang Lengan</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="sleeve_length" class="input-premium pr-12" placeholder="0.00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-bold text-gray-300">CM</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Panjang Badan</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="body_length" class="input-premium pr-12" placeholder="0.00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-bold text-gray-300">CM</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Catatan Khusus (Opsional)</label>
                    <textarea name="notes" class="input-premium h-32 py-4 resize-none" placeholder="Contoh: Pelanggan lebih menyukai potongan yang agak longgar..."></textarea>
                </div>

                <div class="pt-10 flex items-center space-x-6 border-t border-gray-50">
                    <button type="submit" class="btn-premium px-12 py-4 shadow-xl shadow-soft-rose/20">
                        Simpan Data Ukuran
                    </button>
                    <a href="{{ route('admin.measurements.index') }}" class="font-bold text-gray-400 hover:text-dark-wool transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
