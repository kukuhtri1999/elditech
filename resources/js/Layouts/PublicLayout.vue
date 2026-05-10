<template>
  <div class="min-h-screen bg-[#0A0A0A] text-white font-sans selection:bg-accent selection:text-[#0A0A0A]">

    <!-- ── NAVBAR ── -->
    <nav class="fixed top-0 inset-x-0 z-50 h-16 backdrop-blur-xl bg-[#0A0A0A]/80
                border-b border-white/5 transition-all duration-300"
         :class="{ 'bg-[#0A0A0A]/95 shadow-lg': scrolled }">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center justify-between">

        <!-- Logo -->
        <Link :href="route('home', { locale: $page.props.locale })" class="flex items-center gap-2 group">
          <img src="/img/logo-white.png" alt="ELDITECH — PT Elias Digital Teknologi"
               class="h-9 object-contain transition-opacity group-hover:opacity-80" />
        </Link>

        <!-- Desktop Nav -->
        <div class="hidden md:flex items-center gap-1">
          <NavLink v-for="link in navLinks" :key="link.name"
                   :href="route(link.route, { locale: $page.props.locale })"
                   :active="$page.props.currentRouteName === link.route">
            {{ link.label[$page.props.locale] }}
          </NavLink>
        </div>

        <!-- Right side: lang switcher + CTA -->
        <div class="flex items-center gap-4">
          <!-- Language Switcher -->
          <div class="flex gap-1 p-1 rounded-full border border-white/10 bg-white/5 text-xs">
            <a v-for="lng in ['en','id']" :key="lng"
               :href="switchLangUrl(lng)"
               :class="[locale === lng
                 ? 'bg-accent text-[#0A0A0A] font-bold'
                 : 'text-gray-400 hover:text-white',
                 'px-3 py-1 rounded-full transition-all duration-200']">
              {{ lng.toUpperCase() }}
            </a>
          </div>

          <!-- Mobile hamburger -->
          <button @click="mobileOpen = !mobileOpen"
                  class="md:hidden text-gray-400 hover:text-white">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    :d="mobileOpen ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'"/>
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Menu -->
      <transition name="slide-down">
        <div v-if="mobileOpen"
             class="md:hidden absolute inset-x-0 top-16 bg-[#0A0A0A]/98 border-b border-white/10
                    backdrop-blur-xl px-4 py-4 flex flex-col gap-2">
          <Link v-for="link in navLinks" :key="link.name"
                :href="route(link.route, { locale: $page.props.locale })"
                @click="mobileOpen = false"
                class="text-gray-300 hover:text-accent px-3 py-2 rounded-lg hover:bg-white/5
                       transition-all text-sm font-medium">
            {{ link.label[$page.props.locale] }}
          </Link>
        </div>
      </transition>
    </nav>

    <!-- Page content (with top padding for fixed nav) -->
    <main class="pt-16">
      <slot />
    </main>

    <!-- ── FOOTER ── -->
    <footer class="border-t border-white/5 mt-32">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
          <!-- Brand -->
          <div class="md:col-span-2">
            <img src="/img/logo-white.png" alt="ELDITECH" class="h-10 object-contain mb-4" />
            <p class="mt-3 text-sm text-gray-500 max-w-xs leading-relaxed">
              {{ locale === 'id'
                ? 'PT ELIAS DIGITAL TEKNOLOGI — Membangun masa depan digital melalui rekayasa presisi dan jangkauan global.'
                : 'PT ELIAS DIGITAL TEKNOLOGI — Engineering the digital future through precision and global reach.'
              }}
            </p>
            <p class="mt-4 text-xs text-gray-600">elditech.com</p>
          </div>
          <!-- Links -->
          <div>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-4">
              {{ locale === 'id' ? 'Navigasi' : 'Navigation' }}
            </p>
            <ul class="space-y-2">
              <li v-for="link in navLinks" :key="link.name">
                <Link :href="route(link.route, { locale: $page.props.locale })"
                      class="text-sm text-gray-400 hover:text-accent transition-colors">
                  {{ link.label[$page.props.locale] }}
                </Link>
              </li>
            </ul>
          </div>
          <!-- Legal -->
          <div>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-4">Legal</p>
            <ul class="space-y-2">
              <li><Link :href="route('privacy', { locale: $page.props.locale })" class="text-sm text-gray-400 hover:text-accent transition-colors">{{ $page.props.locale === 'id' ? 'Kebijakan Privasi' : 'Privacy Policy' }}</Link></li>
              <li><Link :href="route('terms', { locale: $page.props.locale })" class="text-sm text-gray-400 hover:text-accent transition-colors">{{ $page.props.locale === 'id' ? 'Syarat & Ketentuan' : 'Terms of Service' }}</Link></li>
            </ul>
          </div>
        </div>
        <div class="mt-12 pt-6 border-t border-white/5 flex flex-col md:flex-row justify-between
                    items-center gap-4 text-xs text-gray-600">
          <span>© {{ new Date().getFullYear() }} PT ELIAS DIGITAL TEKNOLOGI. All rights reserved.</span>
          <span>{{ locale === 'id' ? 'Dibangun dengan ❤️ di Indonesia' : 'Built with ❤️ in Indonesia' }}</span>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const NavLink = {
  props: { href: String, active: Boolean },
  template: `<Link :href="href"
    :class="[active
      ? 'text-accent font-semibold'
      : 'text-gray-400 hover:text-white',
      'px-3 py-2 text-sm rounded-lg hover:bg-white/5 transition-all duration-200']">
    <slot />
  </Link>`,
  components: { Link },
};

const page = usePage();
const locale = computed(() => page.props.locale || 'en');
const scrolled = ref(false);
const mobileOpen = ref(false);

const navLinks = [
  { name: 'home',      route: 'home',      label: { en: 'Home',      id: 'Beranda'   } },
  { name: 'services',  route: 'services',  label: { en: 'Services',  id: 'Layanan'   } },
  { name: 'portfolio', route: 'portfolio', label: { en: 'Portfolio',  id: 'Portofolio'} },
  { name: 'contact',   route: 'contact',   label: { en: 'Contact',    id: 'Hubungi Kami'} },
];

function switchLangUrl(lang) {
  // Use page.url which is SSR-safe
  const currentUrl = page.url;
  const urlPath = currentUrl.split('?')[0];
  const query = currentUrl.includes('?') ? '?' + currentUrl.split('?')[1] : '';
  const pathParts = urlPath.split('/').filter(Boolean);
  
  if (pathParts.length > 0 && ['en', 'id'].includes(pathParts[0])) {
    pathParts[0] = lang;
    return '/' + pathParts.join('/') + query;
  }
  return `/${lang}/${pathParts.join('/')}${query}`;
}

function onScroll() { scrolled.value = window.scrollY > 20; }
onMounted(() => window.addEventListener('scroll', onScroll, { passive: true }));
onUnmounted(() => window.removeEventListener('scroll', onScroll));
</script>

<style scoped>
.slide-down-enter-active, .slide-down-leave-active { transition: all .2s ease; }
.slide-down-enter-from, .slide-down-leave-to { opacity: 0; transform: translateY(-8px); }
</style>
