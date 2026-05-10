<template>
  <form @submit.prevent="submit" class="space-y-6 max-w-5xl">

    <!-- Language tab switcher -->
    <div class="flex gap-2 border-b border-gray-800 pb-3">
      <button v-for="tab in ['en', 'id']" :key="tab" type="button"
              @click="activeTab = tab"
              :class="[activeTab === tab
                ? 'text-accent border-b-2 border-accent font-bold'
                : 'text-gray-500 hover:text-gray-300',
                'pb-2 px-4 text-sm transition-all -mb-3']">
        {{ tab === 'en' ? '🇬🇧 English' : '🇮🇩 Bahasa Indonesia' }}
      </button>
    </div>

    <!-- ── EN Fields ── -->
    <div v-show="activeTab === 'en'" class="space-y-5">
      <FieldGroup label="Title (EN)" id="title_en">
        <input id="title_en" v-model="form.title.en" type="text"
               class="input-field" placeholder="Post title in English" @input="autoSlug('en')" />
        <InputError :message="form.errors['title.en']" />
      </FieldGroup>
      <FieldGroup label="Slug (EN)" id="slug_en">
        <input id="slug_en" v-model="form.slug.en" type="text"
               class="input-field font-mono text-sm" placeholder="auto-generated-slug" />
        <InputError :message="form.errors['slug.en']" />
      </FieldGroup>
      <FieldGroup label="Excerpt (EN)" id="excerpt_en">
        <textarea id="excerpt_en" v-model="form.excerpt.en" rows="2"
                  class="input-field resize-none" placeholder="Short summary (used in SEO & cards)" />
      </FieldGroup>
      <FieldGroup label="Content (EN)">
        <QuillEditor v-model="form.content.en" />
        <InputError :message="form.errors['content.en']" />
      </FieldGroup>
      <FieldGroup label="SEO Meta Title (EN)" id="seo_title_en">
        <input id="seo_title_en" v-model="form.seo_title.en" type="text"
               class="input-field" placeholder="SEO title (max 60 chars)" maxlength="60" />
        <p class="text-xs text-gray-600 mt-1">{{ form.seo_title.en?.length || 0 }}/60</p>
      </FieldGroup>
      <FieldGroup label="SEO Meta Description (EN)" id="seo_desc_en">
        <textarea id="seo_desc_en" v-model="form.seo_description.en" rows="2"
                  class="input-field resize-none" placeholder="Meta description (max 160 chars)" maxlength="160" />
        <p class="text-xs text-gray-600 mt-1">{{ form.seo_description.en?.length || 0 }}/160</p>
      </FieldGroup>
      <FieldGroup label="SEO Keywords (EN)" id="seo_kw_en">
        <input id="seo_kw_en" v-model="form.seo_keywords.en" type="text"
               class="input-field" placeholder="android app, mobile, software" />
      </FieldGroup>
    </div>

    <!-- ── ID Fields ── -->
    <div v-show="activeTab === 'id'" class="space-y-5">
      <FieldGroup label="Judul (ID)" id="title_id">
        <input id="title_id" v-model="form.title.id" type="text"
               class="input-field" placeholder="Judul postingan dalam Bahasa Indonesia" @input="autoSlug('id')" />
        <InputError :message="form.errors['title.id']" />
      </FieldGroup>
      <FieldGroup label="Slug (ID)" id="slug_id">
        <input id="slug_id" v-model="form.slug.id" type="text"
               class="input-field font-mono text-sm" placeholder="slug-otomatis" />
      </FieldGroup>
      <FieldGroup label="Ringkasan (ID)" id="excerpt_id">
        <textarea id="excerpt_id" v-model="form.excerpt.id" rows="2"
                  class="input-field resize-none" placeholder="Ringkasan singkat (untuk SEO & kartu)" />
      </FieldGroup>
      <FieldGroup label="Konten (ID)">
        <QuillEditor v-model="form.content.id" />
        <InputError :message="form.errors['content.id']" />
      </FieldGroup>
      <FieldGroup label="SEO Meta Title (ID)" id="seo_title_id">
        <input id="seo_title_id" v-model="form.seo_title.id" type="text"
               class="input-field" placeholder="SEO title (maks 60 karakter)" maxlength="60" />
        <p class="text-xs text-gray-600 mt-1">{{ form.seo_title.id?.length || 0 }}/60</p>
      </FieldGroup>
      <FieldGroup label="SEO Meta Description (ID)" id="seo_desc_id">
        <textarea id="seo_desc_id" v-model="form.seo_description.id" rows="2"
                  class="input-field resize-none" placeholder="Deskripsi meta (maks 160 karakter)" maxlength="160" />
        <p class="text-xs text-gray-600 mt-1">{{ form.seo_description.id?.length || 0 }}/160</p>
      </FieldGroup>
      <FieldGroup label="Kata Kunci SEO (ID)" id="seo_kw_id">
        <input id="seo_kw_id" v-model="form.seo_keywords.id" type="text"
               class="input-field" placeholder="aplikasi android, mobile, perangkat lunak" />
      </FieldGroup>
    </div>

    <!-- ── Common: Featured Image & Gallery ── -->
    <div class="border-t border-gray-800 pt-6 space-y-6">
      <h3 class="text-sm font-semibold text-gray-300 uppercase tracking-widest">Media & Gallery</h3>
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Featured Image -->
        <div>
          <FieldGroup label="Featured Image (Upload)" id="featured_image">
            <input id="featured_image" type="file" accept="image/*" @change="e => form.featured_image = e.target.files[0]"
                   class="w-full text-sm text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-accent file:text-[#0A0A0A] hover:file:bg-[#b0ff4d] file:cursor-pointer transition-all" />
          </FieldGroup>
          <div v-if="post?.featured_image && !form.featured_image" class="mt-2">
            <p class="text-xs text-gray-500 mb-1">Current Image:</p>
            <img :src="post.featured_image" alt="Preview" class="h-32 w-full object-cover rounded-lg border border-gray-700" />
          </div>
          <InputError :message="form.errors.featured_image" />
        </div>
        
        <!-- Gallery -->
        <div>
          <FieldGroup label="Gallery Images (Upload Multiple)" id="gallery">
            <input id="gallery" type="file" multiple accept="image/*" @change="e => form.gallery = Array.from(e.target.files)"
                   class="w-full text-sm text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-800 file:text-white hover:file:bg-gray-700 file:cursor-pointer transition-all" />
          </FieldGroup>
          <div v-if="post?.gallery?.length && !form.gallery?.length" class="mt-2">
            <p class="text-xs text-gray-500 mb-1">Current Gallery ({{ post.gallery.length }} images):</p>
            <div class="flex gap-2 overflow-x-auto pb-2">
              <img v-for="img in post.gallery" :key="img" :src="img" class="h-20 w-20 object-cover rounded-md border border-gray-700 flex-shrink-0" />
            </div>
            <!-- Keep existing gallery if no new files selected -->
            <input type="hidden" v-for="img in post.gallery" :key="img" name="existing_gallery[]" :value="img" />
          </div>
          <InputError :message="form.errors.gallery" />
        </div>
      </div>
    </div>

    <!-- ── Publish toggle ── -->
    <div class="border-t border-gray-800 pt-6">
      <label class="flex items-center gap-3 cursor-pointer group w-fit">
        <div class="relative">
          <input type="checkbox" v-model="form.is_published" class="sr-only" />
          <div :class="[form.is_published ? 'bg-accent' : 'bg-gray-700',
                        'w-10 h-5 rounded-full transition-colors duration-200']" />
          <div :class="[form.is_published ? 'translate-x-5' : 'translate-x-0.5',
                        'absolute top-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200']" />
        </div>
        <span class="text-sm text-gray-300 group-hover:text-white transition-colors">
          Publish this post
        </span>
        <span v-if="form.is_published"
              class="text-xs text-accent font-semibold bg-accent/10 px-2 py-0.5 rounded-full">Live</span>
      </label>
    </div>

    <!-- ── Submit ── -->
    <div class="flex items-center justify-between pt-6 border-t border-gray-800">
      <Link :href="route('posts.index')"
            class="text-sm text-gray-400 hover:text-white transition-colors">
        ← Back to Posts
      </Link>
      <button type="submit"
              :disabled="form.processing"
              class="btn-primary text-sm px-6 py-3 disabled:opacity-50 disabled:cursor-not-allowed">
        <span v-if="form.processing">Saving…</span>
        <span v-else>{{ isEditing ? 'Save Changes' : 'Publish Post' }}</span>
      </button>
    </div>

  </form>
