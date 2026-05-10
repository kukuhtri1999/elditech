<template>
  <div>
    <label v-if="label" :for="id"
           class="block text-xs text-gray-400 uppercase tracking-widest mb-1.5 font-semibold">
      {{ label }}
    </label>
    <slot />
  </div>
</template>

<script setup>
defineProps({
  label: String,
  id: String,
});
</script>
