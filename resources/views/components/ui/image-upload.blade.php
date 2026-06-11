@props([
    'name',
    'current' => null,
    'required' => false,
    'emptyText' => 'Belum ada file dipilih',
    'title' => 'Klik atau seret file gambar ke area ini',
    'help' => 'PNG, JPG, JPEG, WEBP, GIF, atau AVIF. Maksimal 5 MB.',
    'compact' => false,
])

<div
    x-data="{
        fileName: @js($emptyText),
        preview: @js($current),
        updatePreview(event) {
            const file = event.target.files[0] ?? null;

            if (!file) {
                this.fileName = @js($emptyText);
                return;
            }

            this.fileName = file.name;

            if (this.preview && this.preview.startsWith('blob:')) {
                URL.revokeObjectURL(this.preview);
            }

            this.preview = URL.createObjectURL(file);
        }
    }"
    class="space-y-3"
>
    <input
        type="file"
        name="{{ $name }}"
        x-ref="imageInput"
        class="sr-only"
        accept=".png,.jpg,.jpeg,.webp,.gif,.avif,image/png,image/jpeg,image/webp,image/gif,image/avif"
        @if($required) required @endif
        @change="updatePreview($event)"
    >

    <div
        class="rounded-[2rem] border-2 border-dashed border-gray-200 bg-gray-50/70 text-center cursor-pointer transition-all duration-300 hover:border-soft-rose/40 hover:bg-soft-rose/5"
        :class="preview ? 'border-soft-rose/30 bg-soft-rose/5' : ''"
        @click="$refs.imageInput.click()"
        @dragover.prevent
        @drop.prevent="$refs.imageInput.files = $event.dataTransfer.files; $refs.imageInput.dispatchEvent(new Event('change'))"
    >
        <div class="{{ $compact ? 'px-4 py-5' : 'px-6 py-8' }}">
            <template x-if="preview">
                <div class="mx-auto mb-4 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm {{ $compact ? 'h-24 max-w-44' : 'h-36 max-w-xs' }}">
                    <img :src="preview" class="w-full h-full object-cover" alt="Preview gambar">
                </div>
            </template>

            <template x-if="!preview">
                <div class="mx-auto rounded-2xl bg-white shadow-sm flex items-center justify-center text-soft-rose mb-4 {{ $compact ? 'w-10 h-10' : 'w-14 h-14' }}">
                    <i class="fas fa-cloud-arrow-up {{ $compact ? 'text-base' : 'text-xl' }}"></i>
                </div>
            </template>

            <p class="text-sm font-semibold text-dark-wool">{{ $title }}</p>
            <p class="text-[11px] text-gray-400 mt-2">{{ $help }}</p>
            <p class="mt-4 text-xs font-medium text-gray-500" x-text="fileName"></p>
        </div>
    </div>
</div>
