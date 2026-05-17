<section x-data="passwordFormHandler()">
    <form method="post" action="{{ route('password.update') }}" class="space-y-8">
        @csrf
        @method('put')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Current Password -->
            <div>
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 flex justify-between">
                    <span>Password Saat Ini</span>
                    <span class="text-red-500 font-bold text-[7px]">*Wajib</span>
                </label>
                <div class="relative">
                    <input type="password" 
                           name="current_password" 
                           x-model.debounce.500ms="currentPassword"
                           class="input-premium py-2 pr-10 text-xs focus:ring-soft-rose/20" 
                           :class="isCurrentCorrect === false ? 'border-red-500 focus:ring-red-500/20' : (isCurrentCorrect === true ? 'border-green-500 focus:ring-green-500/20' : '')"
                           autocomplete="current-password"
                           placeholder="••••••••">
                    
                    <!-- Loading / Success / Error Indicators inside input -->
                    <div class="absolute right-3 top-1/2 -translate-y-1/2 flex items-center">
                        <i x-show="checking" class="fas fa-circle-notch fa-spin text-xs text-soft-rose"></i>
                        <i x-show="isCurrentCorrect === true && !checking" class="fas fa-check-circle text-xs text-green-500 animate__animated animate__bounceIn"></i>
                        <i x-show="isCurrentCorrect === false && !checking" class="fas fa-times-circle text-xs text-red-500 animate__animated animate__shakeX"></i>
                    </div>
                </div>

                <!-- Live Validation Messages -->
                <div class="mt-1.5">
                    <span x-show="!currentPassword.length" class="text-[8px] text-gray-400 block font-medium">
                        Ketik sandi saat ini untuk membuka isian sandi baru.
                    </span>
                    <span x-show="isCurrentCorrect === false && !checking" class="text-[8px] text-red-500 block font-bold uppercase tracking-wider animate__animated animate__fadeIn">
                        <i class="fas fa-exclamation-circle mr-1"></i> Sandi saat ini salah!
                    </span>
                    <span x-show="isCurrentCorrect === true && !checking" class="text-[8px] text-green-600 block font-bold uppercase tracking-wider animate__animated animate__fadeIn">
                        <i class="fas fa-check-circle mr-1"></i> Sandi terverifikasi, kolom dibuka.
                    </span>
                </div>
            </div>

            <!-- New Password -->
            <div>
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Password Baru</label>
                <input type="password" 
                       name="password" 
                       x-model="newPassword"
                       :disabled="isCurrentCorrect !== true"
                       class="input-premium py-2 text-xs disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed focus:ring-soft-rose/20" 
                       autocomplete="new-password"
                       placeholder="Min. 8 karakter">
                
                <!-- Password Strength Display -->
                <div x-show="newPassword.length > 0" x-cloak class="mt-2.5 space-y-1.5 animate__animated animate__fadeIn">
                    <div class="flex justify-between items-center text-[8px] font-bold uppercase tracking-wider">
                        <span class="text-gray-400">Kekuatan Sandi:</span>
                        <span :class="strengthClass" x-text="strengthText"></span>
                    </div>
                    <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden flex gap-0.5">
                        <div class="h-full rounded-full transition-all duration-500" :class="bar1Class" :style="{ width: barWidth1 }"></div>
                        <div class="h-full rounded-full transition-all duration-500" :class="bar2Class" :style="{ width: barWidth2 }"></div>
                        <div class="h-full rounded-full transition-all duration-500" :class="bar3Class" :style="{ width: barWidth3 }"></div>
                    </div>
                </div>
            </div>

            <!-- Password Confirmation -->
            <div>
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Konfirmasi</label>
                <input type="password" 
                       name="password_confirmation" 
                       x-model="confirmPassword"
                       :disabled="isCurrentCorrect !== true"
                       class="input-premium py-2 text-xs disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed focus:ring-soft-rose/20" 
                       autocomplete="new-password"
                       placeholder="Ulangi sandi baru">
                
                <span x-show="newPassword && confirmPassword && newPassword !== confirmPassword" x-cloak class="text-[8px] text-red-500 mt-1 block font-bold uppercase tracking-wider">
                    <i class="fas fa-exclamation-circle mr-1"></i> Konfirmasi sandi tidak cocok
                </span>
            </div>
        </div>

        <div class="flex items-center space-x-6 pt-8 border-t border-gray-50 mt-8">
            <button type="submit" 
                    class="btn-premium btn-sm disabled:opacity-50 disabled:cursor-not-allowed"
                    :disabled="isCurrentCorrect !== true || !newPassword.length || newPassword !== confirmPassword || strengthScore < 2">
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-green-500 flex items-center animate__animated animate__fadeIn"
                >
                    <i class="fas fa-check-circle mr-2"></i> Tersimpan.
                </p>
            @endif
        </div>
    </form>
</section>

<script>
    function passwordFormHandler() {
        return {
            currentPassword: '',
            newPassword: '',
            confirmPassword: '',
            isCurrentCorrect: null,
            checking: false,
            
            init() {
                this.$watch('currentPassword', async (value) => {
                    if (!value.length) {
                        this.isCurrentCorrect = null;
                        return;
                    }
                    
                    this.checking = true;
                    try {
                        const res = await fetch('{{ route("profile.verify-password") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ password: value })
                        });
                        
                        const data = await res.json();
                        this.isCurrentCorrect = data.valid;
                    } catch (e) {
                        this.isCurrentCorrect = false;
                    } finally {
                        this.checking = false;
                    }
                });
            },
            
            get strengthScore() {
                let score = 0;
                let pass = this.newPassword;
                if (!pass) return 0;
                
                if (pass.length >= 8) score++;
                if (/[A-Z]/.test(pass) && /[a-z]/.test(pass)) score++;
                if (/[0-9]/.test(pass)) score++;
                if (/[^A-Za-z0-9]/.test(pass)) score++;
                
                return score;
            },
            
            get strengthText() {
                let score = this.strengthScore;
                if (score === 0) return '';
                if (score === 1) return 'Sangat Lemah';
                if (score === 2) return 'Sedang';
                if (score === 3) return 'Kuat';
                return 'Sangat Kuat';
            },
            
            get strengthClass() {
                let score = this.strengthScore;
                if (score <= 1) return 'text-red-500';
                if (score === 2) return 'text-amber-500';
                if (score === 3) return 'text-emerald-500';
                return 'text-green-600';
            },
            
            get barWidth1() {
                let score = this.strengthScore;
                return score >= 1 ? '100%' : '0%';
            },
            
            get barWidth2() {
                let score = this.strengthScore;
                return score >= 2 ? '100%' : '0%';
            },
            
            get barWidth3() {
                let score = this.strengthScore;
                return score >= 3 ? '100%' : '0%';
            },
            
            get bar1Class() {
                let score = this.strengthScore;
                if (score <= 1) return 'bg-red-500';
                if (score === 2) return 'bg-amber-500';
                return 'bg-emerald-500';
            },
            
            get bar2Class() {
                let score = this.strengthScore;
                if (score <= 1) return 'bg-gray-100';
                if (score === 2) return 'bg-amber-500';
                return 'bg-emerald-500';
            },
            
            get bar3Class() {
                let score = this.strengthScore;
                if (score < 3) return 'bg-gray-100';
                return 'bg-emerald-500';
            }
        }
    }
</script>
