<template>
  <modal :xlarge="true" class="h-100">
    <form action="#" @submit.prevent="submit()">
      <modal-card>
        <modal-header>
          <modal-title v-if="pest">Update "{{ pest.title }}"</modal-title>
          <modal-title v-else>Pest Editor</modal-title>
          <close @click="$emit('close')"/>
        </modal-header>
        <modal-body>
          <chapter-select :value="form.chapter"/>
          <div class="form-group">
            <label for="title">
              Title
              <required/>
            </label>
            <input id="title"
                   name="title"
                   type="text"
                   :class="['form-control',  {'is-invalid': form.errors.has('title')}]"
                   v-model="form.title"
                   autofocus>
            <small class="form-text text-danger" v-if="form.errors.has('title')">
              {{ form.errors.first('title') }}
            </small>
          </div>

          <div class="form-group">
            <label for="description">
              {{ 'documentation.description' }}
              <required/>
            </label>
            <input id="description"
                   type="text"
                   name="description"
                   class="form-control"
                   v-model="form.description">
            <p class="form-text text-danger" v-if="form.errors.has('description')">
              {{ form.errors.first('description') }}
            </p>
          </div>

          <div class="form-group">
            <label>
              Text
            </label>
            EDITOR GOES HERE
            <!--            <editor id="text"-->
            <!--                    ref="editor"-->
            <!--                    height="600px"-->
            <!--                    initialEditType="wysiwyg"-->
            <!--                    :initialValue="post ? post.text : ''"-->
            <!--                    :options="editorOptions"-->
            <!--            />-->
            <span class="form-text text-danger" v-if="form.errors.has('text')">
              {{ form.errors.first('text') }}
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
  <!--  <div>-->
  <!--    <div v-if="!loading">-->
  <!--      <div class="mb-3 d-flex align-items-center bg-white border-bottom mt-n4 py-4 mx-n4 px-4">-->
  <!--        <div class="flex-grow-1 d-flex align-items-center">-->
  <!--          <div>-->
  <!--            <button @click=$router.go(-1) class="btn btn-link text-muted mr-1">-->
  <!--              <icon name="arrow-back" class="text-muted"/>-->
  <!--            </button>-->
  <!--          </div>-->
  <!--          <div>-->
  <!--            <div class="d-flex align-items-center">-->
  <!--              <h1 class="title">{{ pest.title }}</h1>-->
  <!--              &lt;!&ndash;              <pest-categories-row :pest="pest"/>&ndash;&gt;-->
  <!--            </div>-->
  <!--            <div class="text-muted">-->
  <!--              {{ pest.description }}-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--        <div class="d-flex align-items-center flex-shrink-0 pl-1">-->
  <!--          <div class="btn-group">-->
  <!--            <button class="btn btn-white shadow-sm" @click.prevent="showpestForm = true">-->
  <!--              <icon name="create" class="text-muted"/>-->
  <!--              <span>{{ 'general.edit' }}</span>-->
  <!--            </button>-->
  <!--            <button class="btn btn-white shadow-sm" @click.prevent="togglePublic(pest)">-->
  <!--              <icon name="information-circle"-->
  <!--                    :class="{'text-danger': !pest.is_public, 'text-success': pest.is_public}"/>-->
  <!--              <span>{{ pest.is_public ? 'documentation.unpublish' : 'documentation.publish' }}</span>-->
  <!--            </button>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--      <div class="container">-->
  <!--        <div class="row">-->
  <!--          <div class="col-12">-->
  <!--            <div class="card">-->
  <!--              <div class="card-body">-->
  <!--                &lt;!&ndash;                <viewer :initialValue="viewerText" class="img-max-w-400"/>&ndash;&gt;-->
  <!--              </div>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--    </div>-->
  <!--    <div v-else-if="!loading && !pest">-->
  <!--      <div class="card border border-danger">-->
  <!--        <div class="card-body">-->
  <!--          {{ $t('errors.notFound') }}-->
  <!--        </div>-->
  <!--      </div>-->
  <!--    </div>-->
  <!--    <div v-else-if="loading">-->
  <!--      <div class="d-flex align-items-center justify-content-center">-->
  <!--        <inline-spinner class="text-primary"/>-->
  <!--      </div>-->
  <!--    </div>-->
  <!--    &lt;!&ndash;    <pest-form :pest="pest" v-if="showpestForm" @update="updated()" @close="showpestForm = false"/>&ndash;&gt;-->
  <!--  </div>-->
</template>

<script>
import Form from "../components/helpers/Form";
import User from "../components/helpers/User";
import InlineSpinner from "../components/helpers/InlineSpinner.vue";
// import pestForm from '../../forms/pestForm'
// import {Viewer} from '@toast-ui/vue-editor'
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

export default {
  name: 'PestEditor',

  components: {
    ChapterSelect,
    // pestForm,
    InlineSpinner,
    // Viewer,
    modal,
    modalHeader,
    modalTitle,
    modalCard,
    modalBody,
    modalFooter,
    close,
    required
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
      showpestForm: false,
      viewerText: '',
      form: new Form({
        chapter: null,
        title: '',
        description: '',
        text: '',
      }),
    }
  },

  mounted() {
    this.loadPest()
    // this.loadChapters()
  },

  methods: {
    async loadPest() {
      const {id} = this.$route.params
      if (id) {
        try {
          const {data} = await axios.get(`/web/pests/${id}`)
          this.pest = data
          this.viewerText = this.pest.text
        } catch (e) {
          console.error(e)
        }
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
      this.loadpest()
      this.showpestForm = false
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
