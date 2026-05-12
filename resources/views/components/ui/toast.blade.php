<div x-data="{ 
    messages: [],
    remove(id) {
        this.messages = this.messages.filter(m => m.id !== id);
    }
}" 
@notify.window="
    let id = Date.now();
    messages.push({
        id: id,
        type: $event.detail.type || 'success',
        text: $event.detail.message
    });
    setTimeout(() => remove(id), 5000);
"
class="fixed bottom-10 right-10 z-[200] flex flex-col space-y-4 max-w-sm w-full pointer-events-none">
    <template x-for="msg in messages" :key="msg.id">
        <div x-show="true" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="pointer-events-auto relative overflow-hidden glass-effect p-6 rounded-3xl border shadow-2xl flex items-center space-x-4 animate__animated animate__fadeInRight animate__faster"
             :class="{
                 'border-green-500/30': msg.type === 'success',
                 'border-red-500/30': msg.type === 'error',
                 'border-blue-500/30': msg.type === 'info'
             }">
            
            <!-- Icon -->
            <div class="w-10 h-10 rounded-2xl flex items-center justify-center shrink-0 shadow-inner"
                 :class="{
                     'bg-green-500 text-white': msg.type === 'success',
                     'bg-red-500 text-white': msg.type === 'error',
                     'bg-blue-500 text-white': msg.type === 'info'
                 }">
                <i class="fas" :class="{
                    'fa-check': msg.type === 'success',
                    'fa-exclamation-circle': msg.type === 'error',
                    'fa-info-circle': msg.type === 'info'
                }"></i>
            </div>

            <!-- Content -->
            <div class="flex-1">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-0.5" x-text="msg.type"></p>
                <p class="text-sm font-bold text-dark-wool leading-tight" x-text="msg.text"></p>
            </div>

            <!-- Close -->
            <button @click="remove(msg.id)" class="text-gray-300 hover:text-dark-wool transition-colors">
                <i class="fas fa-times"></i>
            </button>

            <!-- Progress Bar -->
            <div class="absolute bottom-0 left-0 h-1 bg-current opacity-10 transition-all duration-[5000ms] w-full"
                 :class="{
                     'text-green-500': msg.type === 'success',
                     'text-red-500': msg.type === 'error',
                     'text-blue-500': msg.type === 'info'
                 }"></div>
        </div>
    </template>
</div>
