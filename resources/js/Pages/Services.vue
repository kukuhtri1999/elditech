<template>
  <Head>
    <title>{{ isId ? 'Layanan Kami — ELDITECH' : 'Our Services — ELDITECH' }}</title>
    <meta name="description" :content="isId
      ? 'ELDITECH menyediakan layanan penerbitan aplikasi Android global dan pengembangan perangkat lunak kustom berstandar enterprise.'
      : 'ELDITECH provides global Android app publishing and bespoke enterprise software development services.'" />
    <meta name="keywords" content="android app publishing, custom software development, mobile app, enterprise solutions, ELDITECH" />
    <meta property="og:title" :content="isId ? 'Layanan ELDITECH' : 'ELDITECH Services'" />
    <meta property="og:type" content="website" />
  </Head>
  <PublicLayout>

    <!-- Page Header -->
    <section class="relative pt-32 pb-20 overflow-hidden">
      <div class="absolute inset-0 bg-[url('')] opacity-5 pointer-events-none" />
      <div class="absolute top-20 left-1/2 -translate-x-1/2 w-[500px] h-[300px] bg-accent/10 blur-[100px] rounded-full pointer-events-none" />
      <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
        <div class="section-label">{{ isId ? 'Apa Yang Kami Lakukan' : 'What We Do' }}</div>
        <h1 class="text-4xl md:text-6xl font-black mt-4 leading-tight" style="font-family:'Sora',sans-serif">
          {{ isId ? 'Layanan' : 'Our' }}<br/>
          <span class="gradient-text">{{ isId ? 'Kami' : 'Services' }}</span>
        </h1>
        <p class="mt-6 text-gray-400 text-lg max-w-2xl mx-auto">
          {{ isId
            ? 'Dari penerbitan aplikasi skala global hingga rekayasa perangkat lunak tingkat enterprise — kami adalah mitra teknologi Anda.'
            : 'From global-scale app publishing to enterprise-grade software engineering — we are your technology partner.'
          }}
        </p>
      </div>
    </section>

    <!-- Services Detail -->
    <section class="py-20">
      <div class="max-w-7xl mx-auto px-6 space-y-24">

        <!-- Service 1: App Publishing -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
          <div data-aos="fade-right">
            <div class="section-label">01</div>
            <h2 class="text-3xl md:text-4xl font-black mt-3" style="font-family:'Sora',sans-serif">
              {{ isId ? 'Penerbitan Aplikasi Android Global' : 'Global Android App Publishing' }}
            </h2>
            <p class="mt-4 text-gray-400 leading-relaxed">
              {{ isId
                ? 'Kami mengembangkan, menerbitkan, dan memonetisasi aplikasi Android berkualitas tinggi yang menjangkau jutaan pengguna di seluruh dunia. Portofolio aplikasi in-house kami mencakup berbagai kategori dengan model monetisasi iklan yang telah terbukti menghasilkan pendapatan berkesinambungan.'
                : 'We develop, publish and monetize high-quality Android applications reaching millions of users worldwide. Our in-house app portfolio spans multiple categories with proven ad-monetization models generating sustainable revenue streams.'
              }}
            </p>
            <ul class="mt-6 space-y-3">
              <li v-for="f in (isId ? feId1 : feEn1)" :key="f"
                  class="flex items-start gap-3 text-sm text-gray-300">
                <span class="w-5 h-5 rounded-full bg-accent/20 border border-accent/40 flex-shrink-0 flex items-center justify-center mt-0.5">
                  <span class="w-1.5 h-1.5 rounded-full bg-accent" />
                </span>
                {{ f }}
              </li>
            </ul>
          </div>
          <div class="circuit-card glass-card p-8 text-center" data-aos="fade-left">
            <div class="text-7xl mb-4">📱</div>
            <div class="text-4xl font-black gradient-text mb-1">10M+</div>
            <div class="text-gray-400 text-sm">{{ isId ? 'Total Unduhan Kumulatif' : 'Total Cumulative Downloads' }}</div>
            <div class="mt-6 grid grid-cols-2 gap-4 text-center">
              <div class="bg-accent/5 rounded-xl p-4 border border-accent/10">
                <div class="text-2xl font-black text-accent">50+</div>
                <div class="text-xs text-gray-500 mt-1">{{ isId ? 'Aplikasi Live' : 'Live Apps' }}</div>
              </div>
              <div class="bg-accent/5 rounded-xl p-4 border border-accent/10">
                <div class="text-2xl font-black text-accent">150+</div>
                <div class="text-xs text-gray-500 mt-1">{{ isId ? 'Negara' : 'Countries' }}</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-white/5" />

        <!-- Service 2: Custom Dev -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
          <div class="circuit-card glass-card p-8 text-center order-2 md:order-1" data-aos="fade-right">
            <div class="text-7xl mb-4">⚙️</div>
            <div class="text-4xl font-black gradient-text mb-1">100%</div>
            <div class="text-gray-400 text-sm">{{ isId ? 'Tingkat Penyelesaian Proyek' : 'Project Completion Rate' }}</div>
            <div class="mt-6 grid grid-cols-2 gap-4 text-center">
              <div class="bg-accent/5 rounded-xl p-4 border border-accent/10">
                <div class="text-2xl font-black text-accent">30+</div>
                <div class="text-xs text-gray-500 mt-1">{{ isId ? 'Klien Puas' : 'Happy Clients' }}</div>
              </div>
              <div class="bg-accent/5 rounded-xl p-4 border border-accent/10">
                <div class="text-2xl font-black text-accent">5★</div>
                <div class="text-xs text-gray-500 mt-1">{{ isId ? 'Rating Rata-rata' : 'Avg Rating' }}</div>
              </div>
            </div>
          </div>
          <div class="order-1 md:order-2" data-aos="fade-left">
            <div class="section-label">02</div>
            <h2 class="text-3xl md:text-4xl font-black mt-3" style="font-family:'Sora',sans-serif">
              {{ isId ? 'Rekayasa Perangkat Lunak Kustom' : 'Custom Software Engineering' }}
            </h2>
            <p class="mt-4 text-gray-400 leading-relaxed">
              {{ isId
                ? 'Kami merancang dan membangun solusi perangkat lunak kustom yang terukur mulai dari aplikasi web hingga sistem enterprise. Tim insinyur kami menggabungkan teknologi terdepan dengan praktik rekayasa terbaik untuk menghadirkan produk yang andal dan berperforma tinggi.'
                : 'We design and build scalable custom software solutions from web applications to enterprise systems. Our engineering team combines cutting-edge technology with best engineering practices to deliver reliable, high-performance products.'
              }}
            </p>
            <ul class="mt-6 space-y-3">
              <li v-for="f in (isId ? feId2 : feEn2)" :key="f"
                  class="flex items-start gap-3 text-sm text-gray-300">
                <span class="w-5 h-5 rounded-full bg-accent/20 border border-accent/40 flex-shrink-0 flex items-center justify-center mt-0.5">
                  <span class="w-1.5 h-1.5 rounded-full bg-accent" />
                </span>
                {{ f }}
              </li>
            </ul>
          </div>
        </div>

      </div>
    </section>

    <!-- Tech Stack Section -->
    <section class="py-20 bg-gray-950/40">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
          <div class="section-label">{{ isId ? 'Teknologi' : 'Tech Stack' }}</div>
          <h2 class="text-3xl font-black mt-2" style="font-family:'Sora',sans-serif">
            {{ isId ? 'Dibangun dengan Teknologi Terkini' : 'Built with Modern Technology' }}
          </h2>
        </div>
        <div class="flex flex-wrap justify-center gap-4">
          <div v-for="tech in techs" :key="tech"
               class="px-4 py-2 glass-card text-sm text-gray-300 hover:text-accent hover:border-accent/40 transition-all cursor-default">
            {{ tech }}
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="py-24 text-center">
      <div class="max-w-2xl mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-black" style="font-family:'Sora',sans-serif">
          {{ isId ? 'Siap Memulai Proyek Anda?' : 'Ready to Start Your Project?' }}
        </h2>
        <p class="mt-4 text-gray-400">
          {{ isId
            ? 'Hubungi tim kami hari ini dan dapatkan konsultasi gratis tentang kebutuhan teknologi Anda.'
            : 'Contact our team today and get a free consultation on your technology needs.'
          }}
        </p>
        <Link :href="route('contact', { locale: $page.props.locale })" class="btn-primary inline-block mt-8">
          {{ isId ? 'Mulai Konsultasi' : 'Start Consultation' }}
        </Link>
      </div>
    </section>

  </PublicLayout>
