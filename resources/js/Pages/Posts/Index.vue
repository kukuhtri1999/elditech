<template>
  <Head title="Posts Management" />
  <AdminLayout title="Posts Management" subtitle="Create and manage bilingual content">

    <div class="flex items-center justify-between mb-6">
      <div class="flex items-center gap-3">
        <!-- Filter tabs -->
        <button v-for="tab in tabs" :key="tab.value"
                @click="activeTab = tab.value"
                :class="[activeTab === tab.value
                  ? 'bg-accent text-[#0A0A0A] font-bold'
                  : 'bg-gray-800/60 text-gray-400 hover:text-white',
                  'px-4 py-1.5 rounded-lg text-sm transition-all']">
          {{ tab.label }} <span class="ml-1 opacity-60">{{ tabCount(tab.value) }}</span>
        </button>
      </div>
      <Link :href="route('posts.create')"
            class="btn-primary text-sm px-5 py-2.5">
        + New Post
      </Link>
    </div>

    <!-- Search -->
    <div class="mb-5">
      <input v-model="search" type="text" placeholder="Search posts..."
             class="w-full max-w-sm bg-gray-900 border border-gray-700 rounded-lg px-4 py-2.5
                    text-white text-sm focus:outline-none focus:border-accent transition-colors" />
    </div>

    <div class="glass-card overflow-hidden">
      <div v-if="filteredPosts.length === 0"
           class="text-center py-16 text-gray-500 text-sm">
        No posts found. <Link :href="route('posts.create')" class="text-accent hover:underline">Create one</Link>
      </div>

      <table v-else class="w-full text-sm">
        <thead class="border-b border-gray-800">
          <tr>
            <th class="text-left py-3 px-5 text-xs text-gray-500 uppercase tracking-widest">Title (EN)</th>
            <th class="text-left py-3 px-5 text-xs text-gray-500 uppercase tracking-widest hidden md:table-cell">Title (ID)</th>
            <th class="text-left py-3 px-5 text-xs text-gray-500 uppercase tracking-widest">Status</th>
            <th class="text-left py-3 px-5 text-xs text-gray-500 uppercase tracking-widest hidden lg:table-cell">Date</th>
            <th class="text-right py-3 px-5 text-xs text-gray-500 uppercase tracking-widest">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="post in filteredPosts" :key="post.id"
              class="border-b border-gray-800/40 hover:bg-white/3 transition-colors">
            <td class="py-3 px-5 text-gray-200 font-medium max-w-[200px] truncate">
              {{ post.title?.en || '—' }}
            </td>
            <td class="py-3 px-5 text-gray-400 max-w-[200px] truncate hidden md:table-cell">
              {{ post.title?.id || '—' }}
            </td>
            <td class="py-3 px-5">
              <span :class="post.is_published
                ? 'bg-accent/10 text-accent border-accent/20'
                : 'bg-gray-800 text-gray-400 border-gray-700'"
                    class="text-xs px-2 py-0.5 rounded-full border font-semibold">
                {{ post.is_published ? 'Published' : 'Draft' }}
              </span>
            </td>
            <td class="py-3 px-5 text-gray-500 text-xs hidden lg:table-cell">
              {{ formatDate(post.created_at) }}
            </td>
            <td class="py-3 px-5 text-right space-x-3">
              <Link :href="route('posts.edit', post.id)"
                    class="text-xs text-accent hover:underline font-medium">Edit</Link>
              <button @click="confirmDelete(post)"
                      class="text-xs text-red-400 hover:underline font-medium">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Delete confirmation modal -->
    <Teleport to="body">
      <div v-if="deleteTarget"
           class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
        <div class="glass-card p-8 max-w-sm w-full mx-4 space-y-5">
          <h3 class="text-lg font-bold text-white">Delete Post?</h3>
          <p class="text-gray-400 text-sm">
            Are you sure you want to delete
            <strong class="text-white">"{{ deleteTarget.title?.en || 'this post' }}"</strong>?
            This action cannot be undone.
          </p>
          <div class="flex gap-3 justify-end">
            <button @click="deleteTarget = null"
                    class="px-4 py-2 text-sm text-gray-400 hover:text-white transition-colors">
              Cancel
            </button>
            <button @click="doDelete"
                    class="px-4 py-2 text-sm bg-red-500 text-white font-bold rounded-lg
                           hover:bg-red-600 transition-colors">
              Delete
            </button>
          </div>
        </div>
      </div>
    </Teleport>

  </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({ posts: { type: Array, default: () => [] } });

const search = ref('');
const activeTab = ref('all');
const deleteTarget = ref(null);

const tabs = [
  { label: 'All',       value: 'all' },
  { label: 'Published', value: 'published' },
  { label: 'Draft',     value: 'draft' },
];

function tabCount(val) {
  if (val === 'all')       return props.posts.length;
  if (val === 'published') return props.posts.filter(p => p.is_published).length;
  return props.posts.filter(p => !p.is_published).length;
}

const filteredPosts = computed(() => {
  let list = props.posts;
  if (activeTab.value === 'published') list = list.filter(p => p.is_published);
  if (activeTab.value === 'draft')     list = list.filter(p => !p.is_published);
  if (search.value.trim()) {
    const q = search.value.toLowerCase();
    list = list.filter(p =>
      p.title?.en?.toLowerCase().includes(q) ||
      p.title?.id?.toLowerCase().includes(q)
    );
  }
  return list;
});

function formatDate(dt) {
  if (!dt) return '—';
  return new Date(dt).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
}

function confirmDelete(post) { deleteTarget.value = post; }
function doDelete() {
  if (!deleteTarget.value) return;
  router.delete(route('posts.destroy', deleteTarget.value.id), {
    onSuccess: () => { deleteTarget.value = null; },
  });
}
</script>
