<template>
  <Head title="Register — ELDITECH" />
  <GuestLayout>
    <div class="mb-6 text-center">
      <h1 class="text-2xl font-black text-white" style="font-family:'Sora',sans-serif">Create Account</h1>
      <p class="text-sm text-gray-400 mt-1">Register a new admin account</p>
    </div>

    <form @submit.prevent="submit" class="space-y-5">
      <div>
        <label for="name" class="block text-xs text-gray-400 uppercase tracking-widest mb-1.5 font-semibold">Full Name</label>
        <input id="name" v-model="form.name" type="text" required autofocus autocomplete="name"
               class="w-full bg-gray-900/80 border border-gray-700 rounded-lg px-4 py-3 text-white text-sm
                      focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent transition-colors placeholder-gray-600"
               placeholder="Your full name" />
        <p v-if="form.errors.name" class="text-red-400 text-xs mt-1">{{ form.errors.name }}</p>
      </div>

      <div>
        <label for="email" class="block text-xs text-gray-400 uppercase tracking-widest mb-1.5 font-semibold">Email</label>
        <input id="email" v-model="form.email" type="email" required autocomplete="username"
               class="w-full bg-gray-900/80 border border-gray-700 rounded-lg px-4 py-3 text-white text-sm
                      focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent transition-colors placeholder-gray-600"
               placeholder="admin@elditech.com" />
        <p v-if="form.errors.email" class="text-red-400 text-xs mt-1">{{ form.errors.email }}</p>
      </div>

      <div>
        <label for="password" class="block text-xs text-gray-400 uppercase tracking-widest mb-1.5 font-semibold">Password</label>
        <input id="password" v-model="form.password" type="password" required autocomplete="new-password"
               class="w-full bg-gray-900/80 border border-gray-700 rounded-lg px-4 py-3 text-white text-sm
                      focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent transition-colors placeholder-gray-600"
               placeholder="Min. 8 characters" />
        <p v-if="form.errors.password" class="text-red-400 text-xs mt-1">{{ form.errors.password }}</p>
      </div>

      <div>
        <label for="password_confirmation" class="block text-xs text-gray-400 uppercase tracking-widest mb-1.5 font-semibold">Confirm Password</label>
        <input id="password_confirmation" v-model="form.password_confirmation" type="password" required autocomplete="new-password"
               class="w-full bg-gray-900/80 border border-gray-700 rounded-lg px-4 py-3 text-white text-sm
                      focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent transition-colors placeholder-gray-600"
               placeholder="Repeat password" />
        <p v-if="form.errors.password_confirmation" class="text-red-400 text-xs mt-1">{{ form.errors.password_confirmation }}</p>
      </div>

      <button type="submit" :disabled="form.processing"
              class="w-full bg-accent text-[#0A0A0A] font-bold py-3 rounded-lg hover:bg-[#b0ff4d]
                     transition-all shadow-[0_0_20px_rgba(157,255,32,0.3)] disabled:opacity-50
                     disabled:cursor-not-allowed text-sm">
        {{ form.processing ? 'Creating account…' : 'Create Account' }}
      </button>

      <p class="text-center text-xs text-gray-500">
        Already have an account?
        <Link :href="route('login')" class="text-accent hover:underline">Sign in</Link>
      </p>
    </form>
  </GuestLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

const form = useForm({ name: '', email: '', password: '', password_confirmation: '' });
const submit = () => form.post(route('register'), { onFinish: () => form.reset('password', 'password_confirmation') });
</script>
