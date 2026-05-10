<template>
  <Head title="Sign In — ELDITECH" />
  <GuestLayout>
    <div class="mb-6 text-center">
      <h1 class="text-2xl font-black text-white" style="font-family:'Sora',sans-serif">Welcome Back</h1>
      <p class="text-sm text-gray-400 mt-1">Sign in to your admin account</p>
    </div>

    <div v-if="status" class="mb-4 text-sm font-medium text-accent bg-accent/10 border border-accent/20 rounded-lg px-4 py-3">
      {{ status }}
    </div>

    <form @submit.prevent="submit" class="space-y-5">
      <div>
        <label for="email" class="block text-xs text-gray-400 uppercase tracking-widest mb-1.5 font-semibold">Email</label>
        <input id="email" v-model="form.email" type="email" required autofocus autocomplete="username"
               class="w-full bg-gray-900/80 border border-gray-700 rounded-lg px-4 py-3 text-white text-sm
                      focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent transition-colors placeholder-gray-600"
               placeholder="admin@elditech.com" />
        <p v-if="form.errors.email" class="text-red-400 text-xs mt-1">{{ form.errors.email }}</p>
      </div>

      <div>
        <label for="password" class="block text-xs text-gray-400 uppercase tracking-widest mb-1.5 font-semibold">Password</label>
        <input id="password" v-model="form.password" type="password" required autocomplete="current-password"
               class="w-full bg-gray-900/80 border border-gray-700 rounded-lg px-4 py-3 text-white text-sm
                      focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent transition-colors placeholder-gray-600"
               placeholder="••••••••" />
        <p v-if="form.errors.password" class="text-red-400 text-xs mt-1">{{ form.errors.password }}</p>
      </div>

      <div class="flex items-center justify-between">
        <label class="flex items-center gap-2 cursor-pointer">
          <input type="checkbox" v-model="form.remember"
                 class="w-4 h-4 rounded border-gray-600 bg-gray-800 text-accent focus:ring-accent focus:ring-offset-0" />
          <span class="text-sm text-gray-400">Remember me</span>
        </label>
        <Link v-if="canResetPassword" :href="route('password.request')"
              class="text-xs text-accent hover:underline">Forgot password?</Link>
      </div>

      <button type="submit" :disabled="form.processing"
              class="w-full bg-accent text-[#0A0A0A] font-bold py-3 rounded-lg hover:bg-[#b0ff4d]
                     transition-all shadow-[0_0_20px_rgba(157,255,32,0.3)] disabled:opacity-50
                     disabled:cursor-not-allowed text-sm">
        {{ form.processing ? 'Signing in…' : 'Sign In' }}
      </button>
    </form>
  </GuestLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

defineProps({ canResetPassword: Boolean, status: String });

const form = useForm({ email: '', password: '', remember: false });
const submit = () => form.post(route('login'), { onFinish: () => form.reset('password') });
</script>
