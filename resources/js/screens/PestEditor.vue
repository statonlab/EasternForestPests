<template>
  <modal :xlarge="true" class="h-100">
    <form action="#" @submit.prevent="submit()" autocomplete="off">
      <modal-card>
        <modal-header>
          <modal-title v-if="pest">Update "{{ pest.title }}"</modal-title>
          <modal-title v-else>Pest Editor</modal-title>
          <close @click="$emit('close')"/>
        </modal-header>
        <modal-body class="bold-labels">
          <div class="form-group">
            <label class="form-label">{{ 'What chapter is this pest location in?' }}
              <required/>
            </label>
            <select class="form-select" v-model="form.chapter">
              <option disabled :value="null">{{ 'Select a chapter' }}</option>
              <option v-for="chapter in chapters" :value="chapter.id">
                {{ `Chapter ${chapter.id}: ${chapter.title}` }}
              </option>
            </select>
            <small class="form-text text-danger" v-if="form.errors.has('chapter')">
              {{ form.errors.first('chapter') }}
            </small>
          </div>

          <div class="form-group">
            <label class="form-label">{{ 'Is this an insect, a disease, or a complex of both?' }}
              <required/>
            </label>
            <select class="form-select" v-model="form.pestType">
              <option disabled :value="null">{{ 'Select an option' }}</option>
              <option value="insect">
                {{ `Insect` }}
              </option>
              <option value="disease">
                {{ `Disease` }}
              </option>
              <option value="both">
                {{ `Both` }}
              </option>
            </select>
            <small class="form-text text-danger" v-if="form.errors.has('pestType')">
              {{ form.errors.first('pestType') }}
            </small>
          </div>

          <div class="form-group">
            <label class="form-label">{{ 'Does this pest affect deciduous trees, conifer, or both?' }}
              <required/>
            </label>
            <select class="form-select" v-model="form.treeAffected">
              <option disabled :value="null">{{ 'Select a chapter' }}</option>
              <option value="deciduous">
                {{ `Insect` }}
              </option>
              <option value="conifer">
                {{ `Disease` }}
              </option>
              <option value="both">
                {{ `Both` }}
              </option>
            </select>
            <small class="form-text text-danger" v-if="form.errors.has('pestType')">
              {{ form.errors.first('pestType') }}
            </small>
          </div>

          <div class="form-group">
            <label class="form-label">{{ 'Where is this pest visible?' }}
              <required/>
            </label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="rootsCheckbox"
                     v-model="form.visible_in_roots">
              Roots
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="trunkCheckbox" v-model="form.visible_in_trunk">
              Stem/Trunk
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="foliageCheckbox"
                     v-model="form.visible_in_foliage">
              Foliage
            </div>
          </div>

          <div class="form-group">
            <label for="common_name">
              Common name(s)
              <required/>
            </label>
            <div class="mb-2 d-flex input-group" style="flex-direction: row"
                 v-for="(common_name, index) in form.common_names">
              <button v-if="index !== 0" class="btn btn-outline-danger" type="button"
                      :id="`remove_common_name_button_${index}`"
                      @click.prevent="form.common_names.splice(index,1)">
                <ion-icon name="close-outline"></ion-icon>
              </button>
              <input v-model="form.common_names[index]"
                     :key="index"
                     :id="`common_name_${index}`"
                     :name="`common_name_${index}`"
                     type="text"
                     class="form-control"
                      ref="common_name">
            </div>
            <button class="btn btn-outline-primary" @click.prevent="addCommonName()">
              <ion-icon name="add-outline"></ion-icon>
              <span> Add another common name</span>
            </button>
            <small class="form-text text-danger" v-if="form.errors.has('common_names')">
              {{ form.errors.first('common_names') }}
            </small>
          </div>

          <div class="form-group">
            <label for="common_name">
              Scientific name(s)
              <required/>
            </label>
            <div class="mb-2 d-flex input-group" style="flex-direction: row"
                 v-for="(scientific_name, index) in form.scientific_names">
              <button v-if="index !== 0" class="btn btn-outline-danger" type="button"
                      :id="`remove_scientific_name_button_${index}`"
                      @click.prevent="form.scientific_names.splice(index,1)">
                <ion-icon name="close-outline"></ion-icon>
              </button>
              <input v-model="form.scientific_names[index]"
                     :key="index"
                     :id="`scientific_name_${index}`"
                     :name="`scientific_name_${index}`"
                     type="text"
                     class="form-control"
                     ref="scientific_name">
            </div>
            <button class="btn btn-outline-primary" @click.prevent="addScientificName()">
              <ion-icon name="add-outline"></ion-icon>
              <span> Add another scientific name</span>
            </button>
            <small class="form-text text-danger" v-if="form.errors.has('scientific_names')">
              {{ form.errors.first('scientific_names') }}
            </small>
          </div>

          <div class="form-group">
            <label>
              Text
            </label>
            <!--            <editor id="text"-->
            <!--                    ref="editor"-->
            <!--                    height="600px"-->
            <!--                    initialEditType="wysiwyg"-->
            <!--                    :initialValue="post ? post.text : ''"-->
            <!--                    :options="editorOptions"-->
            <!--            />-->
            <span class="form-text text-danger" v-if="form.errors.has('editor')">
              {{ form.errors.first('editor') }}
            </span>
          </div>