</template>

<script setup>
import { computed, onMounted } from 'vue';
import { Head, usePage, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import AOS from 'aos';
import 'aos/dist/aos.css';

const page = usePage();
const isId = computed(() => (page.props.locale || 'en') === 'id');

const feEn1 = ['In-house Android App Development', 'Google Play Store Optimization (ASO)', 'Ad Network Integration (AdMob, Meta)', 'A/B Testing & User Acquisition', 'Revenue Analytics & Growth Hacking', 'Compliance & Policy Management'];
const feId1 = ['Pengembangan Aplikasi Android In-House', 'Optimisasi Google Play Store (ASO)', 'Integrasi Jaringan Iklan (AdMob, Meta)', 'A/B Testing & Akuisisi Pengguna', 'Analitik Pendapatan & Growth Hacking', 'Manajemen Kepatuhan & Kebijakan'];
const feEn2 = ['Full-Stack Web & Mobile Development', 'REST API & Microservices Architecture', 'Cloud Infrastructure (AWS, GCP, DigitalOcean)', 'Database Design & Optimization', 'DevOps & CI/CD Pipeline Setup', 'Long-term Maintenance & Technical Support'];
const feId2 = ['Pengembangan Web & Mobile Full-Stack', 'Arsitektur REST API & Microservices', 'Infrastruktur Cloud (AWS, GCP, DigitalOcean)', 'Desain & Optimisasi Database', 'DevOps & Setup Pipeline CI/CD', 'Pemeliharaan Jangka Panjang & Dukungan Teknis'];
const techs = ['Laravel', 'Vue.js', 'React', 'Flutter', 'Kotlin', 'Node.js', 'MySQL', 'PostgreSQL', 'Redis', 'Docker', 'Nginx', 'AWS', 'Firebase', 'TailwindCSS', 'TypeScript'];

onMounted(() => AOS.init({ duration: 700, once: true, easing: 'ease-out-cubic', offset: 60 }));
</script>
