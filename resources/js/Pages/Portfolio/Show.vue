<template>
  <Head>
    <title>{{ seoTitle }} | ELDITECH</title>
    <meta name="description" :content="seoDesc" />
    <meta name="keywords" :content="seoKeywords" />
    <meta property="og:title" :content="seoTitle" />
    <meta property="og:description" :content="seoDesc" />
    <meta property="og:image" :content="post.featured_image ? post.featured_image : '/img/logo-white.png'" />
    <meta property="og:type" content="article" />
  </Head>

  <PublicLayout>
    <article class="pt-32 pb-24">
      <!-- Header -->
      <header class="max-w-4xl mx-auto px-6 text-center mb-16">
        <div class="section-label mb-6" data-aos="fade-down">{{ isId ? 'Studi Kasus' : 'Case Study' }}</div>
        <h1 class="text-4xl md:text-6xl font-black leading-tight" style="font-family:'Sora',sans-serif" data-aos="fade-up">
          {{ postTitle }}
        </h1>
        <p class="mt-6 text-xl text-gray-400 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
          {{ postExcerpt }}
        </p>
      </header>

      <!-- Featured Image -->
      <div v-if="post.featured_image" class="max-w-6xl mx-auto px-6 mb-20" data-aos="zoom-in" data-aos-delay="200">
        <div class="aspect-video w-full rounded-2xl overflow-hidden border border-gray-800 shadow-2xl relative group">
          <img :src="post.featured_image" :alt="postTitle" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
          <div class="absolute inset-0 bg-gradient-to-t from-[#0A0A0A] to-transparent opacity-60"></div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="max-w-3xl mx-auto px-6 prose prose-invert prose-lg prose-a:text-accent hover:prose-a:text-[#b0ff4d] prose-headings:font-black prose-headings:font-['Sora'] leading-relaxed"
           data-aos="fade-up" v-html="postContent">
      </div>

      <!-- Gallery -->
      <div v-if="post.gallery && post.gallery.length > 0" class="max-w-6xl mx-auto px-6 mt-24">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-black" style="font-family:'Sora',sans-serif">{{ isId ? 'Galeri Proyek' : 'Project Gallery' }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="(img, i) in post.gallery" :key="i" class="aspect-video rounded-xl overflow-hidden border border-gray-800" data-aos="fade-up" :data-aos-delay="i * 100">
            <img :src="img" :alt="postTitle + ' gallery image ' + (i+1)" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500" />
          </div>
        </div>
      </div>

      <!-- Back CTA -->
      <div class="max-w-3xl mx-auto px-6 mt-24 text-center" data-aos="fade-up">
        <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-700 to-transparent mb-12"></div>
        <Link :href="route('portfolio', { locale })" class="btn-secondary inline-block">
          {{ isId ? '← Kembali ke Portofolio' : '← Back to Portfolio' }}
        </Link>
      </div>
    </article>
  </PublicLayout>
</template>

<script setup>
import { computed, onMounted } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import AOS from 'aos';
import 'aos/dist/aos.css';

const props = defineProps({
  post: { type: Object, required: true }
});

const page = usePage();
const locale = computed(() => page.props.locale || 'en');
const isId = computed(() => locale.value === 'id');

const postTitle = computed(() => props.post.title[locale.value] || props.post.title.en);
const postExcerpt = computed(() => props.post.excerpt[locale.value] || props.post.excerpt.en);
const postContent = computed(() => props.post.content[locale.value] || props.post.content.en);

const seoTitle = computed(() => props.post.seo_title?.[locale.value] || props.post.seo_title?.en || postTitle.value);
const seoDesc = computed(() => props.post.seo_description?.[locale.value] || props.post.seo_description?.en || postExcerpt.value);
const seoKeywords = computed(() => props.post.seo_keywords?.[locale.value] || props.post.seo_keywords?.en || '');

onMounted(() => {
  AOS.init({ duration: 800, once: true, offset: 50 });
});
</script>