<!--          <editor-content :editor="form.editor" />-->

        </modal-body>
        <modal-footer>
          <button type="submit" class="btn btn-primary" :disabled="loading">
            <inline-spinner v-if="loading"/>
            <span>Save</span>
          </button>
          <button type="button" class="btn btn-light ms-auto" @click="$emit('close')">
            <span>Cancel</span>
          </button>
        </modal-footer>
      </modal-card>
    </form>
  </modal>
</template>

<script>
import Form from "../components/helpers/Form";
import User from "../components/helpers/User";
import InlineSpinner from "../components/helpers/InlineSpinner.vue";
import axios from "axios";
import modal from "../components/helpers/Modal.vue";
import modalHeader from "../components/helpers/ModalHeader.vue";
import modalTitle from "../components/helpers/ModalTitle.vue";
import modalCard from "../components/helpers/ModalCard.vue";
import modalBody from "../components/helpers/ModalBody.vue";
import modalFooter from "../components/helpers/ModalFooter.vue";
import close from "../components/helpers/Close.vue";
import required from "../components/helpers/Required.vue";
import ChapterSelect from "./ChapterSelect.vue";
import icon from "../components/helpers/Icon.vue";
// import { Editor, EditorContent } from '@tiptap/vue-3'
// import StarterKit from '@tiptap/starter-kit'
import TipTip from "../components/TipTip.vue";


export default {
  name: 'PestEditor',

  components: {
    icon,
    ChapterSelect,
    InlineSpinner,
    modal,
    modalHeader,
    modalTitle,
    modalCard,
    modalBody,
    modalFooter,
    close,
    required,
    TipTip,
    // Editor,
    // EditorContent
  },

  props: {
    pest: {required: false, default: null, type: Object},
  },

  data() {
    return {
      user: User,
      loading: true,
      chapters: null,
      // pest: null,
      form: new Form({
        chapter: null,
        pestType: null,
        isPest: false,
        isDisease: false,
        treeAffected: null,
        affectsDeciduous: false,
        affectsConifer: false,
        visible_in_roots: false,
        visible_in_trunk: false,
        visible_in_foliage: false,
        common_names: [''],
        scientific_names: [''],
        // editor: null,
      }),
    }
  },

  mounted() {
    this.loadPest()
    this.loadChapters()

    // this.editor = new Editor({
    //   content: '<p>I’m running Tiptap with Vue.js. 🎉</p>',
    //   extensions: [
    //     StarterKit,
    //   ],
    // })
  },

  // beforeUnmount() {
  //   this.editor.destroy()
  // },

  methods: {
    async loadPest() {
      const {id} = this.$route.params
      if (id) {
        try {
          const {data} = await axios.get(`/web/pests/${id}`)
          this.pest = data
        } catch (e) {
          console.error(e)
        }
      }
      this.loading = false
    },

    // loadChapters() {
    //   this.loading = true
    //   axios.get(`/chapters`)
    //       .then(({data}) => {
    //         this.chapters = data
    //       })
    //       .catch(e => {
    //         console.error(e)
    //       })
    //       .finally(() => {
    //         this.loading = false
    //       })
    // },

    async loadChapters() {
      try {
        const {data} = await axios.get(`/chapters`)
        this.chapters = data
      } catch (e) {
        console.error(e)
      }
      this.loading = false
    },

    async togglePublic(pest) {
      this.loading = true
      try {
        const {data} = await axios.put(`/web/pests/${pest.id}/public`)
        this.pest = data
        this.$notify({
          text: this.pest.is_public ? 'pest published successfully' : 'pest un-published successfully',
          type: 'success',
        })
        this.$emit('update', data)
      } catch (e) {
        if (!e.response || e.response.status !== 422) {
          this.$notify({
            text: 'Could not process your request at this time. please try refreshing the page.',
            type: 'error',
          })
        }
        console.error(e)
      }
      this.loading = false
    },

    updated() {
      this.loading = true
      this.loadPest()
    },

    addCommonName() {
      this.form.common_names.push('')
      var index = this.form.common_names.length - 1

      this.$nextTick(() => {
        this.$refs.common_name[index].focus()
      })
    },

    addScientificName() {
      this.form.scientific_names.push('')
      var index = this.form.scientific_names.length - 1

      this.$nextTick(() => {
        this.$refs.scientific_name[index].focus()
      })
    },
  },
}
</script>

<style>
.img-max-w-400 img {
  max-width: 800px !important;
  height: auto !important;
  display: block;
  /*margin: 0 auto;*/
}
</style>
