<template>
  <Head title="Contact Submissions" />

  <AdminLayout title="Contact Submissions" subtitle="Inbox for homepage and contact page inquiries">
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
      <div class="admin-stat-card">
        <p class="text-xs text-gray-500 uppercase tracking-widest">Total</p>
        <p class="text-3xl font-black gradient-text mt-2" style="font-family:'Sora',sans-serif">{{ stats.total }}</p>
        <p class="text-xs text-gray-500">All-time inquiries</p>
      </div>
      <div class="admin-stat-card">
        <p class="text-xs text-gray-500 uppercase tracking-widest">Unread</p>
        <p class="text-3xl font-black text-accent mt-2" style="font-family:'Sora',sans-serif">{{ stats.unread }}</p>
        <p class="text-xs text-gray-500">Needs follow-up</p>
      </div>
      <div class="admin-stat-card">
        <p class="text-xs text-gray-500 uppercase tracking-widest">Today</p>
        <p class="text-3xl font-black text-white mt-2" style="font-family:'Sora',sans-serif">{{ stats.today }}</p>
        <p class="text-xs text-gray-500">New messages today</p>
      </div>
      <div class="admin-stat-card">
        <p class="text-xs text-gray-500 uppercase tracking-widest">Filtered</p>
        <p class="text-3xl font-black text-white mt-2" style="font-family:'Sora',sans-serif">{{ stats.filtered }}</p>
        <p class="text-xs text-gray-500">Current result set</p>
      </div>
    </div>

    <div class="glass-card p-5 mb-6">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-end">
        <div class="lg:col-span-4">
          <label class="block text-xs text-gray-500 uppercase tracking-widest mb-2">Search</label>
          <input
            v-model="localFilters.q"
            type="text"
            placeholder="Name, email, subject, message"
            class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm
                   focus:outline-none focus:border-accent transition-colors"
            @keyup.enter="applyFilters"
          />
        </div>

        <div class="lg:col-span-2">
          <label class="block text-xs text-gray-500 uppercase tracking-widest mb-2">Source</label>
          <select v-model="localFilters.source" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-3 py-2.5 text-white text-sm focus:outline-none focus:border-accent transition-colors">
            <option value="">All sources</option>
            <option value="home">Homepage</option>
            <option value="contact">Contact page</option>
          </select>
        </div>

        <div class="lg:col-span-2">
          <label class="block text-xs text-gray-500 uppercase tracking-widest mb-2">Locale</label>
          <select v-model="localFilters.locale" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-3 py-2.5 text-white text-sm focus:outline-none focus:border-accent transition-colors">
            <option value="">All locales</option>
            <option value="en">English</option>
            <option value="id">Bahasa Indonesia</option>
          </select>
        </div>

        <div class="lg:col-span-2">
          <label class="block text-xs text-gray-500 uppercase tracking-widest mb-2">Read status</label>
          <select v-model="localFilters.read" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-3 py-2.5 text-white text-sm focus:outline-none focus:border-accent transition-colors">
            <option value="">All</option>
            <option value="unread">Unread</option>
            <option value="read">Read</option>
          </select>
        </div>

        <div class="lg:col-span-2">
          <label class="block text-xs text-gray-500 uppercase tracking-widest mb-2">Sort</label>
          <select v-model="localFilters.sort" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-3 py-2.5 text-white text-sm focus:outline-none focus:border-accent transition-colors">
            <option value="latest">Latest first</option>
            <option value="oldest">Oldest first</option>
          </select>
        </div>
      </div>

      <div class="flex flex-wrap gap-3 mt-4">
        <button @click="applyFilters" class="btn-primary text-sm px-4 py-2">Apply Filters</button>
        <button @click="resetFilters" class="btn-secondary text-sm px-4 py-2">Reset</button>
        <a :href="exportHref" class="text-sm px-4 py-2 rounded-lg border border-accent/30 text-accent hover:bg-accent/10 transition-colors">
          Export CSV
        </a>
      </div>
    </div>

    <div v-if="selectedIds.length > 0" class="mb-4 flex items-center justify-between rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3">
      <p class="text-sm text-red-300">{{ selectedIds.length }} submission(s) selected.</p>
      <button @click="bulkDelete" class="text-sm font-semibold text-red-300 hover:text-red-200 transition-colors">Delete Selected</button>
    </div>

    <div class="glass-card overflow-hidden">
      <div v-if="submissions.data.length === 0" class="py-14 text-center text-gray-500 text-sm">
        No submissions found for this filter set.
      </div>

      <table v-else class="w-full text-sm">
        <thead class="border-b border-gray-800 bg-gray-900/50">
          <tr>
            <th class="py-3 px-4 w-10">
              <input type="checkbox" class="rounded border-gray-600 bg-gray-900 text-accent focus:ring-accent" :checked="allOnPageSelected" @change="toggleSelectAll" />
            </th>
            <th class="text-left py-3 px-3 text-xs text-gray-500 uppercase tracking-widest">Sender</th>
            <th class="text-left py-3 px-3 text-xs text-gray-500 uppercase tracking-widest hidden md:table-cell">Subject</th>
            <th class="text-left py-3 px-3 text-xs text-gray-500 uppercase tracking-widest hidden lg:table-cell">Source</th>
            <th class="text-left py-3 px-3 text-xs text-gray-500 uppercase tracking-widest">Status</th>
            <th class="text-left py-3 px-3 text-xs text-gray-500 uppercase tracking-widest hidden xl:table-cell">Received</th>
            <th class="text-right py-3 px-4 text-xs text-gray-500 uppercase tracking-widest">Actions</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="item in submissions.data" :key="item.id" class="border-b border-gray-800/40 hover:bg-white/3 transition-colors">
            <td class="py-3 px-4">
              <input type="checkbox" class="rounded border-gray-600 bg-gray-900 text-accent focus:ring-accent" :value="item.id" v-model="selectedIds" />
            </td>
            <td class="py-3 px-3">
              <p class="text-white font-semibold truncate max-w-[220px]">{{ item.name }}</p>
              <p class="text-xs text-gray-400 truncate max-w-[220px]">{{ item.email }}</p>
            </td>
            <td class="py-3 px-3 hidden md:table-cell">
              <p class="text-gray-300 truncate max-w-[240px]">{{ item.subject }}</p>
              <p class="text-xs text-gray-500 truncate max-w-[240px]">{{ item.message }}</p>
            </td>
            <td class="py-3 px-3 hidden lg:table-cell">
              <div class="flex flex-col gap-1">
                <span class="text-xs w-fit px-2 py-0.5 rounded-full border border-gray-700 text-gray-300 bg-gray-800/70">
                  {{ item.source === 'home' ? 'Homepage CTA' : 'Contact Page' }}
                </span>
                <span class="text-xs w-fit px-2 py-0.5 rounded-full border border-gray-700 text-gray-400 bg-gray-800/40 uppercase">
                  {{ item.locale }}
                </span>
              </div>
            </td>
            <td class="py-3 px-3">
              <span :class="item.is_read ? 'bg-gray-700 text-gray-300 border-gray-600' : 'bg-accent/10 text-accent border-accent/20'" class="text-xs px-2 py-0.5 rounded-full border font-semibold">
                {{ item.is_read ? 'Read' : 'Unread' }}
              </span>
            </td>
            <td class="py-3 px-3 text-gray-500 text-xs hidden xl:table-cell">{{ formatDate(item.created_at) }}</td>
            <td class="py-3 px-4 text-right">
              <div class="inline-flex items-center gap-3">
                <button @click="openDetails(item)" class="text-xs text-accent hover:underline font-medium">View</button>
                <button @click="toggleRead(item)" class="text-xs text-blue-300 hover:underline font-medium">
                  {{ item.is_read ? 'Mark Unread' : 'Mark Read' }}
                </button>
                <button @click="deleteOne(item)" class="text-xs text-red-400 hover:underline font-medium">Delete</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-if="submissions.links && submissions.links.length > 3" class="mt-5 flex flex-wrap gap-2">
      <button
        v-for="(link, idx) in submissions.links"
        :key="idx"
        :disabled="!link.url"
        @click="goTo(link.url)"
        v-html="link.label"
        class="px-3 py-1.5 text-xs rounded-lg border transition-colors"
        :class="link.active
          ? 'border-accent bg-accent text-[#0A0A0A] font-bold'
          : 'border-gray-700 text-gray-300 hover:border-accent/40 hover:text-white disabled:opacity-40 disabled:cursor-not-allowed'"
      />
    </div>

    <Teleport to="body">
      <div v-if="detailItem" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4" @click.self="detailItem = null">
        <div class="glass-card w-full max-w-2xl p-6 md:p-7 space-y-5 max-h-[90vh] overflow-y-auto">
          <div class="flex items-start justify-between gap-4">
            <div>
              <h3 class="text-xl font-bold text-white">{{ detailItem.subject }}</h3>
              <p class="text-xs text-gray-500 mt-1">From {{ detailItem.name }} ({{ detailItem.email }})</p>
            </div>
            <button @click="detailItem = null" class="text-gray-400 hover:text-white">✕</button>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
            <div class="rounded-lg bg-gray-900/70 border border-gray-800 p-3">
              <p class="text-gray-500 uppercase tracking-widest">Source</p>
              <p class="text-gray-200 mt-1">{{ detailItem.source === 'home' ? 'Homepage CTA' : 'Contact Page' }}</p>
            </div>
            <div class="rounded-lg bg-gray-900/70 border border-gray-800 p-3">
              <p class="text-gray-500 uppercase tracking-widest">Locale</p>
              <p class="text-gray-200 mt-1 uppercase">{{ detailItem.locale }}</p>
            </div>
            <div class="rounded-lg bg-gray-900/70 border border-gray-800 p-3">
              <p class="text-gray-500 uppercase tracking-widest">Received</p>
              <p class="text-gray-200 mt-1">{{ formatDate(detailItem.created_at) }}</p>
            </div>
            <div class="rounded-lg bg-gray-900/70 border border-gray-800 p-3">
              <p class="text-gray-500 uppercase tracking-widest">IP Address</p>
              <p class="text-gray-200 mt-1">{{ detailItem.ip_address || 'N/A' }}</p>
            </div>
          </div>

          <div class="rounded-lg bg-gray-900/70 border border-gray-800 p-4">
            <p class="text-xs text-gray-500 uppercase tracking-widest mb-2">Message</p>
            <p class="text-sm text-gray-200 whitespace-pre-wrap leading-relaxed">{{ detailItem.message }}</p>
          </div>

          <div class="flex flex-wrap items-center justify-end gap-3">
            <button @click="toggleRead(detailItem)" class="text-sm px-4 py-2 rounded-lg border border-blue-400/40 text-blue-300 hover:bg-blue-500/10 transition-colors">
              {{ detailItem.is_read ? 'Mark Unread' : 'Mark Read' }}
            </button>
            <button @click="deleteOne(detailItem)" class="text-sm px-4 py-2 rounded-lg border border-red-500/40 text-red-300 hover:bg-red-500/10 transition-colors">
              Delete
            </button>
          </div>
        </div>
      </div>
    </Teleport>
  </AdminLayout>
