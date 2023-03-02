<template>
  <modal :large="true" class="h-100">
    <form action="#" @submit.prevent="create()" autocomplete="off">
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
            <select class="form-select" v-model="form.chapter_id">
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
            <select class="form-select" v-model="form.pest_type">
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
            <small class="form-text text-danger" v-if="form.errors.has('pest_type')">
              {{ form.errors.first('pest_type') }}
            </small>
          </div>

          <div class="form-group">
            <label class="form-label">{{ 'Does this pest affect deciduous trees, conifer, or both?' }}
              <required/>
            </label>
            <select class="form-select" v-model="form.tree_affected">
              <option disabled :value="null">{{ 'Select a chapter' }}</option>
              <option value="deciduous">
                {{ `Deciduous` }}
              </option>
              <option value="conifer">
                {{ `Conifer` }}
              </option>
              <option value="both">
                {{ `Both` }}
              </option>
            </select>
            <small class="form-text text-danger" v-if="form.errors.has('pest_type')">
              {{ form.errors.first('pest_type') }}
            </small>
          </div>

          <div class="form-group">
            <label class="form-label">{{ 'Where is this pest visible/where does this pest affect?' }}
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
              Description (goes directly under names)
            </label>
            <input v-model="form.description"
                   id="description"
                   name="description"
                   type="text"
                   class="form-control">
            <span class="form-text text-danger" v-if="form.errors.has('description')">
              {{ form.errors.first('description') }}
            </span>
          </div>

          <div class="form-group">
            <label>
              Major Hosts
            </label>
            <tip-tap :content="form.major_hosts" @input="form.major_hosts = $event.content"/>
            <span class="form-text text-danger" v-if="form.errors.has('major_hosts')">
              {{ form.errors.first('major_hosts') }}
            </span>
          </div>

          <div class="form-group">
            <label>
              Key Features
            </label>
            <tip-tap :content="form.key_features" @input="form.key_features = $event.content"/>
            <span class="form-text text-danger" v-if="form.errors.has('key_features')">
              {{ form.errors.first('key_features') }}
            </span>
          </div>

          <div class="form-group">
            <label>
              Control/Management
            </label>
            <tip-tap :content="form.control" @input="form.control = $event.content"/>
            <span class="form-text text-danger" v-if="form.errors.has('control')">
              {{ form.errors.first('control') }}
            </span>
          </div>

          <div class="form-group">
            <label>
              Other Info (Title)
            </label>
            <input v-model="form.other_info_title"
                   id="other_info_title"
                   name="other_info_title"
                   type="text"
                   class="form-control">
            <span class="form-text text-danger" v-if="form.errors.has('other_info_title')">
              {{ form.errors.first('other_info_title') }}
            </span>
          </div>

          <div class="form-group">
            <label>
              Other Info (Body)
            </label>
            <tip-tap :content="form.other_info_body" @input="form.other_info_body = $event.content"/>
            <span class="form-text text-danger" v-if="form.errors.has('other_info_body')">
              {{ form.errors.first('other_info_body') }}
            </span>
          </div>


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
import TipTap from "../components/TipTap.vue";


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
    TipTap,
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
        chapter_id: null,
        pest_type: null,
        is_pest: false,
        is_disease: false,
        tree_affected: null,
        affects_deciduous: false,
        affects_conifer: false,
        visible_in_roots: false,
        visible_in_trunk: false,
        visible_in_foliage: false,
        common_names: [''],
        scientific_names: [''],
        description: null,
        major_hosts: null,
        key_features: null,
        control: null,
        other_info_title: null,
        other_info_body: null,
      }),
    }
  },

  mounted() {
    this.loadPest()
    this.loadChapters()
  },

  methods: {
    async loadPest() {
      const {id} = this.$route.params
      if (id) {
        try {
          const {data} = await axios.get(`/pests/${id}`)
          this.pest = data
        } catch (e) {
          console.error(e)
        }
      }
      this.loading = false
    },

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
        const {data} = await axios.put(`/pests/${pest.id}/public`)
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

    create() {
      this.loading = true
      try {
        this.form.is_pest = this.form.pest_type === 'insect' || this.form.pest_type === 'both'
        this.form.is_disease = this.form.pest_type === 'disease' || this.form.pest_type === 'both'
        this.form.affects_deciduous = this.form.tree_affected === 'deciduous' || this.form.tree_affected === 'both'
        this.form.affects_conifer = this.form.tree_affected === 'conifer' || this.form.tree_affected === 'both'

        const {data} = this.form.post(`/pests`)
        this.$notify({
          text: 'Pest created successfully',
          type: 'success',
        })
        this.$emit('update', this.form)
        this.$emit('close')
      } catch (e) {
        if (!e.response || e.response.status !== 422) {
          this.$notify({
            text: 'Could not process your request at this time. please try refreshing the page.',
            type: 'error',
          })
        }
        console.error(e)
      }
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
