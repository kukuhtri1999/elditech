<template>
  <Head>
    <title>{{ isId ? 'Hubungi Kami — ELDITECH' : 'Contact Us — ELDITECH' }}</title>
    <meta name="description" :content="isId 
      ? 'Hubungi tim ELDITECH untuk kebutuhan pengembangan aplikasi Android dan software kustom Anda.' 
      : 'Contact the ELDITECH team for your Android app publishing and custom software engineering needs.'" />
  </Head>

  <PublicLayout>
    <!-- ── HEADER ── -->
    <section class="relative pt-32 pb-20 overflow-hidden">
      <div class="absolute inset-0 flex items-center justify-center pointer-events-none" style="z-index:0">
        <div class="w-[600px] h-[300px] rounded-full bg-accent/10 blur-[120px]" />
      </div>
      
      <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
        <div class="section-label" data-aos="fade-down">{{ isId ? 'Mari Berbicara' : 'Let\'s Talk' }}</div>
        <h1 class="text-4xl md:text-6xl font-black mt-4 leading-tight" style="font-family:'Sora',sans-serif" data-aos="fade-up">
          {{ isId ? 'Hubungi' : 'Contact' }}<br/>
          <span class="gradient-text">{{ isId ? 'Kami' : 'Us' }}</span>
        </h1>
        <p class="mt-6 text-gray-400 text-lg max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
          {{ isId 
            ? 'Punya visi besar? Mari kita wujudkan bersama. Tim engineer kami siap mendengarkan tantangan Anda.' 
            : 'Have a grand vision? Let\'s build it together. Our engineering team is ready to hear your challenges.' 
          }}
        </p>
      </div>
    </section>

    <!-- ── CONTACT GRID ── -->
    <section class="py-20 relative">
      <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
          
          <!-- Left: Info Cards -->
          <div class="space-y-8" data-aos="fade-right">
            <div>
              <h2 class="text-2xl font-bold mb-6" style="font-family:'Sora',sans-serif">
                {{ isId ? 'Informasi Kontak' : 'Contact Information' }}
              </h2>
              <div class="space-y-6">
                <!-- Email -->
                <div class="glass-card p-6 flex items-start gap-4 hover:border-accent/40 transition-all">
                  <div class="w-12 h-12 rounded-xl bg-accent/10 border border-accent/20 flex items-center justify-center text-xl">📧</div>
                  <div>
                    <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-1">Email</p>
                    <p class="text-white font-mono">admin@elditech.com</p>
                  </div>
                </div>
                <!-- Location -->
                <div class="glass-card p-6 flex items-start gap-4 hover:border-accent/40 transition-all">
                  <div class="w-12 h-12 rounded-xl bg-accent/10 border border-accent/20 flex items-center justify-center text-xl">📍</div>
                  <div>
                    <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-1">{{ isId ? 'Lokasi' : 'Location' }}</p>
                    <p class="text-white">Jakarta, Indonesia</p>
                  </div>
                </div>
                <!-- Support -->
                <div class="glass-card p-6 flex items-start gap-4 hover:border-accent/40 transition-all">
                  <div class="w-12 h-12 rounded-xl bg-accent/10 border border-accent/20 flex items-center justify-center text-xl">🛠️</div>
                  <div>
                    <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-1">{{ isId ? 'Dukungan' : 'Support' }}</p>
                    <p class="text-white">{{ isId ? 'Tersedia 24/7 untuk mitra kami' : 'Available 24/7 for our partners' }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Social/Note -->
            <div class="p-8 bg-accent/5 rounded-2xl border border-accent/10">
              <p class="text-sm text-gray-400 italic leading-relaxed">
                "{{ isId 
                  ? 'Kami menghargai setiap ide dan kerahasiaan data Anda. Semua komunikasi dilindungi oleh kebijakan privasi kami.' 
                  : 'We value every idea and the confidentiality of your data. All communications are protected by our privacy policy.' 
                }}"
              </p>
            </div>
          </div>

          <!-- Right: Form -->
          <div data-aos="fade-left">
            <div class="glass-card p-8 md:p-10 relative">
              <!-- Decorative corner -->
              <div class="absolute top-0 right-0 w-16 h-16 bg-accent/10 rounded-bl-3xl blur-2xl" />
              
              <h2 class="text-2xl font-bold mb-8" style="font-family:'Sora',sans-serif">
                {{ isId ? 'Kirim Pesan' : 'Send a Message' }}
              </h2>

              <form @submit.prevent="submitContact" class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                  <div>
                    <label class="block text-xs text-gray-500 uppercase tracking-widest mb-2 font-bold">{{ isId ? 'Nama Lengkap' : 'Full Name' }}</label>
                    <input v-model="form.name" type="text" required
                           class="w-full bg-[#0F0F0F] border border-white/10 rounded-xl px-5 py-3.5 
                                  text-white text-sm focus:outline-none focus:border-accent transition-colors"
                           :placeholder="isId ? 'Nama Anda' : 'Your Name'" />
                  </div>
                  <div>
                    <label class="block text-xs text-gray-500 uppercase tracking-widest mb-2 font-bold">Email</label>
                    <input v-model="form.email" type="email" required
                           class="w-full bg-[#0F0F0F] border border-white/10 rounded-xl px-5 py-3.5 
                                  text-white text-sm focus:outline-none focus:border-accent transition-colors"
                           placeholder="name@email.com" />
                  </div>
                </div>
                <div>
                  <label class="block text-xs text-gray-500 uppercase tracking-widest mb-2 font-bold">{{ isId ? 'Subjek' : 'Subject' }}</label>
                  <select v-model="form.subject"
                          class="w-full bg-[#0F0F0F] border border-white/10 rounded-xl px-5 py-3.5 
                                 text-white text-sm focus:outline-none focus:border-accent transition-colors">
                    <option value="General">{{ isId ? 'Pertanyaan Umum' : 'General Inquiry' }}</option>
                    <option value="Publishing">{{ isId ? 'Penerbitan Aplikasi' : 'App Publishing' }}</option>
                    <option value="Software">{{ isId ? 'Software Kustom' : 'Custom Software' }}</option>
                    <option value="Collaboration">{{ isId ? 'Kolaborasi' : 'Collaboration' }}</option>
                  </select>
                </div>
                <div>
                  <label class="block text-xs text-gray-500 uppercase tracking-widest mb-2 font-bold">{{ isId ? 'Pesan Anda' : 'Your Message' }}</label>
                  <textarea v-model="form.message" rows="5" required
                            class="w-full bg-[#0F0F0F] border border-white/10 rounded-xl px-5 py-3.5 
                                   text-white text-sm focus:outline-none focus:border-accent transition-colors resize-none"
                            :placeholder="isId ? 'Ceritakan tentang proyek Anda...' : 'Tell us about your project...'"></textarea>
                </div>
                
                <button type="submit" :disabled="form.processing"
                        class="btn-primary w-full py-4 text-center justify-center text-sm font-black uppercase tracking-widest">
                  {{ form.processing ? (isId ? 'Mengirim...' : 'Sending...') : (isId ? 'Kirim Pesan Sekarang' : 'Send Message Now') }}
                </button>

                <p v-if="form.errors.mail" class="text-red-400 text-center text-sm font-semibold">
                  {{ form.errors.mail }}
                </p>
                
                <p v-if="success" class="text-accent text-center text-sm font-bold animate-pulse">
                  {{ isId ? '✓ Pesan berhasil dikirim!' : '✓ Message sent successfully!' }}
                </p>
              </form>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ── MAP/LOCATION PLACEHOLDER ── -->
    <section class="py-20 bg-gray-950/30">
      <div class="max-w-7xl mx-auto px-6">
        <div class="glass-card h-96 overflow-hidden relative group">
          <!-- Mock map background -->
          <div class="absolute inset-0 bg-[#121212] flex items-center justify-center">
            <div class="text-center opacity-20 group-hover:opacity-30 transition-opacity">
              <div class="text-9xl mb-4">🌏</div>
              <p class="text-2xl font-black uppercase tracking-tighter">PT ELIAS DIGITAL TEKNOLOGI</p>
              <p class="text-sm font-mono mt-2">6.2088° S, 106.8456° E</p>
            </div>
          </div>
          <!-- Pin -->
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-4 h-4 bg-accent rounded-full animate-ping absolute" />
            <div class="w-3 h-3 bg-accent rounded-full border-4 border-[#0A0A0A]" />
          </div>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import AOS from 'aos';
import 'aos/dist/aos.css';

const page = usePage();
const locale = computed(() => page.props.locale || 'en');
const isId = computed(() => locale.value === 'id');

const form = useForm({
  name: '',
  email: '',
  subject: 'General',
  message: '',
  source: 'contact',
});

const success = ref(false);

function submitContact() {
  form.post(route('contact.submit', { locale: locale.value }), {
    preserveScroll: true,
    onSuccess: () => {
      success.value = true;
      form.reset('name', 'email', 'subject', 'message');
      form.subject = 'General';
      setTimeout(() => {
        success.value = false;
      }, 5000);
    },
  });
}

onMounted(() => {
  AOS.init({ duration: 800, once: true, offset: 50 });
});
</script>

<style scoped>
.glass-card {
  @apply backdrop-blur-xl bg-white/5 border border-white/10 rounded-2xl;
}
.glass-card-hover {
  @apply glass-card hover:border-accent/40 transition-all duration-300;
}
</style>
