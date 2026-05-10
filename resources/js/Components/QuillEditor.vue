<template>
  <div class="quill-dark-wrapper bg-gray-900 border border-gray-700 rounded-lg overflow-hidden">
    <QuillEditor
      v-model:content="content"
      contentType="html"
      theme="snow"
      :toolbar="toolbarOptions"
      class="text-white min-h-[300px]"
      @update:content="updateValue"
    />
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const props = defineProps({
  modelValue: { type: String, default: '' },
});
const emit = defineEmits(['update:modelValue']);

const content = ref(props.modelValue);

const updateValue = () => {
  emit('update:modelValue', content.value);
};

watch(() => props.modelValue, (newVal) => {
  if (newVal !== content.value) {
    content.value = newVal;
  }
});

const toolbarOptions = [
  ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
  ['blockquote', 'code-block'],

  [{ 'header': 1 }, { 'header': 2 }],               // custom button values
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
  [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
  [{ 'direction': 'rtl' }],                         // text direction

  [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  [{ 'font': [] }],
  [{ 'align': [] }],

  ['clean'],                                         // remove formatting button
  ['link', 'image', 'video']                         // link and image, video
];
</script>

<style>
/* Dark theme overrides for Quill */
.quill-dark-wrapper .ql-toolbar.ql-snow {
  border: none;
  border-bottom: 1px solid #374151; /* gray-700 */
  background: #1f2937; /* gray-800 */
}
.quill-dark-wrapper .ql-container.ql-snow {
  border: none;
  font-family: inherit;
  font-size: 14px;
}
.quill-dark-wrapper .ql-editor {
  min-height: 300px;
  color: #f3f4f6; /* gray-100 */
}
.quill-dark-wrapper .ql-editor.ql-blank::before {
  color: #6b7280; /* gray-500 */
}
.quill-dark-wrapper .ql-snow .ql-picker,
.quill-dark-wrapper .ql-snow .ql-stroke {
  color: #d1d5db;
  stroke: #d1d5db;
}
.quill-dark-wrapper .ql-snow .ql-fill {
  fill: #d1d5db;
}
.quill-dark-wrapper .ql-snow .ql-picker-options {
  background: #1f2937;
  border-color: #374151;
}
</style>
