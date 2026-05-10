<template>
    <Head>
      <title>{{ $page.props.locale === 'id' ? 'Portofolio | ELDITECH' : 'Portfolio | ELDITECH' }}</title>
      <meta name="description" :content="$page.props.locale === 'id' ? 'Lihat portofolio karya kami di PT ELIAS DIGITAL TEKNOLOGI.' : 'View our portfolio of work at PT ELIAS DIGITAL TEKNOLOGI.'" />
      <meta name="keywords" content="portfolio, apps, android, custom software, elditech" />
    </Head>
    <PublicLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <h1 class="text-4xl md:text-5xl font-black mb-12 text-center" style="font-family:'Sora',sans-serif">
              {{ $page.props.locale === 'id' ? 'Portofolio' : 'Portfolio' }}
            </h1>
            
            <div v-if="posts.length === 0" class="text-center text-gray-400 py-12">
                {{ $page.props.locale === 'id' ? 'Belum ada proyek yang dipublikasikan.' : 'No projects published yet.' }}
            </div>

            <div v-else class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Portfolio Items -->
                <div v-for="post in posts" :key="post.id" class="backdrop-blur-xl bg-white/5 border border-white/10 rounded-2xl overflow-hidden group hover:border-accent transition-colors flex flex-col">
                    <div class="h-48 bg-gray-800 flex items-center justify-center group-hover:bg-gray-700 transition-colors bg-cover bg-center" :style="{ backgroundImage: post.featured_image ? `url(${post.featured_image})` : '' }">
                        <span v-if="!post.featured_image" class="text-gray-500">No Image</span>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-xl font-bold mb-2">{{ post.title[$page.props.locale] || post.title['en'] }}</h3>
                        <p class="text-gray-400 text-sm flex-1">
                            {{ post.excerpt && post.excerpt[$page.props.locale] ? post.excerpt[$page.props.locale] : (post.excerpt ? post.excerpt['en'] : '') }}
                        </p>
                        <div class="mt-4 pt-4 border-t border-gray-800">
                             <Link :href="route('portfolio.show', { locale: $page.props.locale, slug: post.slug?.[$page.props.locale] || post.slug?.en })"
                                   class="text-accent text-sm font-semibold hover:underline">
                                 {{ $page.props.locale === 'id' ? 'Lihat Proyek' : 'View Project' }} &rarr;
                             </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';

defineProps({
    posts: {
        type: Array,
        default: () => []
    }
});
</script>
