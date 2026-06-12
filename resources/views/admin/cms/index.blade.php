@extends('layouts.dashboard')

@section('role_name', auth()->user()->role === 'superadmin' ? 'Superadmin' : 'Admin')
@section('page_title', 'Kelola Konten')

@section('dashboard_content')
    <div class="space-y-8" x-data="cmsHandler()">
        <!-- Live Viewport Preview -->
        <div
            class="flex flex-col w-full h-screen bg-gray-50 p-4 lg:p-8 items-center justify-center relative bg-gray-50/50 rounded-3xl border border-gray-100">

            <!-- Live Preview Header / Toolbar -->
            <div
                class="w-full max-w-4xl flex items-center justify-between mb-4 bg-white border border-gray-100 p-3 rounded-2xl shadow-sm z-10">
                <div class="flex items-center space-x-3">
                    <div class="flex space-x-1.5 pl-2 flex-shrink-0">
                        <span class="w-2.5 h-2.5 bg-red-400 rounded-full"></span>
                        <span class="w-2.5 h-2.5 bg-yellow-400 rounded-full"></span>
                        <span class="w-2.5 h-2.5 bg-green-400 rounded-full"></span>
                    </div>
                    <div
                        class="bg-gray-50 border border-gray-100 text-[9px] text-gray-400 py-1.5 px-4 rounded-lg font-mono flex items-center gap-2 select-all overflow-hidden whitespace-nowrap">
                        <i class="fas fa-lock text-green-500 flex-shrink-0"></i> jahitannenek.com/
                    </div>
                </div>

                <!-- Viewport Switchers -->
                <div class="flex bg-gray-100 p-1 rounded-xl gap-1 flex-shrink-0">
                    <button @click="viewport = 'desktop'"
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-xs transition-all"
                        :class="viewport === 'desktop' ? 'bg-white text-soft-rose shadow-sm font-bold' :
                            'text-gray-400 hover:text-dark-wool'">
                        <i class="fas fa-desktop"></i>
                    </button>
                    <button @click="viewport = 'tablet'"
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-xs transition-all"
                        :class="viewport === 'tablet' ? 'bg-white text-soft-rose shadow-sm font-bold' :
                            'text-gray-400 hover:text-dark-wool'">
                        <i class="fas fa-tablet-alt"></i>
                    </button>
                    <button @click="viewport = 'mobile'"
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-xs transition-all"
                        :class="viewport === 'mobile' ? 'bg-white text-soft-rose shadow-sm font-bold' :
                            'text-gray-400 hover:text-dark-wool'">
                        <i class="fas fa-mobile-alt"></i>
                    </button>
                </div>
            </div>

            <!-- Interactive Mock Device Wrapper -->
            <div class="w-full max-w-4xl flex-1 flex items-center justify-center overflow-hidden">
                <div class="shadow-2xl border-4 border-white bg-white rounded-[2.5rem]
    overflow-hidden transition-all duration-500 flex flex-col max-w-full"
                    :class="{
                        'w-full max-w-4xl h-full': viewport === 'desktop',
                        'w-[768px] h-full': viewport === 'tablet',
                        'w-[375px] h-full': viewport === 'mobile'
                    }">
                    <div class="flex-1 w-full min-h-0 bg-white relative">
                        <iframe id="live-preview-iframe" title="Pratinjau halaman depan"
                            src="{{ url('/?preview_as_guest=true') }}"
                            class="block w-full h-full min-h-[420px] border-none bg-white"></iframe>
                    </div>
                </div>
            </div>

            <!-- Refresh Overlay Indicator -->
            <div x-show="refreshing" x-transition
                class="absolute inset-0 bg-white/70 backdrop-blur-sm flex items-center justify-center z-50">
                <div class="text-center space-y-4">
                    <div
                        class="w-12 h-12 bg-soft-rose/10 rounded-full flex items-center justify-center text-soft-rose mx-auto">
                        <i class="fas fa-circle-notch fa-spin text-xl"></i>
                    </div>
                    <p class="text-[10px] font-bold text-dark-wool uppercase tracking-widest">Memperbarui pratinjau...</p>
                </div>
            </div>
        </div>

        <!-- Mobile Tab Switcher (Only visible below lg screens) -->
        <div
            class="hidden bg-white/85 backdrop-blur-md p-1.5 rounded-2xl border border-gray-150 gap-1.5 flex-shrink-0 shadow-sm">
            <button @click="mobileTab = 'editor'"
                class="flex-1 py-3 px-6 rounded-xl font-bold text-xs uppercase tracking-widest transition-all flex items-center justify-center gap-2"
                :class="mobileTab === 'editor' ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/15' :
                    'text-dark-wool hover:bg-gray-50'">
                <i class="fas fa-edit"></i>
                <span>Editor</span>
            </button>
            <button @click="mobileTab = 'preview'"
                class="flex-1 py-3 px-6 rounded-xl font-bold text-xs uppercase tracking-widest transition-all flex items-center justify-center gap-2"
                :class="mobileTab === 'preview' ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/15' :
                    'text-dark-wool hover:bg-gray-50'">
                <i class="fas fa-eye"></i>
                <span>Pratinjau</span>
            </button>
        </div>

        <!-- Form Editor & Sub-Menus (Stacked) -->
        <div
            class="w-full h-[calc(100dvh-180px)] min-h-[720px] overflow-hidden flex flex-col bg-white rounded-3xl border border-gray-100/80 shadow-sm">

            <!-- Header Controls -->
            <div class="flex items-center justify-between p-6 md:p-8 border-b border-gray-100 flex-shrink-0 bg-gray-50/50">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-soft-rose/10 rounded-2xl flex items-center justify-center text-soft-rose">
                        <i class="fas fa-sliders-h text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-dark-wool uppercase tracking-widest">Pengaturan Konten</h3>
                        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">Editor Halaman Depan
                        </p>
                    </div>
                </div>
                <button @click="saveChanges()"
                    class="btn-premium btn-sm flex items-center gap-2 shadow-lg shadow-soft-rose/10" :disabled="saving">
                    <i class="fas fa-save" x-show="!saving"></i>
                    <i class="fas fa-circle-notch fa-spin" x-show="saving"></i>
                    <span x-text="saving ? 'Menyimpan...' : 'Simpan & Pratinjau'"></span>
                </button>
            </div>

            <!-- Customizer Stacked Layout -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Sub-Menus navigation -->
                <div class="border-b border-gray-100 bg-gray-50/20 p-4 flex flex-wrap gap-2 flex-shrink-0 overflow-x-auto">
                    <span
                        class="w-full text-[8px] font-bold text-gray-300 uppercase tracking-widest px-3 block mb-1">Submenu</span>

                    <button @click="activeTab = 'hero'"
                        class="min-w-[160px] flex-1 text-left px-4 py-3 rounded-2xl font-bold text-[10px] uppercase tracking-wider transition-all flex items-center gap-3"
                        :class="activeTab === 'hero' ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/15' :
                            'text-dark-wool hover:bg-gray-50'">
                        <i class="fas fa-paper-plane text-xs"></i>
                        <span>Hero & Cerita</span>
                    </button>

                    <button @click="activeTab = 'sections'"
                        class="min-w-[160px] flex-1 text-left px-4 py-3 rounded-2xl font-bold text-[10px] uppercase tracking-wider transition-all flex items-center gap-3"
                        :class="activeTab === 'sections' ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/15' :
                            'text-dark-wool hover:bg-gray-50'">
                        <i class="fas fa-toggle-on text-xs"></i>
                        <span>Bagian Halaman</span>
                    </button>

                    <button @click="activeTab = 'gallery'"
                        class="min-w-[160px] flex-1 text-left px-4 py-3 rounded-2xl font-bold text-[10px] uppercase tracking-wider transition-all flex items-center gap-3"
                        :class="activeTab === 'gallery' ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/15' :
                            'text-dark-wool hover:bg-gray-50'">
                        <i class="fas fa-images text-xs"></i>
                        <span>Galeri</span>
                    </button>
                </div>

                <!-- Form input contents -->
                <div class="flex-1 overflow-y-auto p-6 md:p-8">
                    <form id="cms-editor-form" action="{{ route(auth()->user()->role . '.cms.update') }}" method="POST"
                        enctype="multipart/form-data" class="space-y-8 pb-20">
                        @csrf

                        <!-- Sub-Menu 1: Hero & Cerita -->
                        <div x-show="activeTab === 'hero'"
                            class="space-y-8 animate__animated animate__fadeIn animate__faster">
                            <!-- Hero Section -->
                            <div class="space-y-6">
                                <h4
                                    class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] border-l-2 border-soft-rose pl-3 mb-4">
                                    Hero / Banner Utama</h4>
                                <div class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Judul
                                                Banner Utama ID</label>
                                            <input type="text" name="cms_hero_title_id"
                                                class="input-premium py-3 text-xs"
                                                value="{{ $settings['cms_hero_title_id'] ?? ($settings['cms_hero_title'] ?? 'Jahitan Kasih, Hangat & Personal') }}"
                                                placeholder="Contoh: Jahitan Kasih, Hangat & Personal">
                                            <p class="mt-2 text-[10px] text-gray-400">Judul utama yang tampil di banner
                                                halaman depan bahasa Indonesia.</p>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Judul
                                                Banner Utama EN</label>
                                            <input type="text" name="cms_hero_title_en"
                                                class="input-premium py-3 text-xs"
                                                value="{{ $settings['cms_hero_title_en'] ?? '' }}"
                                                placeholder="Example: Stitched with Love">
                                            <p class="mt-2 text-[10px] text-gray-400">Judul utama untuk tampilan bahasa
                                                Inggris.</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Sub-judul
                                                Banner Utama ID</label>
                                            <textarea name="cms_hero_subtitle_id" rows="3" class="input-premium py-3 text-xs leading-relaxed"
                                                placeholder="Tuliskan sub-judul pendek untuk banner utama...">{{ $settings['cms_hero_subtitle_id'] ?? ($settings['cms_hero_subtitle'] ?? 'Setiap jahitan menyimpan kasih sayang. Setiap pakaian membawa cerita. Dan setiap cerita layak untuk dikenang.') }}</textarea>
                                            <p class="mt-2 text-[10px] text-gray-400">Ringkasan singkat untuk menjelaskan
                                                nilai utama brand.</p>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Sub-judul
                                                Banner Utama EN</label>
                                            <textarea name="cms_hero_subtitle_en" rows="3" class="input-premium py-3 text-xs leading-relaxed"
                                                placeholder="Write a short English hero subtitle...">{{ $settings['cms_hero_subtitle_en'] ?? '' }}</textarea>
                                            <p class="mt-2 text-[10px] text-gray-400">Ringkasan untuk tampilan bahasa
                                                Inggris.</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 gap-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label
                                                    class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Teks
                                                    Tombol Aksi ID</label>
                                                <input type="text" name="cms_hero_cta_id"
                                                    class="input-premium py-3 text-xs"
                                                    value="{{ $settings['cms_hero_cta_id'] ?? ($settings['cms_hero_cta'] ?? 'Lihat Produk') }}"
                                                    placeholder="Contoh: Lihat Produk">
                                                <p class="mt-2 text-[10px] text-gray-400">Teks pendek untuk tombol aksi di
                                                    banner.</p>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Teks
                                                    Tombol Aksi EN</label>
                                                <input type="text" name="cms_hero_cta_en"
                                                    class="input-premium py-3 text-xs"
                                                    value="{{ $settings['cms_hero_cta_en'] ?? '' }}"
                                                    placeholder="Example: Explore Collection">
                                                <p class="mt-2 text-[10px] text-gray-400">Teks tombol untuk tampilan bahasa
                                                    Inggris.</p>
                                            </div>
                                        </div>

                                        <div>
                                            <label
                                                class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Gambar
                                                Banner Utama</label>
                                            <div
                                                class="flex items-center gap-4 bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                                @if ($settings['cms_hero_image'] ?? false)
                                                    @php
                                                        $heroImage = $settings['cms_hero_image'];
                                                    @endphp
                                                    <div
                                                        class="w-12 h-12 rounded-xl bg-white border border-gray-100 flex items-center justify-center p-1 overflow-hidden shadow-inner shrink-0">
                                                        <img src="{{ str_starts_with($heroImage, 'http') ? $heroImage : asset($heroImage) }}"
                                                            class="w-full h-full object-cover rounded-lg"
                                                            alt="Hero Banner">
                                                    </div>
                                                @endif
                                                <div class="flex-1">
                                                    <x-ui.image-upload name="cms_hero_image"
                                                        title="Klik atau seret gambar banner baru"
                                                        empty-text="Ganti hanya jika ingin memperbarui banner" compact />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Halaman Tentang Kami (About Us) -->
                            <div class="space-y-6 border-t border-gray-50 pt-6">
                                <h4
                                    class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] border-l-2 border-soft-rose pl-3 mb-4">
                                    Halaman Tentang Kami (About Us)</h4>
                                <div class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Judul
                                                Cerita ID</label>
                                            <input type="text" name="cms_about_title_id"
                                                class="input-premium py-3 text-xs"
                                                value="{{ $settings['cms_about_title_id'] ?? ($settings['cms_about_title'] ?? 'Cerita di Balik Jahitan') }}"
                                                placeholder="Contoh: Cerita di Balik Jahitan">
                                            <p class="mt-2 text-[10px] text-gray-400">Judul bagian cerita brand pada
                                                halaman About.</p>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Judul
                                                Cerita EN</label>
                                            <input type="text" name="cms_about_title_en"
                                                class="input-premium py-3 text-xs"
                                                value="{{ $settings['cms_about_title_en'] ?? '' }}"
                                                placeholder="Example: Stories Behind the Needles">
                                            <p class="mt-2 text-[10px] text-gray-400">Judul cerita untuk tampilan bahasa
                                                Inggris.</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Isi
                                                Cerita Lengkap ID</label>
                                            <textarea name="cms_about_text_id" rows="4" class="input-premium py-3 text-xs leading-relaxed"
                                                placeholder="Tuliskan cerita singkat tentang Jahitan Nenek...">{{ $settings['cms_about_text_id'] ?? ($settings['cms_about_text'] ?? 'Jahitan Nenek bermula dari sebuah ruang tamu kecil di mana jemari tua namun lincah menjahit potongan-potongan bahan menjadi keindahan.') }}</textarea>
                                            <p class="mt-2 text-[10px] text-gray-400">Teks ini membantu pelanggan mengenal
                                                cerita di balik brand.</p>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Isi
                                                Cerita Lengkap EN</label>
                                            <textarea name="cms_about_text_en" rows="4" class="input-premium py-3 text-xs leading-relaxed"
                                                placeholder="Write the English brand story...">{{ $settings['cms_about_text_en'] ?? '' }}</textarea>
                                            <p class="mt-2 text-[10px] text-gray-400">Teks cerita untuk tampilan bahasa
                                                Inggris.</p>
                                        </div>
                                    </div>

                                    <div>
                                        <label
                                            class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Gambar
                                            Cerita</label>
                                        <div
                                            class="flex items-center gap-4 bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                            @if ($settings['cms_about_image'] ?? false)
                                                @php
                                                    $aboutImage = $settings['cms_about_image'];
                                                @endphp
                                                <div
                                                    class="w-12 h-12 rounded-xl bg-white border border-gray-100 flex items-center justify-center p-1 overflow-hidden shadow-inner shrink-0">
                                                    <img src="{{ str_starts_with($aboutImage, 'http') ? $aboutImage : asset($aboutImage) }}"
                                                        class="w-full h-full object-cover rounded-lg" alt="About Image">
                                                </div>
                                            @endif
                                            <div class="flex-1">
                                                <x-ui.image-upload name="cms_about_image"
                                                    title="Klik atau seret gambar cerita baru"
                                                    empty-text="Ganti hanya jika ingin memperbarui gambar" compact />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sub-Menu 3: Bagian Halaman (Section Switches) -->
                        <div x-show="activeTab === 'sections'"
                            class="space-y-6 animate__animated animate__fadeIn animate__faster">
                            <h4
                                class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] border-l-2 border-soft-rose pl-3 mb-4">
                                Pengaturan Visibilitas Bagian Halaman</h4>
                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest leading-relaxed mb-6">
                                Aktifkan atau nonaktifkan bagian tertentu di halaman depan. Bagian yang dinonaktifkan tidak
                                akan dirender pada halaman depan sama sekali.</p>

                            <div class="space-y-4">
                                <!-- Toggle Hero -->
                                <div
                                    class="flex justify-between items-center bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-xl bg-soft-rose/10 flex items-center justify-center text-soft-rose text-xs shrink-0">
                                            <i class="fas fa-desktop"></i>
                                        </div>
                                        <div>
                                            <span
                                                class="block text-[10px] font-bold text-dark-wool uppercase tracking-wider">1.
                                                Hero / Banner Utama</span>
                                            <span
                                                class="block text-[8px] text-gray-400 uppercase tracking-widest mt-0.5">Bagian
                                                penyambutan awal</span>
                                        </div>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="cms_section_hero_active" value="1"
                                            class="sr-only peer"
                                            {{ ($settings['cms_section_hero_active'] ?? '1') == '1' ? 'checked' : '' }}>
                                        <div
                                            class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-soft-rose shadow-inner">
                                        </div>
                                    </label>
                                </div>

                                <!-- Toggle Products -->
                                <div
                                    class="flex justify-between items-center bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-xl bg-soft-rose/10 flex items-center justify-center text-soft-rose text-xs shrink-0">
                                            <i class="fas fa-shopping-bag"></i>
                                        </div>
                                        <div>
                                            <span
                                                class="block text-[10px] font-bold text-dark-wool uppercase tracking-wider">2.
                                                Koleksi Produk Showcase</span>
                                            <span
                                                class="block text-[8px] text-gray-400 uppercase tracking-widest mt-0.5">Katalog
                                                produk utama</span>
                                        </div>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="cms_section_products_active" value="1"
                                            class="sr-only peer"
                                            {{ ($settings['cms_section_products_active'] ?? '1') == '1' ? 'checked' : '' }}>
                                        <div
                                            class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-soft-rose shadow-inner">
                                        </div>
                                    </label>
                                </div>

                                <!-- Toggle Features -->
                                <div
                                    class="flex justify-between items-center bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-xl bg-soft-rose/10 flex items-center justify-center text-soft-rose text-xs shrink-0">
                                            <i class="fas fa-magic"></i>
                                        </div>
                                        <div>
                                            <span
                                                class="block text-[10px] font-bold text-dark-wool uppercase tracking-wider">3.
                                                Keunggulan Kami (Features)</span>
                                            <span
                                                class="block text-[8px] text-gray-400 uppercase tracking-widest mt-0.5">Keunikan
                                                jahitan kita</span>
                                        </div>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="cms_section_features_active" value="1"
                                            class="sr-only peer"
                                            {{ ($settings['cms_section_features_active'] ?? '1') == '1' ? 'checked' : '' }}>
                                        <div
                                            class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-soft-rose shadow-inner">
                                        </div>
                                    </label>
                                </div>

                                <!-- Toggle Recommendations -->
                                <div
                                    class="flex justify-between items-center bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-xl bg-soft-rose/10 flex items-center justify-center text-soft-rose text-xs shrink-0">
                                            <i class="fas fa-heart"></i>
                                        </div>
                                        <div>
                                            <span
                                                class="block text-[10px] font-bold text-dark-wool uppercase tracking-wider">4.
                                                Rekomendasi Pilihan</span>
                                            <span
                                                class="block text-[8px] text-gray-400 uppercase tracking-widest mt-0.5">Bagian
                                                produk favorit</span>
                                        </div>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="cms_section_recommendations_active" value="1"
                                            class="sr-only peer"
                                            {{ ($settings['cms_section_recommendations_active'] ?? '1') == '1' ? 'checked' : '' }}>
                                        <div
                                            class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-soft-rose shadow-inner">
                                        </div>
                                    </label>
                                </div>

                                <!-- Toggle Blog -->
                                <div
                                    class="flex justify-between items-center bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-xl bg-soft-rose/10 flex items-center justify-center text-soft-rose text-xs shrink-0">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                        <div>
                                            <span
                                                class="block text-[10px] font-bold text-dark-wool uppercase tracking-wider">5.
                                                Artikel & Blog Terbaru</span>
                                            <span
                                                class="block text-[8px] text-gray-400 uppercase tracking-widest mt-0.5">Pratinjau
                                                artikel Nenek</span>
                                        </div>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="cms_section_blog_active" value="1"
                                            class="sr-only peer"
                                            {{ ($settings['cms_section_blog_active'] ?? '1') == '1' ? 'checked' : '' }}>
                                        <div
                                            class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-soft-rose shadow-inner">
                                        </div>
                                    </label>
                                </div>

                                <!-- Toggle Gallery -->
                                <div
                                    class="flex justify-between items-center bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-xl bg-soft-rose/10 flex items-center justify-center text-soft-rose text-xs shrink-0">
                                            <i class="fas fa-camera"></i>
                                        </div>
                                        <div>
                                            <span
                                                class="block text-[10px] font-bold text-dark-wool uppercase tracking-wider">6.
                                                Galeri Mosaik Jahitan</span>
                                            <span
                                                class="block text-[8px] text-gray-400 uppercase tracking-widest mt-0.5">Foto
                                                portofolio paling bawah</span>
                                        </div>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="cms_section_gallery_active" value="1"
                                            class="sr-only peer"
                                            {{ ($settings['cms_section_gallery_active'] ?? '1') == '1' ? 'checked' : '' }}>
                                        <div
                                            class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-soft-rose shadow-inner">
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Sub-Menu 4: Gallery -->
                        <div x-show="activeTab === 'gallery'"
                            class="space-y-8 animate__animated animate__fadeIn animate__faster">
                            <div class="space-y-6">
                                <h4
                                    class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] border-l-2 border-soft-rose pl-3 mb-4">
                                    Teks Galeri</h4>
                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <label
                                            class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Label
                                            Galeri ID</label>
                                        <input type="text" name="cms_gallery_title_id"
                                            class="input-premium py-3 text-xs"
                                            value="{{ $settings['cms_gallery_title_id'] ?? 'Galeri Karya' }}">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Label
                                            Galeri EN</label>
                                        <input type="text" name="cms_gallery_title_en"
                                            class="input-premium py-3 text-xs"
                                            value="{{ $settings['cms_gallery_title_en'] ?? 'Work Gallery' }}">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Judul
                                            Galeri ID</label>
                                        <input type="text" name="cms_gallery_subtitle_id"
                                            class="input-premium py-3 text-xs"
                                            value="{{ $settings['cms_gallery_subtitle_id'] ?? 'Mahakarya Jahitan' }}">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Judul
                                            Galeri EN</label>
                                        <input type="text" name="cms_gallery_subtitle_en"
                                            class="input-premium py-3 text-xs"
                                            value="{{ $settings['cms_gallery_subtitle_en'] ?? 'Stitched Masterpiece' }}">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Deskripsi
                                            Galeri ID</label>
                                        <textarea name="cms_gallery_desc_id" rows="3" class="input-premium py-3 text-xs">{{ $settings['cms_gallery_desc_id'] ?? 'Setiap jahitan menceritakan dedikasi, kehangatan, dan kesabaran.' }}</textarea>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Deskripsi
                                            Galeri EN</label>
                                        <textarea name="cms_gallery_desc_en" rows="3" class="input-premium py-3 text-xs">{{ $settings['cms_gallery_desc_en'] ?? 'Every stitch tells a story of dedication, warmth, and patience.' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-6 border-t border-gray-50 pt-6">
                                <h4
                                    class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] border-l-2 border-soft-rose pl-3 mb-4">
                                    Foto & Judul Item</h4>
                                <div class="space-y-5">
                                    @for ($i = 1; $i <= 4; $i++)
                                        <div class="rounded-2xl bg-gray-50/50 border border-gray-100 p-4 space-y-4">
                                            <div class="flex items-center gap-4">
                                                @if ($settings['cms_gallery_img' . $i] ?? false)
                                                    @php
                                                        $galleryImage = $settings['cms_gallery_img' . $i];
                                                    @endphp
                                                    <div
                                                        class="w-14 h-14 rounded-xl bg-white border border-gray-100 flex items-center justify-center p-1 overflow-hidden shadow-inner shrink-0">
                                                        <img src="{{ str_starts_with($galleryImage, 'http') ? $galleryImage : asset($galleryImage) }}"
                                                            class="w-full h-full object-cover rounded-lg"
                                                            alt="Gallery {{ $i }}">
                                                    </div>
                                                @endif
                                                <div class="flex-1">
                                                    <x-ui.image-upload name="cms_gallery_img{{ $i }}"
                                                        title="Upload gambar galeri {{ $i }}"
                                                        empty-text="Ganti hanya jika ingin memperbarui gambar" compact />
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label
                                                        class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Judul
                                                        Item {{ $i }} ID</label>
                                                    <input type="text" name="cms_gallery_title{{ $i }}_id"
                                                        class="input-premium py-3 text-xs"
                                                        value="{{ $settings['cms_gallery_title' . $i . '_id'] ?? '' }}">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Judul
                                                        Item {{ $i }} EN</label>
                                                    <input type="text" name="cms_gallery_title{{ $i }}_en"
                                                        class="input-premium py-3 text-xs"
                                                        value="{{ $settings['cms_gallery_title' . $i . '_en'] ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function cmsHandler() {
            return {
                activeTab: 'hero',
                viewport: 'desktop',
                mobileTab: 'editor',
                saving: false,
                refreshing: false,
                async saveChanges() {
                    this.saving = true;
                    this.refreshing = true;

                    try {
                        const form = document.getElementById('cms-editor-form');
                        const formData = new FormData(form);

                        const res = await fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        const data = await res.json();

                        if (data.success) {
                            // Reload the preview iframe
                            const iframe = document.getElementById('live-preview-iframe');
                            iframe.src = '{{ url('/?preview_as_guest=true') }}&preview_updated=' + Date.now();

                            window.dispatchEvent(new CustomEvent('notify', {
                                detail: {
                                    message: data.message,
                                    type: 'success'
                                }
                            }));
                        } else {
                            window.dispatchEvent(new CustomEvent('notify', {
                                detail: {
                                    message: 'Gagal memperbarui CMS.',
                                    type: 'error'
                                }
                            }));
                        }
                    } catch (e) {
                        window.dispatchEvent(new CustomEvent('notify', {
                            detail: {
                                message: 'Terjadi kesalahan sistem saat menyimpan data.',
                                type: 'error'
                            }
                        }));
                    } finally {
                        this.saving = false;
                        setTimeout(() => {
                            this.refreshing = false;
                        }, 500); // Smooth fade transition
                    }
                }
            }
        }
    </script>
@endsection
