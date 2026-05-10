<template>
  <Head title="Admin Dashboard" />
  <AdminLayout title="Dashboard" subtitle="Welcome back, let's build something great">

    <!-- Stats row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-5 mb-8">
      <div v-for="stat in dashStats" :key="stat.label" class="admin-stat-card">
        <div class="flex items-center justify-between">
          <span class="text-xs text-gray-500 uppercase tracking-widest font-semibold">{{ stat.label }}</span>
          <span class="text-xl">{{ stat.icon }}</span>
        </div>
        <div class="text-3xl font-black gradient-text" style="font-family:'Sora',sans-serif">{{ stat.value }}</div>
        <div class="text-xs text-gray-500">{{ stat.note }}</div>
      </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

      <!-- Recent Posts table -->
      <div class="xl:col-span-2 glass-card p-6">
        <div class="flex items-center justify-between mb-5">
          <h2 class="font-bold text-white">Recent Posts</h2>
          <Link :href="route('posts.create')"
                class="text-xs bg-accent text-[#0A0A0A] font-bold px-3 py-1.5 rounded-lg
                       hover:bg-[#b0ff4d] transition-colors">
            + New Post
          </Link>
        </div>

        <div v-if="recentPosts.length === 0"
             class="text-center py-12 text-gray-500 text-sm">
          No posts yet. Create your first one!
        </div>

        <table v-else class="w-full text-sm">
          <thead>
            <tr class="border-b border-gray-800">
              <th class="text-left py-2 px-3 text-xs text-gray-500 font-semibold uppercase tracking-widest">Title</th>
              <th class="text-left py-2 px-3 text-xs text-gray-500 font-semibold uppercase tracking-widest">Status</th>
              <th class="text-right py-2 px-3 text-xs text-gray-500 font-semibold uppercase tracking-widest">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="post in recentPosts" :key="post.id"
                class="border-b border-gray-800/50 hover:bg-white/3 transition-colors">
              <td class="py-3 px-3 text-gray-300 font-medium max-w-xs truncate">
                {{ post.title?.en || post.title?.id || '—' }}
              </td>
              <td class="py-3 px-3">
                <span :class="post.is_published
                  ? 'bg-accent/10 text-accent border-accent/20'
                  : 'bg-gray-800 text-gray-400 border-gray-700'"
                      class="text-xs px-2 py-0.5 rounded-full border font-semibold">
                  {{ post.is_published ? 'Published' : 'Draft' }}
                </span>
              </td>
              <td class="py-3 px-3 text-right space-x-2">
                <Link :href="route('posts.edit', post.id)"
                      class="text-xs text-accent hover:underline">Edit</Link>
              </td>
            </tr>
          </tbody>
        </table>

        <Link :href="route('posts.index')"
              class="block text-center mt-4 text-xs text-gray-500 hover:text-accent transition-colors">
          View all posts →
        </Link>
      </div>

      <!-- Quick Actions card -->
      <div class="glass-card p-6 flex flex-col gap-4">
        <h2 class="font-bold text-white mb-1">Quick Actions</h2>
        <Link :href="route('posts.create')"
              class="flex items-center gap-3 glass-card-hover p-4 rounded-xl group">
          <span class="text-2xl">✍️</span>
          <div>
            <p class="text-sm font-semibold text-white group-hover:text-accent transition-colors">
              Write New Post
            </p>
            <p class="text-xs text-gray-500">EN + ID bilingual editor</p>
          </div>
        </Link>
        <Link :href="route('home', { locale: 'en' })" target="_blank"
              class="flex items-center gap-3 glass-card-hover p-4 rounded-xl group">
          <span class="text-2xl">🌐</span>
          <div>
            <p class="text-sm font-semibold text-white group-hover:text-accent transition-colors">
              Preview Website
            </p>
            <p class="text-xs text-gray-500">Open public homepage</p>
          </div>
        </Link>
        <Link :href="route('profile.edit')"
              class="flex items-center gap-3 glass-card-hover p-4 rounded-xl group">
          <span class="text-2xl">⚙️</span>
          <div>
            <p class="text-sm font-semibold text-white group-hover:text-accent transition-colors">
              Account Settings
            </p>
            <p class="text-xs text-gray-500">Update profile & password</p>
          </div>
        </Link>

        <Link :href="route('contact-submissions.index')"
              class="flex items-center gap-3 glass-card-hover p-4 rounded-xl group">
          <span class="text-2xl">📥</span>
          <div>
            <p class="text-sm font-semibold text-white group-hover:text-accent transition-colors">
              Contact Inbox
            </p>
            <p class="text-xs text-gray-500">Review incoming inquiries</p>
          </div>
        </Link>
      </div>
    </div>

  </AdminLayout>
</template>

<script setup>
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
  recentPosts: { type: Array, default: () => [] },
  totalPosts:  { type: Number, default: 0 },
  publishedPosts: { type: Number, default: 0 },
  draftPosts:  { type: Number, default: 0 },
  totalContacts: { type: Number, default: 0 },
  unreadContacts: { type: Number, default: 0 },
});

const dashStats = computed(() => [
  { label: 'Total Posts',    value: props.totalPosts,     icon: '📝', note: 'All content' },
  { label: 'Published',      value: props.publishedPosts, icon: '🟢', note: 'Live on site' },
  { label: 'Drafts',         value: props.draftPosts,     icon: '📋', note: 'Unpublished' },
  { label: 'Inquiries',      value: props.totalContacts,  icon: '📥', note: `${props.unreadContacts} unread` },
  { label: 'App Downloads',  value: '10M+',               icon: '📱', note: 'Across all apps' },
]);
</script>
