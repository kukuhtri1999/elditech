<template>
  <Head title="Profile Settings — ELDITECH Admin" />
  <AdminLayout title="Profile Settings" subtitle="Manage your account information and security">

    <div class="max-w-3xl space-y-6">

      <!-- Update Profile Info -->
      <div class="glass-card p-8">
        <h2 class="text-lg font-bold text-white mb-1">Profile Information</h2>
        <p class="text-sm text-gray-400 mb-6">Update your name and email address.</p>

        <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" />
      </div>

      <!-- Update Password -->
      <div class="glass-card p-8">
        <h2 class="text-lg font-bold text-white mb-1">Change Password</h2>
        <p class="text-sm text-gray-400 mb-6">Ensure your account uses a strong, unique password.</p>

        <UpdatePasswordForm />
      </div>

      <!-- Danger Zone -->
      <div class="glass-card p-8 border-red-500/20">
        <h2 class="text-lg font-bold text-red-400 mb-1">Danger Zone</h2>
        <p class="text-sm text-gray-400 mb-6">Once you delete your account, there is no going back. Please be certain.</p>

        <DeleteUserForm />
      </div>
    </div>

  </AdminLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

defineProps({ mustVerifyEmail: Boolean, status: String });
</script>
