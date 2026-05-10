<template>
  <Head>
    <title>{{ t.hero.title_seo || 'PT ELIAS DIGITAL TEKNOLOGI | Mobile App Publisher & Software House' }}</title>
    <meta name="description" :content="t.hero.meta" />
    <meta name="keywords" :content="t.hero.keywords || 'android app publisher, software house, custom software, mobile app development, elditech, elias digital teknologi'" />
    <meta property="og:title" :content="t.hero.title_seo || 'PT ELIAS DIGITAL TEKNOLOGI | Mobile App Publisher & Software House'" />
    <meta property="og:description" :content="t.hero.meta" />
    <meta property="og:image" content="/img/logo-white.png" />
    <meta property="og:type" content="website" />
  </Head>
  <PublicLayout>

    <!-- ═══════════════════════════════════════════
         SECTION 1 — VISIONARY HERO (Particle Network)
    ══════════════════════════════════════════════ -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-[#0A0A0A]">
      <!-- Particle canvas -->
      <canvas ref="particleCanvas"
              class="absolute inset-0 w-full h-full"
              style="z-index:0; will-change:transform; transform:translateZ(0);" />

      <!-- Glow blob -->
      <div class="absolute inset-0 flex items-center justify-center pointer-events-none" style="z-index:0">
        <div class="w-[700px] h-[700px] rounded-full bg-accent/10 blur-[130px]" />
      </div>

      <!-- Content -->
      <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
        <div class="section-label" data-aos="fade-down" data-aos-delay="100">
          <span class="w-2 h-2 rounded-full bg-accent animate-pulse inline-block" />
          {{ t.hero.badge }}
        </div>

        <h1 class="mt-4 text-5xl md:text-7xl font-black leading-tight tracking-tight"
            style="font-family:'Sora',sans-serif"
            data-aos="fade-up" data-aos-delay="200">
          {{ t.hero.h1a }}<br/>
          <span class="gradient-text">{{ t.hero.h1b }}</span>
        </h1>

        <p class="mt-6 text-lg text-gray-400 max-w-2xl mx-auto leading-relaxed"
           data-aos="fade-up" data-aos-delay="350">
          {{ t.hero.sub }}
        </p>

        <div class="mt-10 flex flex-wrap justify-center gap-4"
             data-aos="fade-up" data-aos-delay="450">
          <Link :href="route('services', { locale })" class="btn-primary">
            {{ t.hero.cta1 }}
          </Link>
          <Link :href="route('portfolio', { locale })" class="btn-secondary">
            {{ t.hero.cta2 }}
          </Link>
        </div>

        <!-- scroll indicator -->
        <div class="mt-20 flex flex-col items-center gap-2 opacity-40" data-aos="fade-up" data-aos-delay="600">
          <span class="text-xs text-gray-500 tracking-widest uppercase">Scroll</span>
          <div class="w-px h-10 bg-gradient-to-b from-gray-500 to-transparent" />
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         SECTION 2 — CORE EXPERTISE (Circuit Cards)
    ══════════════════════════════════════════════ -->
    <section class="py-32 relative">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
          <div class="section-label" data-aos="fade-down">{{ t.services.badge }}</div>
          <h2 class="text-4xl md:text-5xl font-black mt-2" style="font-family:'Sora',sans-serif"
              data-aos="fade-up" data-aos-delay="100">
            {{ t.services.h2 }}
          </h2>
          <p class="mt-4 text-gray-400 max-w-2xl mx-auto"
             data-aos="fade-up" data-aos-delay="200">
            {{ t.services.sub }}
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div v-for="(card, i) in t.services.cards" :key="i"
               class="circuit-card glass-card-hover p-8 group"
               :data-aos="i % 2 === 0 ? 'fade-right' : 'fade-left'"
               :data-aos-delay="i * 100">
            <div class="text-4xl mb-4">{{ card.icon }}</div>
            <h3 class="text-2xl font-bold text-white mb-3" style="font-family:'Sora',sans-serif">
              {{ card.title }}
            </h3>
            <p class="text-gray-400 leading-relaxed text-sm">{{ card.desc }}</p>
            <ul class="mt-4 space-y-2">
              <li v-for="f in card.features" :key="f"
                  class="flex items-center gap-2 text-sm text-gray-300">
                <span class="w-1.5 h-1.5 rounded-full bg-accent flex-shrink-0" />
                {{ f }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         SECTION 3 — TECH PULSE STATS (Matrix Rain)
    ══════════════════════════════════════════════ -->
    <section class="py-32 relative matrix-bg bg-gray-950/50">
      <canvas ref="matrixCanvas" class="matrix-canvas" />

      <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
          <div class="section-label" data-aos="fade-down">{{ t.stats.badge }}</div>
          <h2 class="text-4xl md:text-5xl font-black mt-2" style="font-family:'Sora',sans-serif"
              data-aos="fade-up" data-aos-delay="100">
            {{ t.stats.h2 }}
          </h2>
          <p class="mt-4 text-gray-400 max-w-xl mx-auto"
             data-aos="fade-up" data-aos-delay="200">
            {{ t.stats.sub }}
          </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
          <div v-for="(stat, i) in stats" :key="i"
               class="glass-card p-6 text-center group hover:border-accent/40 transition-all"
               data-aos="zoom-in" :data-aos-delay="i * 80">
            <div class="text-4xl font-black stat-number gradient-text counter-value"
                 :ref="el => statEls[i] = el"
                 :data-target="stat.value" data-suffix=" stat.suffix">
              {{ stat.display }}
            </div>
            <div class="text-xs text-gray-500 uppercase tracking-widest mt-2 font-semibold">
              {{ stat.label[locale] }}
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         SECTION 4 — FEATURED PORTFOLIO (Floating Orbs)
    ══════════════════════════════════════════════ -->
    <section class="py-32 relative overflow-hidden">
      <!-- Floating orbs -->
      <div class="absolute top-0 left-1/4 orb w-96 h-96 bg-accent/15" style="--dur:9s;--delay:0s;" />
      <div class="absolute bottom-0 right-1/4 orb w-64 h-64 bg-green-500/10" style="--dur:12s;--delay:2s;" />

      <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
          <div class="section-label" data-aos="fade-down">{{ t.portfolio.badge }}</div>
          <h2 class="text-4xl md:text-5xl font-black mt-2" style="font-family:'Sora',sans-serif"
              data-aos="fade-up" data-aos-delay="100">
            {{ t.portfolio.h2 }}
          </h2>
          <p class="mt-4 text-gray-400 max-w-2xl mx-auto"
             data-aos="fade-up" data-aos-delay="200">
            {{ t.portfolio.sub }}
          </p>
        </div>

        <!-- Project cards -->
        <div v-if="posts.length > 0" class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <article v-for="(post, i) in posts" :key="post.id"
                   class="glass-card-hover overflow-hidden group"
                   data-aos="fade-up" :data-aos-delay="i * 100">
            <div class="h-48 bg-gray-900 relative overflow-hidden"
                 :style="post.featured_image ? `background:url(${post.featured_image}) center/cover` : ''">
              <div v-if="!post.featured_image"
                   class="absolute inset-0 flex items-center justify-center">
                <div class="w-16 h-16 rounded-2xl bg-accent/10 border border-accent/20
                             flex items-center justify-center text-2xl">📱</div>
              </div>
              <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent" />
            </div>
            <div class="p-5">
              <h3 class="font-bold text-white mb-2">
                {{ post.title?.[$page.props.locale] || post.title?.en || '' }}
              </h3>
              <p class="text-xs text-gray-400 leading-relaxed line-clamp-2">
                {{ post.excerpt?.[$page.props.locale] || post.excerpt?.en || '' }}
              </p>
              <Link :href="route('portfolio.show', { locale: $page.props.locale, slug: post.slug?.[$page.props.locale] || post.slug?.en })"
                    class="mt-3 inline-flex items-center gap-1 text-accent text-xs font-semibold hover:underline">
                {{ $page.props.locale === 'id' ? 'Lihat Proyek' : 'View Project' }} →
              </Link>
            </div>
          </article>
        </div>

        <!-- Empty state with mock cards -->
        <div v-else class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div v-for="(mock, i) in t.portfolio.mocks" :key="i"
               class="glass-card-hover overflow-hidden"
               data-aos="fade-up" :data-aos-delay="i * 100">
            <div class="h-48 bg-gray-900 flex items-center justify-center">
              <div class="text-4xl">{{ mock.icon }}</div>
            </div>
            <div class="p-5">
              <h3 class="font-bold text-white mb-2">{{ mock.title }}</h3>
              <p class="text-xs text-gray-400 leading-relaxed">{{ mock.desc }}</p>
            </div>
          </div>
        </div>

        <div class="text-center mt-10" data-aos="fade-up">
          <Link :href="route('portfolio', { locale })" class="btn-secondary text-sm px-6 py-3">
            {{ locale === 'id' ? 'Lihat Semua Proyek' : 'View All Projects' }} →
          </Link>
        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         SECTION 4.5 — MEET THE CEO (Glitch Hero)
    ══════════════════════════════════════════════ -->
    <section class="py-32 relative overflow-hidden">
      <!-- Cyber background -->
      <div class="absolute inset-0 bg-gray-950/40 pointer-events-none" />
      <div class="absolute top-1/2 left-0 w-full h-px bg-gradient-to-r from-transparent via-accent/20 to-transparent" />
      
      <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
          
          <!-- Image Side -->
          <div class="relative" data-aos="fade-right">
            <!-- Glow background -->
            <div class="absolute -inset-4 bg-accent/20 blur-3xl rounded-full opacity-50" />
            
            <div class="relative aspect-[4/5] rounded-2xl overflow-hidden border border-white/10 group">
              <img src="/img/foto-kukuh.jpeg" :alt="t.ceo.name" 
                   class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
              
              <!-- Glass Overlay -->
              <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent opacity-60" />
              
              <!-- Floating info tag -->
              <div class="absolute bottom-6 left-6 right-6 p-4 backdrop-blur-xl bg-white/5 border border-white/10 rounded-xl">
                 <p class="text-accent font-mono text-xs tracking-widest uppercase mb-1">{{ t.ceo.role }}</p>
                 <h3 class="text-2xl font-black" style="font-family:'Sora',sans-serif">{{ t.ceo.name }}</h3>
              </div>
            </div>
            
            <!-- Floating Tech Tags -->
            <div class="absolute -top-6 -right-6 glass-card px-4 py-2 text-xs font-mono text-accent animate-bounce" style="animation-duration: 3s">
              SYSTEM_ARCHITECT_v1.0
            </div>
          </div>

          <!-- Content Side -->
          <div data-aos="fade-left">
            <div class="section-label mb-6">{{ t.ceo.badge }}</div>
            <h2 class="text-4xl md:text-5xl font-black mb-8 leading-tight" style="font-family:'Sora',sans-serif">
              {{ t.ceo.h2 }}
            </h2>
            
            <div class="space-y-6">
              <p class="text-gray-400 text-lg leading-relaxed italic">
                "{{ t.ceo.bio }}"
              </p>
              
              <!-- Detailed Stats -->
              <div class="grid grid-cols-3 gap-4 pt-8 border-t border-white/5">
                <div v-for="s in t.ceo.stats" :key="s.label">
                  <div class="text-2xl font-black text-white mb-1">{{ s.value }}</div>
                  <div class="text-[10px] text-gray-500 uppercase tracking-widest">{{ s.label }}</div>
                </div>
              </div>

              <!-- Tech stacks icons/labels -->
              <div class="flex flex-wrap gap-2 mt-8">
                <span v-for="tech in ['Fullstack', 'Mobile', 'UI/UX', 'Cloud']" :key="tech"
                      class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-[10px] text-gray-400 uppercase tracking-widest">
                  {{ tech }}
                </span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ═══════════════════════════════════════════
         SECTION 5 — STRATEGIC CTA (Laser Scan)
    ══════════════════════════════════════════════ -->
    <section class="py-32 relative overflow-hidden bg-gray-950/60">
      <!-- Laser line -->
      <div class="laser-line" />

      <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
        <div class="section-label" data-aos="fade-down">{{ t.cta.badge }}</div>
        <h2 class="text-4xl md:text-6xl font-black mt-4 leading-tight"
            style="font-family:'Sora',sans-serif"
            data-aos="fade-up" data-aos-delay="100">
          {{ t.cta.h2a }}<br/>
          <span class="gradient-text">{{ t.cta.h2b }}</span>
        </h2>
        <p class="mt-6 text-gray-400 text-lg leading-relaxed max-w-2xl mx-auto"
           data-aos="fade-up" data-aos-delay="200">
          {{ t.cta.sub }}
        </p>
        <p class="mt-4 text-accent font-mono text-sm tracking-widest" data-aos="fade-up" data-aos-delay="250">
          admin@elditech.com
        </p>

        <!-- Contact form -->
        <form @submit.prevent="submitContact"
              class="mt-12 glass-card p-8 text-left space-y-5 max-w-xl mx-auto"
              data-aos="fade-up" data-aos-delay="300">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs text-gray-400 uppercase tracking-widest mb-1">
                {{ locale === 'id' ? 'Nama Anda' : 'Your Name' }}
              </label>
              <input v-model="contactForm.name" type="text" required
                     class="w-full bg-gray-900/80 border border-gray-700 rounded-lg px-4 py-2.5
                            text-white text-sm focus:outline-none focus:border-accent focus:ring-1
                            focus:ring-accent transition-colors" />
            </div>
            <div>
              <label class="block text-xs text-gray-400 uppercase tracking-widest mb-1">Email</label>
              <input v-model="contactForm.email" type="email" required
                     class="w-full bg-gray-900/80 border border-gray-700 rounded-lg px-4 py-2.5
                            text-white text-sm focus:outline-none focus:border-accent focus:ring-1
                            focus:ring-accent transition-colors" />
            </div>
          </div>
          <div>
            <label class="block text-xs text-gray-400 uppercase tracking-widest mb-1">
              {{ locale === 'id' ? 'Pesan' : 'Message' }}
            </label>
            <textarea v-model="contactForm.message" rows="4" required
                      class="w-full bg-gray-900/80 border border-gray-700 rounded-lg px-4 py-2.5
                             text-white text-sm focus:outline-none focus:border-accent focus:ring-1
                             focus:ring-accent transition-colors resize-none" />
          </div>
          <button type="submit" class="btn-primary w-full text-center">
            {{ locale === 'id' ? 'Kirim Pesan' : 'Send Message' }}
          </button>
          <p v-if="contactSent" class="text-accent text-sm text-center font-semibold">
            {{ locale === 'id' ? '✓ Pesan terkirim! Kami akan segera menghubungi Anda.' : '✓ Message sent! We\'ll be in touch soon.' }}
          </p>
        </form>
      </div>
    </section>

  </PublicLayout>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import AOS from 'aos';
import 'aos/dist/aos.css';

defineProps({ posts: { type: Array, default: () => [] } });

const page = usePage();
const locale = computed(() => page.props.locale || 'en');

// ── Contact form ──────────────────────────────────
const contactForm = ref({ name: '', email: '', message: '' });
const contactSent = ref(false);
function submitContact() {
  contactSent.value = true;
  contactForm.value = { name: '', email: '', message: '' };
  setTimeout(() => { contactSent.value = false; }, 5000);
}

// ── Stats ─────────────────────────────────────────
const stats = [
  { display: '10M+', label: { en: 'Downloads',       id: 'Unduhan'           } },
  { display: '50+',  label: { en: 'Apps Published',  id: 'Aplikasi Dirilis'  } },
  { display: '99.9%',label: { en: 'Uptime',          id: 'Uptime'            } },
  { display: '24/7', label: { en: 'Monitoring',      id: 'Pemantauan'        } },
];
const statEls = ref([]);

// ── Translations ──────────────────────────────────
const copy = {
  en: {
    hero: {
      meta:  'PT ELIAS DIGITAL TEKNOLOGI — Android app publishing & custom software engineering.',
      badge: 'PT ELIAS DIGITAL TEKNOLOGI',
      h1a:   'Unleashing Digital',
      h1b:   'Potential.',
      sub:   'We transform complex algorithms into seamless user experiences. Specializing in high-scale Android publishing and bespoke digital architecture.',
      cta1:  'Explore Services',
      cta2:  'View Portfolio',
    },
    services: {
      badge: 'Core Expertise',
      h2:    'Global Reach, Local Impact',
      sub:   'We manage a diverse portfolio of Android applications, reaching millions of users worldwide through ad-supported ecosystems.',
      cards: [
        {
          icon: '📱', title: 'Global App Publishing',
          desc: 'We develop and publish high-quality, ad-monetized Android applications that reach millions of users across every continent.',
          features: ['In-house App Development', 'Google Play Optimization', 'Ad Revenue Scaling', 'User Analytics & Growth'],
        },
        {
          icon: '⚙️', title: 'Software Engineering',
          desc: 'Bespoke web & mobile solutions architected to enterprise standards — from MVP to full-scale platforms with precision engineering.',
          features: ['Custom Web & App Development', 'API Design & Integration', 'Cloud Infrastructure', 'Maintenance & Support'],
        },
      ],
    },
    stats: {
      badge: 'Tech Pulse',
      h2:    'Precision in Every Byte',
      sub:   'Our infrastructure is built for scale, ensuring stability for every application we publish and deliver.',
    },
    portfolio: {
      badge: 'Our Work',
      h2:    'Architecting the Future',
      sub:   'Explore our latest Android releases and custom-built platforms that redefine industry standards.',
      mocks: [
        { icon: '📱', title: 'EduStream Android', desc: 'A top-rated educational streaming app with 2M+ downloads across Southeast Asia.' },
        { icon: '🛒', title: 'MarketHub Platform', desc: 'Custom enterprise e-commerce platform built for a Fortune 500 retail chain.' },
        { icon: '🎵', title: 'BeatFlow Music App', desc: 'Ad-monetized music discovery app reaching 500K monthly active users.' },
      ],
    },
    cta: {
      badge: 'Let\'s Collaborate',
      h2a:  'Let\'s Build the',
      h2b:  'Next Big Thing.',
      sub:  'Whether it\'s app publishing or custom software, our engineering team is ready to scale your vision into reality.',
    },
    ceo: {
      badge: 'The Architect',
      h2: 'Meet the Visionary',
      name: 'Kukuh Tri Winarno N., S.Kom.',
      role: 'CEO & Lead Engineer',
      bio: 'Bachelor Degree of Computer Science, driving innovation at ELDITECH since 2020. At 27, I\'ve spearheaded 40+ high-end web projects for diverse clients across Indonesia and Singapore. My expertise lies at the intersection of robust backend architecture and fluid mobile experiences.',
      stats: [
        { label: 'Websites Built', value: '40+' },
        { label: 'Years Experience', value: '4+' },
        { label: 'Core Skills', value: 'Web & Mobile' }
      ]
    },
  },
  id: {
    hero: {
      meta:  'PT ELIAS DIGITAL TEKNOLOGI — Spesialis penerbitan aplikasi Android & rekayasa perangkat lunak kustom.',
      badge: 'Solusi Digital Global',
      h1a:   'Melepaskan Potensi',
      h1b:   'Digital.',
      sub:   'Kami mengubah algoritma kompleks menjadi pengalaman pengguna yang intuitif. Spesialis dalam publikasi aplikasi Android berskala besar dan arsitektur digital kustom.',
      cta1:  'Jelajahi Layanan',
      cta2:  'Lihat Portofolio',
    },
    services: {
      badge: 'Keahlian Utama',
      h2:    'Jangkauan Global, Dampak Lokal',
      sub:   'Kami mengelola berbagai portofolio aplikasi Android yang menjangkau jutaan pengguna secara global melalui ekosistem berbasis iklan.',
      cards: [
        {
          icon: '📱', title: 'Penerbitan Aplikasi Global',
          desc: 'Kami mengembangkan dan menerbitkan aplikasi Android berkualitas tinggi dengan monetisasi iklan yang menjangkau jutaan pengguna di seluruh benua.',
          features: ['Pengembangan Aplikasi In-House', 'Optimisasi Google Play', 'Peningkatan Pendapatan Iklan', 'Analitik & Pertumbuhan Pengguna'],
        },
        {
          icon: '⚙️', title: 'Rekayasa Perangkat Lunak',
          desc: 'Solusi web & mobile kustom berstandar enterprise — dari MVP hingga platform skala penuh dengan rekayasa presisi tinggi.',
          features: ['Pengembangan Web & App Kustom', 'Desain & Integrasi API', 'Infrastruktur Cloud', 'Pemeliharaan & Dukungan'],
        },
      ],
    },
    stats: {
      badge: 'Denyut Teknologi',
      h2:    'Presisi dalam Setiap Byte',
      sub:   'Infrastruktur kami dirancang untuk skalabilitas tinggi, menjamin stabilitas untuk setiap aplikasi yang kami publikasikan dan kembangkan.',
    },
    portfolio: {
      badge: 'Karya Kami',
      h2:    'Merancang Masa Depan',
      sub:   'Jelajahi rilis aplikasi Android terbaru dan platform kustom kami yang menetapkan standar baru di industri.',
      mocks: [
        { icon: '📱', title: 'EduStream Android', desc: 'Aplikasi streaming edukatif teratas dengan 2 juta unduhan di seluruh Asia Tenggara.' },
        { icon: '🛒', title: 'MarketHub Platform', desc: 'Platform e-commerce enterprise kustom yang dibangun untuk perusahaan ritel Fortune 500.' },
        { icon: '🎵', title: 'BeatFlow Music App', desc: 'Aplikasi penemuan musik berbasis iklan dengan 500 ribu pengguna aktif bulanan.' },
      ],
    },
    cta: {
      badge: 'Mari Berkolaborasi',
      h2a:  'Mari Bangun',
      h2b:  'Inovasi Berikutnya.',
      sub:  'Baik publikasi aplikasi maupun perangkat lunak kustom, tim engin\eer kami siap mewujudkan visi Anda menjadi kenyataan.',
    },
    ceo: {
      badge: 'Sang Arsitek',
      h2: 'Temui Sang Visioner',
      name: 'Kukuh Tri Winarno N., S.Kom.',
      role: 'CEO & Insinyur Utama',
      bio: 'Lulusan Sarjana Ilmu Komputer, memimpin inovasi di ELDITECH sejak 2020. Di usia 27 tahun, saya telah memimpin lebih dari 40 proyek web kelas atas untuk berbagai klien di Indonesia dan Singapura. Keahlian saya terletak pada titik temu antara arsitektur backend yang kokoh dan pengalaman mobile yang mulus.',
      stats: [
        { label: 'Website Dibangun', value: '40+' },
        { label: 'Tahun Pengalaman', value: '4+' },
        { label: 'Keahlian Utama', value: 'Web & Mobile' }
      ]
    },
  },
};

const t = computed(() => copy[locale.value] || copy.en);

// ── Canvas: Particle Network ──────────────────────
const particleCanvas = ref(null);
let animId = null;

function initParticles(canvas) {
  const ctx = canvas.getContext('2d');
  let W = canvas.width = canvas.offsetWidth;
  let H = canvas.height = canvas.offsetHeight;
  let mx = W / 2, my = H / 2;

  const count = Math.floor((W * H) / 12000);
  const particles = Array.from({ length: count }, () => ({
    x: Math.random() * W, y: Math.random() * H,
    vx: (Math.random() - 0.5) * 0.5, vy: (Math.random() - 0.5) * 0.5,
    r: Math.random() * 2 + 1,
  }));

  canvas.addEventListener('mousemove', e => {
    const rect = canvas.getBoundingClientRect();
    mx = e.clientX - rect.left; my = e.clientY - rect.top;
  });

  function draw() {
    ctx.clearRect(0, 0, W, H);
    particles.forEach(p => {
      p.x += p.vx; p.y += p.vy;
      if (p.x < 0 || p.x > W) p.vx *= -1;
      if (p.y < 0 || p.y > H) p.vy *= -1;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fillStyle = 'rgba(157,255,32,0.7)';
      ctx.fill();
    });
    particles.forEach((a, i) => {
      particles.slice(i + 1).forEach(b => {
        const dx = a.x - b.x, dy = a.y - b.y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < 120) {
          ctx.beginPath();
          ctx.moveTo(a.x, a.y); ctx.lineTo(b.x, b.y);
          ctx.strokeStyle = `rgba(157,255,32,${0.3 * (1 - dist / 120)})`;
          ctx.lineWidth = 0.5;
          ctx.stroke();
        }
      });
      // Mouse connection
      const dx = a.x - mx, dy = a.y - my;
      const dist = Math.sqrt(dx * dx + dy * dy);
      if (dist < 180) {
        ctx.beginPath();
        ctx.moveTo(a.x, a.y); ctx.lineTo(mx, my);
        ctx.strokeStyle = `rgba(157,255,32,${0.5 * (1 - dist / 180)})`;
        ctx.lineWidth = 0.8;
        ctx.stroke();
      }
    });
    animId = requestAnimationFrame(draw);
  }
  draw();

  const resizeObs = new ResizeObserver(() => {
    W = canvas.width = canvas.offsetWidth;
    H = canvas.height = canvas.offsetHeight;
  });
  resizeObs.observe(canvas);
}

// ── Canvas: Matrix Rain ───────────────────────────
const matrixCanvas = ref(null);
let matrixId = null;

function initMatrix(canvas) {
  const ctx = canvas.getContext('2d');
  canvas.width = canvas.offsetWidth;
  canvas.height = canvas.offsetHeight;
  const cols = Math.floor(canvas.width / 16);
  const drops = Array(cols).fill(0);
  const chars = '01アイウエオカキクケコサシスセソタ';

  function draw() {
    ctx.fillStyle = 'rgba(10,10,10,0.05)';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = '#9DFF20';
    ctx.font = '12px monospace';
    drops.forEach((y, i) => {
      ctx.fillText(chars[Math.floor(Math.random() * chars.length)], i * 16, y * 16);
      if (y * 16 > canvas.height && Math.random() > 0.975) drops[i] = 0;
      else drops[i]++;
    });
    matrixId = requestAnimationFrame(draw);
  }
  draw();
}

onMounted(() => {
  AOS.init({ duration: 700, once: true, easing: 'ease-out-cubic', offset: 80 });

  if (particleCanvas.value) initParticles(particleCanvas.value);
  if (matrixCanvas.value)  initMatrix(matrixCanvas.value);
});

onUnmounted(() => {
  if (animId)   cancelAnimationFrame(animId);
  if (matrixId) cancelAnimationFrame(matrixId);
});
</script>
