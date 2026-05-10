<template>
  <Head title="Edit Post" />
  <AdminLayout title="Edit Post" subtitle="Update bilingual content — EN + ID">
    <PostForm :post="post" :is-editing="true" />
  </AdminLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import PostForm from '@/Components/PostForm.vue';

defineProps({ post: Object });
</script>