</template>

<script setup>
import { computed, ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
  submissions: { type: Object, required: true },
  filters: { type: Object, required: true },
  stats: { type: Object, required: true },
});

const localFilters = ref({
  q: props.filters.q || '',
  source: props.filters.source || '',
  locale: props.filters.locale || '',
  read: props.filters.read || '',
  sort: props.filters.sort || 'latest',
  per_page: props.filters.per_page || 15,
});

const selectedIds = ref([]);
const detailItem = ref(null);

const allOnPageSelected = computed(() => {
  if (!props.submissions.data.length) return false;
  const ids = props.submissions.data.map((row) => row.id);
  return ids.every((id) => selectedIds.value.includes(id));
});

const exportHref = computed(() => {
  const clean = buildCleanFilters();
  return route('contact-submissions.export', clean);
});

function buildCleanFilters() {
  const clean = {
    q: localFilters.value.q?.trim() || undefined,
    source: localFilters.value.source || undefined,
    locale: localFilters.value.locale || undefined,
    read: localFilters.value.read || undefined,
    sort: localFilters.value.sort || undefined,
    per_page: localFilters.value.per_page || undefined,
  };

  Object.keys(clean).forEach((key) => {
    if (clean[key] === undefined || clean[key] === '') {
      delete clean[key];
    }
  });

  return clean;
}

