@extends('layouts.dashboard')

@section('role_name', auth()->user()->role === 'superadmin' ? 'Superadmin' : 'Admin')
@section('page_title', 'Content Management System (CMS)')

@section('dashboard_content')
<div class="h-[calc(100vh-140px)] flex flex-col lg:flex-row gap-8 overflow-hidden" x-data="cmsHandler()">
    
    <!-- Mobile Tab Switcher (Only visible below lg screens) -->
    <div class="lg:hidden flex bg-white/85 backdrop-blur-md p-1.5 rounded-2xl border border-gray-150 gap-1.5 flex-shrink-0 shadow-sm">
        <button @click="mobileTab = 'editor'" 
                class="flex-1 py-3 px-6 rounded-xl font-bold text-xs uppercase tracking-widest transition-all flex items-center justify-center gap-2"
                :class="mobileTab === 'editor' ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/15' : 'text-dark-wool hover:bg-gray-50'">
            <i class="fas fa-edit"></i>
            <span>Editor</span>
        </button>
        <button @click="mobileTab = 'preview'" 
                class="flex-1 py-3 px-6 rounded-xl font-bold text-xs uppercase tracking-widest transition-all flex items-center justify-center gap-2"
                :class="mobileTab === 'preview' ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/15' : 'text-dark-wool hover:bg-gray-50'">
            <i class="fas fa-eye"></i>
            <span>Preview</span>
        </button>
    </div>
    
    <!-- Left Panel: Form Editor & Sub-Menus (Scrollable) -->
    <div class="w-full lg:w-[48%] h-full overflow-hidden flex flex-col bg-white rounded-3xl border border-gray-100/80 shadow-sm"
         :class="{ 'hidden lg:flex': mobileTab !== 'editor', 'flex': mobileTab === 'editor' }">
        
        <!-- Header Controls -->
        <div class="flex items-center justify-between p-6 md:p-8 border-b border-gray-100 flex-shrink-0 bg-gray-50/50">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-soft-rose/10 rounded-2xl flex items-center justify-center text-soft-rose">
                    <i class="fas fa-sliders-h text-sm"></i>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-dark-wool uppercase tracking-widest">Pengaturan Konten</h3>
                    <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">Landing Page Editor</p>
                </div>
            </div>
            <button @click="saveChanges()" class="btn-premium btn-sm flex items-center gap-2 shadow-lg shadow-soft-rose/10" :disabled="saving">
                <i class="fas fa-save" x-show="!saving"></i>
                <i class="fas fa-circle-notch fa-spin" x-show="saving"></i>
                <span x-text="saving ? 'Menyimpan...' : 'Simpan & Preview'"></span>
            </button>
        </div>

        <!-- Customizer Two-Pane Layout -->
        <div class="flex-1 flex overflow-hidden">
            <!-- Left Pane: Sub-Menus navigation -->
            <div class="w-[35%] border-r border-gray-100 bg-gray-50/20 p-4 space-y-1.5 flex-shrink-0 overflow-y-auto">
                <span class="text-[8px] font-bold text-gray-300 uppercase tracking-widest px-3 block mb-2">Sub-Menus</span>
                
                <button @click="activeTab = 'brand'" 
                        class="w-full text-left px-4 py-3 rounded-2xl font-bold text-[10px] uppercase tracking-wider transition-all flex items-center gap-3"
                        :class="activeTab === 'brand' ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/15' : 'text-dark-wool hover:bg-gray-50'">
                    <i class="fas fa-fingerprint text-xs"></i>
                    <span>Brand & Sosial</span>
                </button>

                <button @click="activeTab = 'hero'" 
                        class="w-full text-left px-4 py-3 rounded-2xl font-bold text-[10px] uppercase tracking-wider transition-all flex items-center gap-3"
                        :class="activeTab === 'hero' ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/15' : 'text-dark-wool hover:bg-gray-50'">
                    <i class="fas fa-paper-plane text-xs"></i>
                    <span>Hero & Cerita</span>
                </button>

                <button @click="activeTab = 'sections'" 
                        class="w-full text-left px-4 py-3 rounded-2xl font-bold text-[10px] uppercase tracking-wider transition-all flex items-center gap-3"
                        :class="activeTab === 'sections' ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/15' : 'text-dark-wool hover:bg-gray-50'">
                    <i class="fas fa-toggle-on text-xs"></i>
                    <span>Bagian Halaman</span>
                </button>
            </div>

            <!-- Right Pane: Form input contents -->
            <div class="flex-1 overflow-y-auto p-6 md:p-8">
                <form id="cms-editor-form" action="{{ route(auth()->user()->role . '.cms.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8 pb-20">
                    @csrf

                    <!-- Sub-Menu 1: Brand & Sosial -->
                    <div x-show="activeTab === 'brand'" class="space-y-8 animate__animated animate__fadeIn animate__faster">
                        <!-- Identitas Brand -->
                        <div class="space-y-6">
                            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] border-l-2 border-soft-rose pl-3 mb-4">Identitas Brand</h4>
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Logo Website</label>
                                    <div class="flex items-center gap-4 bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                        @if($settings['site_logo'] ?? false)
                                            <div class="w-12 h-12 rounded-xl bg-white border border-gray-100 flex items-center justify-center p-2 overflow-hidden shadow-inner shrink-0">
                                                <img src="{{ asset($settings['site_logo']) }}" class="max-h-full max-w-full object-contain" alt="Logo">
                                            </div>
                                        @endif
                                        <input type="file" name="site_logo" class="input-premium py-2 text-xs w-full" accept="image/*">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Favicon (Ikon Tab)</label>
                                    <div class="flex items-center gap-4 bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                        @if($settings['site_favicon'] ?? false)
                                            <div class="w-10 h-10 rounded-xl bg-white border border-gray-100 flex items-center justify-center p-2 overflow-hidden shadow-inner shrink-0">
                                                <img src="{{ asset($settings['site_favicon']) }}" class="max-h-full max-w-full object-contain" alt="Favicon">
                                            </div>
                                        @endif
                                        <input type="file" name="site_favicon" class="input-premium py-2 text-xs w-full" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sosial Media & Kontak -->
                        <div class="space-y-6 border-t border-gray-50 pt-6">
                            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] border-l-2 border-soft-rose pl-3 mb-4">Sosial Media & Kontak</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Link Instagram</label>
                                    <input type="text" name="cms_instagram_url" class="input-premium py-3 text-xs" value="{{ $settings['cms_instagram_url'] ?? 'https://instagram.com' }}">
                                </div>

                                <div>
                                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Link WhatsApp</label>
                                    <input type="text" name="cms_whatsapp_url" class="input-premium py-3 text-xs" value="{{ $settings['cms_whatsapp_url'] ?? 'https://wa.me/628123456789' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sub-Menu 2: Hero & Cerita -->
                    <div x-show="activeTab === 'hero'" class="space-y-8 animate__animated animate__fadeIn animate__faster">
                        <!-- Hero Section -->
                        <div class="space-y-6">
                            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] border-l-2 border-soft-rose pl-3 mb-4">Hero / Banner Utama</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Judul Banner Utama (Hero Title)</label>
                                    <input type="text" name="cms_hero_title" class="input-premium py-3 text-xs" value="{{ $settings['cms_hero_title'] ?? 'Jahitan Kasih, Hangat & Personal' }}">
                                </div>

                                <div>
                                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Sub-judul Banner Utama (Hero Subtitle)</label>
                                    <textarea name="cms_hero_subtitle" rows="3" class="input-premium py-3 text-xs leading-relaxed">{{ $settings['cms_hero_subtitle'] ?? 'Setiap rajutan dikerjakan dengan tangan terampil yang penuh kasih, menghadirkan kehangatan sejati untuk keluarga Anda.' }}</textarea>
                                </div>

                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Teks Tombol Aksi (CTA Button)</label>
                                        <input type="text" name="cms_hero_cta" class="input-premium py-3 text-xs" value="{{ $settings['cms_hero_cta'] ?? 'Lihat Produk' }}">
                                    </div>

                                    <div>
                                        <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Gambar Banner Utama</label>
                                        <div class="flex items-center gap-4 bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                            @if($settings['cms_hero_image'] ?? false)
                                                <div class="w-12 h-12 rounded-xl bg-white border border-gray-100 flex items-center justify-center p-1 overflow-hidden shadow-inner shrink-0">
                                                    <img src="{{ asset($settings['cms_hero_image']) }}" class="w-full h-full object-cover rounded-lg" alt="Hero Banner">
                                                </div>
                                            @endif
                                            <input type="file" name="cms_hero_image" class="input-premium py-2 text-xs w-full" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Halaman Tentang Kami (About Us) -->
                        <div class="space-y-6 border-t border-gray-50 pt-6">
                            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] border-l-2 border-soft-rose pl-3 mb-4">Halaman Tentang Kami (About Us)</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Judul Cerita (About Title)</label>
                                    <input type="text" name="cms_about_title" class="input-premium py-3 text-xs" value="{{ $settings['cms_about_title'] ?? 'Cerita di Balik Jahitan' }}">
                                </div>

                                <div>
                                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Isi Cerita Lengkap (About Text)</label>
                                    <textarea name="cms_about_text" rows="4" class="input-premium py-3 text-xs leading-relaxed">{{ $settings['cms_about_text'] ?? 'Dimulai dari sebuah hobi merajut dari Nenek yang menyukai kehangatan benang wol untuk cucu tercintanya. Kini Jahitan Nenek hadir untuk membagikan rajutan berkualitas premium, dibuat manual dengan detail presisi tinggi, dan dikerjakan penuh kasih sayang.' }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2">Gambar Cerita</label>
                                    <div class="flex items-center gap-4 bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                        @if($settings['cms_about_image'] ?? false)
                                            <div class="w-12 h-12 rounded-xl bg-white border border-gray-100 flex items-center justify-center p-1 overflow-hidden shadow-inner shrink-0">
                                                <img src="{{ asset($settings['cms_about_image']) }}" class="w-full h-full object-cover rounded-lg" alt="About Image">
                                            </div>
                                        @endif
                                        <input type="file" name="cms_about_image" class="input-premium py-2 text-xs w-full" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sub-Menu 3: Bagian Halaman (Section Switches) -->
                    <div x-show="activeTab === 'sections'" class="space-y-6 animate__animated animate__fadeIn animate__faster">
                        <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] border-l-2 border-soft-rose pl-3 mb-4">Pengaturan Visibilitas Bagian Halaman</h4>
                        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest leading-relaxed mb-6">Aktifkan atau nonaktifkan bagian tertentu di halaman depan. Bagian yang dinonaktifkan tidak akan dirender pada halaman depan sama sekali.</p>
 
                        <div class="space-y-4">
                            <!-- Toggle Hero -->
                            <div class="flex justify-between items-center bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-soft-rose/10 flex items-center justify-center text-soft-rose text-xs shrink-0">
                                        <i class="fas fa-desktop"></i>
                                    </div>
                                    <div>
                                        <span class="block text-[10px] font-bold text-dark-wool uppercase tracking-wider">1. Hero / Banner Utama</span>
                                        <span class="block text-[8px] text-gray-400 uppercase tracking-widest mt-0.5">Bagian penyambutan awal</span>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="cms_section_hero_active" value="1" class="sr-only peer" {{ ($settings['cms_section_hero_active'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <div class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-soft-rose shadow-inner"></div>
                                </label>
                            </div>
 
                            <!-- Toggle Products -->
                            <div class="flex justify-between items-center bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-soft-rose/10 flex items-center justify-center text-soft-rose text-xs shrink-0">
                                        <i class="fas fa-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <span class="block text-[10px] font-bold text-dark-wool uppercase tracking-wider">2. Koleksi Produk Showcase</span>
                                        <span class="block text-[8px] text-gray-400 uppercase tracking-widest mt-0.5">Katalog produk utama</span>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="cms_section_products_active" value="1" class="sr-only peer" {{ ($settings['cms_section_products_active'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <div class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-soft-rose shadow-inner"></div>
                                </label>
                            </div>
 
                            <!-- Toggle Features -->
                            <div class="flex justify-between items-center bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-soft-rose/10 flex items-center justify-center text-soft-rose text-xs shrink-0">
                                        <i class="fas fa-magic"></i>
                                    </div>
                                    <div>
                                        <span class="block text-[10px] font-bold text-dark-wool uppercase tracking-wider">3. Keunggulan Kami (Features)</span>
                                        <span class="block text-[8px] text-gray-400 uppercase tracking-widest mt-0.5">Keunikan rajutan kita</span>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="cms_section_features_active" value="1" class="sr-only peer" {{ ($settings['cms_section_features_active'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <div class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-soft-rose shadow-inner"></div>
                                </label>
                            </div>
 
                            <!-- Toggle Recommendations -->
                            <div class="flex justify-between items-center bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-soft-rose/10 flex items-center justify-center text-soft-rose text-xs shrink-0">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <div>
                                        <span class="block text-[10px] font-bold text-dark-wool uppercase tracking-wider">4. Rekomendasi Pilihan</span>
                                        <span class="block text-[8px] text-gray-400 uppercase tracking-widest mt-0.5">Bagian produk favorit</span>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="cms_section_recommendations_active" value="1" class="sr-only peer" {{ ($settings['cms_section_recommendations_active'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <div class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-soft-rose shadow-inner"></div>
                                </label>
                            </div>
 
                            <!-- Toggle Blog -->
                            <div class="flex justify-between items-center bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-soft-rose/10 flex items-center justify-center text-soft-rose text-xs shrink-0">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                    <div>
                                        <span class="block text-[10px] font-bold text-dark-wool uppercase tracking-wider">5. Artikel & Blog Terbaru</span>
                                        <span class="block text-[8px] text-gray-400 uppercase tracking-widest mt-0.5">Pratinjau artikel Nenek</span>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="cms_section_blog_active" value="1" class="sr-only peer" {{ ($settings['cms_section_blog_active'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <div class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-soft-rose shadow-inner"></div>
                                </label>
                            </div>
 
                            <!-- Toggle Gallery -->
                            <div class="flex justify-between items-center bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-soft-rose/10 flex items-center justify-center text-soft-rose text-xs shrink-0">
                                        <i class="fas fa-camera"></i>
                                    </div>
                                    <div>
                                        <span class="block text-[10px] font-bold text-dark-wool uppercase tracking-wider">6. Galeri Mosaik Rajutan</span>
                                        <span class="block text-[8px] text-gray-400 uppercase tracking-widest mt-0.5">Foto portofolio paling bawah</span>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="cms_section_gallery_active" value="1" class="sr-only peer" {{ ($settings['cms_section_gallery_active'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <div class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-soft-rose shadow-inner"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Panel: Live Viewport Preview -->
    <div class="flex-col flex-1 h-full bg-gray-50 p-4 lg:p-8 items-center justify-center relative overflow-hidden bg-gray-50/50 rounded-3xl border border-gray-100"
         :class="{ 'hidden lg:flex': mobileTab !== 'preview', 'flex': mobileTab === 'preview' }">
        
        <!-- Live Preview Header / Toolbar -->
        <div class="w-full max-w-4xl flex items-center justify-between mb-4 bg-white border border-gray-100 p-3 rounded-2xl shadow-sm z-10">
            <div class="flex items-center space-x-3">
                <div class="flex space-x-1.5 pl-2 flex-shrink-0">
                    <span class="w-2.5 h-2.5 bg-red-400 rounded-full"></span>
                    <span class="w-2.5 h-2.5 bg-yellow-400 rounded-full"></span>
                    <span class="w-2.5 h-2.5 bg-green-400 rounded-full"></span>
                </div>
                <div class="bg-gray-50 border border-gray-100 text-[9px] text-gray-400 py-1.5 px-4 rounded-lg font-mono flex items-center gap-2 select-all overflow-hidden whitespace-nowrap">
                    <i class="fas fa-lock text-green-500 flex-shrink-0"></i> jahitannenek.com/
                </div>
            </div>
            
            <!-- Viewport Switchers -->
            <div class="flex bg-gray-100 p-1 rounded-xl gap-1 flex-shrink-0">
                <button @click="viewport = 'desktop'" class="w-8 h-8 rounded-lg flex items-center justify-center text-xs transition-all"
                        :class="viewport === 'desktop' ? 'bg-white text-soft-rose shadow-sm font-bold' : 'text-gray-400 hover:text-dark-wool'">
                    <i class="fas fa-desktop"></i>
                </button>
                <button @click="viewport = 'tablet'" class="w-8 h-8 rounded-lg flex items-center justify-center text-xs transition-all"
                        :class="viewport === 'tablet' ? 'bg-white text-soft-rose shadow-sm font-bold' : 'text-gray-400 hover:text-dark-wool'">
                    <i class="fas fa-tablet-alt"></i>
                </button>
                <button @click="viewport = 'mobile'" class="w-8 h-8 rounded-lg flex items-center justify-center text-xs transition-all"
                        :class="viewport === 'mobile' ? 'bg-white text-soft-rose shadow-sm font-bold' : 'text-gray-400 hover:text-dark-wool'">
                    <i class="fas fa-mobile-alt"></i>
                </button>
            </div>
        </div>

        <!-- Interactive Mock Device Wrapper -->
        <div class="w-full max-w-4xl flex-1 flex items-center justify-center overflow-hidden pb-4">
            <div class="shadow-2xl border-4 border-white bg-white rounded-[2.5rem] overflow-hidden transition-all duration-500 h-full flex flex-col max-w-full"
                 :class="{
                     'w-full max-w-4xl': viewport === 'desktop',
                     'w-[768px] max-h-[85%]': viewport === 'tablet',
                     'w-[375px] max-h-[90%]': viewport === 'mobile'
                 }">
                <div class="flex-1 w-full bg-white relative">
                    <iframe id="live-preview-iframe" src="{{ url('/?preview_as_guest=true') }}" class="absolute inset-0 w-full h-full border-none"></iframe>
                </div>
            </div>
        </div>

        <!-- Refresh Overlay Indicator -->
        <div x-show="refreshing" x-transition class="absolute inset-0 bg-white/70 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="text-center space-y-4">
                <div class="w-12 h-12 bg-soft-rose/10 rounded-full flex items-center justify-center text-soft-rose mx-auto">
                    <i class="fas fa-circle-notch fa-spin text-xl"></i>
                </div>
                <p class="text-[10px] font-bold text-dark-wool uppercase tracking-widest">Memperbarui Preview...</p>
            </div>
        </div>
    </div>
</div>

<script>
    function cmsHandler() {
        return {
            activeTab: 'brand',
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
                        iframe.src = iframe.src; // Trigger reload
                        
                        window.dispatchEvent(new CustomEvent('notify', {
                            detail: { message: data.message, type: 'success' }
                        }));
                    } else {
                        window.dispatchEvent(new CustomEvent('notify', {
                            detail: { message: 'Gagal memperbarui CMS.', type: 'error' }
                        }));
                    }
                } catch (e) {
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: { message: 'Terjadi kesalahan sistem saat menyimpan data.', type: 'error' }
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
