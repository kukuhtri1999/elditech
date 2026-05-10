<template>
  <form @submit.prevent="form.put(route('password.update'))" class="space-y-5">
    <div>
      <label for="current_password" class="block text-xs text-gray-400 uppercase tracking-widest mb-1.5 font-semibold">Current Password</label>
      <input id="current_password" v-model="form.current_password" type="password" autocomplete="current-password"
             class="w-full bg-gray-900/80 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm
                    focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent transition-colors" />
      <p v-if="form.errors.current_password" class="text-red-400 text-xs mt-1">{{ form.errors.current_password }}</p>
    </div>
    <div>
      <label for="new_password" class="block text-xs text-gray-400 uppercase tracking-widest mb-1.5 font-semibold">New Password</label>
      <input id="new_password" v-model="form.password" type="password" autocomplete="new-password"
             class="w-full bg-gray-900/80 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm
                    focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent transition-colors" />
      <p v-if="form.errors.password" class="text-red-400 text-xs mt-1">{{ form.errors.password }}</p>
    </div>
    <div>
      <label for="password_confirmation" class="block text-xs text-gray-400 uppercase tracking-widest mb-1.5 font-semibold">Confirm New Password</label>
      <input id="password_confirmation" v-model="form.password_confirmation" type="password" autocomplete="new-password"
             class="w-full bg-gray-900/80 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm
                    focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent transition-colors" />
    </div>
    <div class="flex items-center gap-4 pt-2">
      <button type="submit" :disabled="form.processing"
              class="bg-accent text-[#0A0A0A] font-bold px-6 py-2.5 rounded-lg hover:bg-[#b0ff4d] transition-all text-sm disabled:opacity-50">
        {{ form.processing ? 'Updating…' : 'Update Password' }}
      </button>
      <Transition enter-active-class="transition" enter-from-class="opacity-0" leave-to-class="opacity-0">
        <span v-if="form.recentlySuccessful" class="text-accent text-sm">✓ Updated</span>
      </Transition>
    </div>
  </form>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3';
const form = useForm({ current_password: '', password: '', password_confirmation: '' });
</script>