function applyFilters() {
  router.get(route('contact-submissions.index'), buildCleanFilters(), {
    preserveState: true,
    preserveScroll: true,
    replace: true,
    onSuccess: () => {
      selectedIds.value = [];
    },
  });
}

function resetFilters() {
  localFilters.value = {
    q: '',
    source: '',
    locale: '',
    read: '',
    sort: 'latest',
    per_page: 15,
  };
  applyFilters();
}

function goTo(url) {
  if (!url) return;
  router.visit(url, { preserveState: true, preserveScroll: true });
}

function toggleSelectAll(event) {
  if (event.target.checked) {
    selectedIds.value = props.submissions.data.map((row) => row.id);
    return;
  }
  selectedIds.value = [];
}

function openDetails(item) {
  detailItem.value = item;
}

function toggleRead(item) {
  router.patch(route('contact-submissions.read', item.id), {
    is_read: !item.is_read,
  }, {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => {
      if (detailItem.value?.id === item.id) {
        detailItem.value = null;
      }
    },
  });
}

function deleteOne(item) {
  if (!confirm(`Delete submission from ${item.name}? This action cannot be undone.`)) {
    return;
  }

  router.delete(route('contact-submissions.destroy', item.id), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => {
      if (detailItem.value?.id === item.id) {
        detailItem.value = null;
      }
      selectedIds.value = selectedIds.value.filter((id) => id !== item.id);
    },
  });
}

function bulkDelete() {
  if (!selectedIds.value.length) return;

  if (!confirm(`Delete ${selectedIds.value.length} selected submission(s)? This action cannot be undone.`)) {
    return;
  }

  router.delete(route('contact-submissions.bulk-destroy'), {
    data: { ids: selectedIds.value },
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => {
      selectedIds.value = [];
      detailItem.value = null;
    },
  });
}

function formatDate(value) {
  if (!value) return 'N/A';
  return new Date(value).toLocaleString('en-GB', {
    day: '2-digit',
    month: 'short',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
  });
}
</script>