</template>

<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import QuillEditor from '@/Components/QuillEditor.vue';
import InputError from '@/Components/InputError.vue';
import FieldGroup from '@/Components/FieldGroup.vue';

const props = defineProps({
  post:      { type: Object, default: null },
  isEditing: { type: Boolean, default: false },
});

const activeTab = ref('en');

const form = useForm({
  title:           props.post?.title           || { en: '', id: '' },
  slug:            props.post?.slug            || { en: '', id: '' },
  excerpt:         props.post?.excerpt         || { en: '', id: '' },
  content:         props.post?.content         || { en: '', id: '' },
  seo_title:       props.post?.seo_title       || { en: '', id: '' },
  seo_description: props.post?.seo_description || { en: '', id: '' },
  seo_keywords:    props.post?.seo_keywords    || { en: '', id: '' },
  featured_image:  null, // Handled as File object
  gallery:         [],   // Handled as Array of File objects
  is_published:    props.post?.is_published    || false,
});

function slugify(str) {
  return str.toLowerCase()
    .replace(/[^a-z0-9\s-]/g, '')
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-')
    .trim();
}

function autoSlug(lang) {
  form.slug[lang] = slugify(form.title[lang] || '');
}

function submit() {
  if (props.isEditing) {
    // Inertia requires POST for multipart form data, we spoof PUT using _method
    form.transform((data) => {
        let transformed = { ...data, _method: 'put' };
        if (props.post?.gallery && (!data.gallery || data.gallery.length === 0)) {
            transformed.existing_gallery = props.post.gallery;
        }
        return transformed;
    }).post(route('posts.update', props.post.id));
  } else {
    form.post(route('posts.store'));
  }
}
</script>

<style scoped>
.input-field {
  @apply w-full bg-gray-900/80 border border-gray-700 rounded-lg px-4 py-2.5
         text-white text-sm focus:outline-none focus:border-accent focus:ring-1
         focus:ring-accent transition-colors placeholder-gray-600;
}
</style>
