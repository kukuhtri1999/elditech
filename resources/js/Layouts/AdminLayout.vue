<template>
  <div class="min-h-screen bg-[#0A0A0A] text-white font-sans flex">
    <!-- Sidebar -->
    <aside
      class="w-64 min-h-screen flex-shrink-0 border-r border-gray-800/70
             backdrop-blur-md bg-gray-900/40 flex flex-col fixed top-0 left-0 z-40"
    >
      <!-- Logo -->
      <div class="px-6 py-5 border-b border-gray-800/70">
        <Link :href="route('dashboard')" class="flex items-center gap-2">
          <span class="text-xl font-black tracking-tighter text-accent">ELDITECH</span>
          <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest
                       bg-gray-800 px-2 py-0.5 rounded">Admin</span>
        </Link>
      </div>

      <!-- Nav Links -->
      <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
        <p class="text-[10px] font-semibold text-gray-600 uppercase tracking-widest px-4 mb-2">
          Overview
        </p>
        <Link :href="route('dashboard')"
              :class="['admin-sidebar-link', isRoute('dashboard') && 'active']">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
          Dashboard
        </Link>

        <p class="text-[10px] font-semibold text-gray-600 uppercase tracking-widest px-4 mt-4 mb-2">
          Content
        </p>
        <Link :href="route('posts.index')"
              :class="['admin-sidebar-link', isRoute('posts.index', 'posts.create', 'posts.edit') && 'active']">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          Posts / Projects
        </Link>

        <Link :href="route('contact-submissions.index')"
              :class="['admin-sidebar-link', isRoute('contact-submissions.index') && 'active']">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M7 8h10M7 12h6m-6 4h10M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
          </svg>
          Contact Submissions
        </Link>

        <p class="text-[10px] font-semibold text-gray-600 uppercase tracking-widest px-4 mt-4 mb-2">
          Account
        </p>
        <Link :href="route('profile.edit')"
              :class="['admin-sidebar-link', isRoute('profile.edit') && 'active']">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
          Profile
        </Link>

        <button @click="logout"
                class="admin-sidebar-link w-full text-red-400 hover:text-red-300 hover:bg-red-900/10 mt-2">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
          </svg>
          Sign Out
        </button>
      </nav>

      <!-- User tag -->
      <div class="p-4 border-t border-gray-800/70">
        <div class="flex items-center gap-3 px-2">
          <div class="w-8 h-8 rounded-full bg-accent/20 border border-accent/30 flex items-center
                       justify-center text-accent font-bold text-sm">
            {{ userInitial }}
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-white truncate">{{ $page.props.auth.user.name }}</p>
            <p class="text-xs text-gray-500 truncate">{{ $page.props.auth.user.email }}</p>
          </div>
        </div>
      </div>
    </aside>

    <!-- Main content area -->
    <div class="flex-1 ml-64 flex flex-col min-h-screen">
      <!-- Top bar -->
      <header class="sticky top-0 z-30 border-b border-gray-800/70 bg-[#0A0A0A]/90
                     backdrop-blur-md px-8 py-4 flex items-center justify-between">
        <div>
          <h1 class="text-lg font-bold text-white">{{ title }}</h1>
          <p v-if="subtitle" class="text-xs text-gray-500 mt-0.5">{{ subtitle }}</p>
        </div>
        <div class="flex items-center gap-3">
          <Link :href="route('home', { locale: 'en' })" target="_blank"
                class="text-xs text-gray-400 hover:text-accent transition-colors flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
            View Site
          </Link>
        </div>
      </header>

      <!-- Flash messages -->
      <div v-if="flash.success || flash.error" class="px-8 pt-4">
        <div v-if="flash.success"
             class="flex items-center gap-3 bg-accent/10 border border-accent/30 text-accent
                    rounded-lg px-4 py-3 text-sm font-medium">
          <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          {{ flash.success }}
        </div>
        <div v-if="flash.error"
             class="flex items-center gap-3 bg-red-500/10 border border-red-500/30 text-red-400
                    rounded-lg px-4 py-3 text-sm font-medium">
          <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          {{ flash.error }}
        </div>
      </div>

      <!-- Page slot -->
      <main class="flex-1 p-8">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';

defineProps({
  title: { type: String, default: 'Dashboard' },
  subtitle: { type: String, default: '' },
});

const page = usePage();

const flash = computed(() => page.props.flash || {});
const userInitial = computed(() =>
  (page.props.auth?.user?.name || 'A').charAt(0).toUpperCase()
);

function isRoute(...names) {
  const current = page.props.currentRouteName;
  return names.some(n => current === n || current?.startsWith(n));
}

function logout() {
  router.post(route('logout'));
}
</script>
