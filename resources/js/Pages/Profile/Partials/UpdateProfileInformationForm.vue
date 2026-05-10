<template>
  <form @submit.prevent="form.patch(route('profile.update'))" class="space-y-5">
    <div>
      <label for="name" class="block text-xs text-gray-400 uppercase tracking-widest mb-1.5 font-semibold">Name</label>
      <input id="name" v-model="form.name" type="text" required autofocus autocomplete="name"
             class="w-full bg-gray-900/80 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm
                    focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent transition-colors" />
      <p v-if="form.errors.name" class="text-red-400 text-xs mt-1">{{ form.errors.name }}</p>
    </div>

    <div>
      <label for="email" class="block text-xs text-gray-400 uppercase tracking-widest mb-1.5 font-semibold">Email</label>
      <input id="email" v-model="form.email" type="email" required autocomplete="username"
             class="w-full bg-gray-900/80 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm
                    focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent transition-colors" />
      <p v-if="form.errors.email" class="text-red-400 text-xs mt-1">{{ form.errors.email }}</p>
    </div>

    <div v-if="mustVerifyEmail && user.email_verified_at === null"
         class="bg-yellow-500/10 border border-yellow-500/20 rounded-lg px-4 py-3 text-sm text-yellow-400">
      Your email address is unverified.
      <Link :href="route('verification.send')" method="post" as="button" class="underline hover:text-yellow-300 ml-1">
        Resend verification email.
      </Link>
      <div v-show="status === 'verification-link-sent'" class="mt-2 text-accent text-xs">
        Verification link sent!
      </div>
    </div>

    <div class="flex items-center gap-4 pt-2">
      <button type="submit" :disabled="form.processing"
              class="bg-accent text-[#0A0A0A] font-bold px-6 py-2.5 rounded-lg hover:bg-[#b0ff4d]
                     transition-all text-sm disabled:opacity-50">
        {{ form.processing ? 'Saving…' : 'Save Changes' }}
      </button>
      <Transition enter-active-class="transition" enter-from-class="opacity-0" leave-to-class="opacity-0">
        <span v-if="form.recentlySuccessful" class="text-accent text-sm">✓ Saved</span>
      </Transition>
    </div>
  </form>
</template>

<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';
defineProps({ mustVerifyEmail: Boolean, status: String });
const user = usePage().props.auth.user;
const form = useForm({ name: user.name, email: user.email });
</script>
