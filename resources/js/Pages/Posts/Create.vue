<template>
  <Head title="Create Post" />
  <AdminLayout title="Create New Post" subtitle="Write bilingual content — EN + ID">
    <PostForm :post="null" :is-editing="false" />
  </AdminLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import PostForm from '@/Components/PostForm.vue';
</script>
