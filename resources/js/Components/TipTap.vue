<template>
  <div class="border border-gray-700 rounded-lg overflow-hidden bg-gray-900/60">
    <!-- Toolbar -->
    <div v-if="editor" class="bg-gray-800/80 px-3 py-2 flex flex-wrap gap-1 border-b border-gray-700">
      <ToolBtn @click="editor.chain().focus().toggleBold().run()" :active="editor.isActive('bold')" title="Bold">
        <strong>B</strong>
      </ToolBtn>
      <ToolBtn @click="editor.chain().focus().toggleItalic().run()" :active="editor.isActive('italic')" title="Italic">
        <em>I</em>
      </ToolBtn>
      <ToolBtn @click="editor.chain().focus().toggleStrike().run()" :active="editor.isActive('strike')" title="Strikethrough">
        <s>S</s>
      </ToolBtn>
      <div class="w-px bg-gray-700 mx-1 self-stretch" />
      <ToolBtn @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :active="editor.isActive('heading', { level: 1 })" title="Heading 1">H1</ToolBtn>
      <ToolBtn @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :active="editor.isActive('heading', { level: 2 })" title="Heading 2">H2</ToolBtn>
      <ToolBtn @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :active="editor.isActive('heading', { level: 3 })" title="Heading 3">H3</ToolBtn>
      <div class="w-px bg-gray-700 mx-1 self-stretch" />
      <ToolBtn @click="editor.chain().focus().toggleBulletList().run()" :active="editor.isActive('bulletList')" title="Bullet List">• List</ToolBtn>
      <ToolBtn @click="editor.chain().focus().toggleOrderedList().run()" :active="editor.isActive('orderedList')" title="Numbered List">1. List</ToolBtn>
      <ToolBtn @click="editor.chain().focus().toggleBlockquote().run()" :active="editor.isActive('blockquote')" title="Blockquote">"</ToolBtn>
      <ToolBtn @click="editor.chain().focus().toggleCodeBlock().run()" :active="editor.isActive('codeBlock')" title="Code Block">&lt;/&gt;</ToolBtn>
      <div class="w-px bg-gray-700 mx-1 self-stretch" />
      <ToolBtn @click="editor.chain().focus().undo().run()" :disabled="!editor.can().undo()" title="Undo">↩</ToolBtn>
      <ToolBtn @click="editor.chain().focus().redo().run()" :disabled="!editor.can().redo()" title="Redo">↪</ToolBtn>
    </div>

    <!-- Editor content area -->
    <editor-content
      :editor="editor"
      class="tiptap-editor px-4 py-3 min-h-[250px] text-white text-sm leading-relaxed focus:outline-none" />

    <!-- Word count -->
    <div v-if="editor" class="px-4 py-1.5 bg-gray-800/40 border-t border-gray-700/50 flex justify-between">
      <span class="text-xs text-gray-600">
        {{ editor.storage.characterCount?.words?.() || wordCount }} {{ wordCount === 1 ? 'word' : 'words' }}
      </span>
      <span class="text-xs text-gray-600">
        {{ editor.getText().length }} chars
      </span>
    </div>
  </div>
</template>

<script setup>
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import { watch, onBeforeUnmount, computed } from 'vue';

const props = defineProps({
  modelValue: { type: String, default: '' },
});
const emit = defineEmits(['update:modelValue']);

// Inline ToolBtn component
const ToolBtn = {
  props: { active: Boolean, disabled: Boolean, title: String },
  emits: ['click'],
  template: `
    <button type="button" @click="$emit('click')" :title="title"
            :disabled="disabled"
            :class="[active
              ? 'bg-accent text-[#0A0A0A] font-bold'
              : 'text-gray-300 hover:text-white hover:bg-gray-700',
              disabled ? 'opacity-30 cursor-not-allowed' : '',
              'px-2 py-1 rounded text-xs transition-all min-w-[28px] text-center']">
      <slot />
    </button>
  `,
};

const editor = useEditor({
  content: props.modelValue,
  extensions: [StarterKit],
  editorProps: {
    attributes: {
      class: 'prose prose-invert prose-sm max-w-none focus:outline-none min-h-[220px]',
    },
  },
  onUpdate: () => {
    emit('update:modelValue', editor.value.getHTML());
  },
});

const wordCount = computed(() => {
  if (!editor.value) return 0;
  const text = editor.value.getText();
  return text.trim() ? text.trim().split(/\s+/).length : 0;
});

watch(() => props.modelValue, (value) => {
  if (!editor.value) return;
  const isSame = editor.value.getHTML() === value;
  if (!isSame) editor.value.commands.setContent(value || '', false);
});

onBeforeUnmount(() => { if (editor.value) editor.value.destroy(); });
</script>

<style>
.tiptap-editor .ProseMirror { outline: none; }
.tiptap-editor .ProseMirror p { margin-bottom: 0.75em; }
.tiptap-editor .ProseMirror h1 { font-size: 1.5em; font-weight: 800; margin-bottom: 0.5em; color: white; }
.tiptap-editor .ProseMirror h2 { font-size: 1.25em; font-weight: 700; margin-bottom: 0.5em; color: white; }
.tiptap-editor .ProseMirror h3 { font-size: 1.1em; font-weight: 600; margin-bottom: 0.4em; color: white; }
.tiptap-editor .ProseMirror ul { list-style: disc; padding-left: 1.5em; }
.tiptap-editor .ProseMirror ol { list-style: decimal; padding-left: 1.5em; }
.tiptap-editor .ProseMirror li { margin-bottom: 0.25em; }
.tiptap-editor .ProseMirror blockquote { border-left: 3px solid #9DFF20; padding-left: 1em; color: #9ca3af; font-style: italic; }
.tiptap-editor .ProseMirror code { background: rgba(157,255,32,0.1); border-radius: 4px; padding: 0.1em 0.4em; font-size: 0.85em; color: #9DFF20; }
.tiptap-editor .ProseMirror pre { background: #111; border-radius: 8px; padding: 1em; overflow-x: auto; }
.tiptap-editor .ProseMirror pre code { background: transparent; padding: 0; color: #9DFF20; }
.tiptap-editor .ProseMirror strong { color: white; }
.tiptap-editor .ProseMirror em { color: #d1d5db; }
</style>
