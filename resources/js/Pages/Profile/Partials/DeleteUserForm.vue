<template>
  <div class="space-y-4">
    <p class="text-sm text-gray-400">
      Once your account is deleted, all resources and data will be permanently removed.
      This action cannot be undone.
    </p>

    <button @click="confirmingDeletion = true"
            class="px-5 py-2.5 bg-red-500/10 border border-red-500/30 text-red-400 font-semibold
                   rounded-lg hover:bg-red-500/20 transition-all text-sm">
      Delete Account
    </button>

    <!-- Confirm Modal -->
    <Teleport to="body">
      <div v-if="confirmingDeletion"
           class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm">
        <div class="glass-card p-8 max-w-sm w-full mx-4 space-y-5">
          <h3 class="text-lg font-bold text-white">Are you absolutely sure?</h3>
          <p class="text-gray-400 text-sm">
            This will permanently delete your account. Enter your password to confirm.
          </p>
          <div>
            <input ref="passwordInput" v-model="form.password" type="password"
                   class="w-full bg-gray-900/80 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm
                          focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors"
                   placeholder="Your password" @keyup.enter="deleteUser" />
            <p v-if="form.errors.password" class="text-red-400 text-xs mt-1">{{ form.errors.password }}</p>
          </div>
          <div class="flex gap-3 justify-end">
            <button @click="closeModal"
                    class="px-4 py-2 text-sm text-gray-400 hover:text-white transition-colors">Cancel</button>
            <button @click="deleteUser" :disabled="form.processing"
                    class="px-4 py-2 text-sm bg-red-500 text-white font-bold rounded-lg hover:bg-red-600 transition-colors disabled:opacity-50">
              {{ form.processing ? 'Deleting…' : 'Delete Account' }}
            </button>
          </div>
        </div>
      </div>
    </Teleport>
  </div>
</template>

<script setup>
import { ref, nextTick } from 'vue';
import { useForm } from '@inertiajs/vue3';

const confirmingDeletion = ref(false);
const passwordInput = ref(null);
const form = useForm({ password: '' });

function confirmDeletion() {
  confirmingDeletion.value = true;
  nextTick(() => passwordInput.value?.focus());
}

function deleteUser() {
  form.delete(route('profile.destroy'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value?.focus(),
    onFinish: () => form.reset(),
  });
}

function closeModal() {
  confirmingDeletion.value = false;
  form.clearErrors();
  form.reset();
}
</script>
