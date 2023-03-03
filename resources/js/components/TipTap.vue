<template>
  <div class="editor">
    <!-- buttons - need bold, italic, underline, bullet points-->
    <div class="d-flex my-2" style="flex-flow: row wrap; justify-content:flex-start; align-items: stretch; gap: 5px">
      <button @click="this.editor.chain().focus().toggleBold().run()"
              type="button"
              class="flex btn btn-outline-primary btn-control px-2 py-1"
              data-bs-toggle="button">
        bold
      </button>
      <button @click="editor.chain().focus().toggleItalic().run()"
              type="button"
              class="flex btn btn-outline-primary btn-control px-2 py-1"
              data-bs-toggle="button">
        italic
      </button>
      <button @click="editor.chain().focus().toggleUnderline().run()"
              type="button"
              class="flex btn btn-outline-primary btn-control px-2 py-1"
              data-bs-toggle="button">

        <!--        :class="{ 'btn-primary': editor ? editor.isActive('underline') : 'btn-danger' }"-->
        underline
      </button>
      <button @click="editor.chain().focus().toggleBulletList().run()"
              type="button"
              class="flex btn btn-outline-primary btn-control px-2 py-1"
              data-bs-toggle="button">
        •
      </button>
    </div>
    <editor-content :editor="editor"/>
  </div>
</template>

<script>
import {Editor, EditorContent} from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import Underline from '@tiptap/extension-underline'

export default {
  name: 'TipTap',

  components: {
    EditorContent,
  },

  props: {
    content: {
      type: String || Object || Array,
      default: '',
      required: false,
    },
  },

  data() {
    return {
      editor: null,
    }
  },

  mounted() {
    this.editor = new Editor({
      content: this.content,
      extensions: [
        StarterKit,
        Underline,
      ],
      editorProps: {
        attributes: {
          class: 'form-control',
        },
      },
    })
    this.editor.on('update', ({editor}) => {
      this.$emit('input', editor.getJSON())
    })
  },

  beforeUnmount() {
    this.editor.destroy()
  },
}
</script>
<style>

</style>