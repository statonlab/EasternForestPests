<template>
  <modal class="h-100">
    <form action="#" @submit.prevent="create()" autocomplete="off">
      <modal-card>
        <modal-header>
          <modal-title v-if="pest">Upload Image "{{ pest.title }}"</modal-title>
          <modal-title v-else>Pest Editor</modal-title>
          <close @click="$emit('close')"/>
        </modal-header>
        <modal-body class="bold-labels">
          <div class="card mb-3">
            <div class="card-header">
              Upload Image
            </div>
            <div class="card-body">
              <form @submit.prevent="uploadImage">
                <div class="mb-3">
                  <label for="image" class="form-label">Image</label>
                  <input type="file" class="form-control" id="image" ref="image" v-on:change="">
                  <div class="invalid-feedback" v-if="errors.image">{{ errors.image[0] }}</div>
                </div>
                <div class="mb-3">
                  <label for="caption" class="form-label">Caption</label>
                  <input type="text" class="form-control" id="caption" v-model="caption">
                  <div class="invalid-feedback" v-if="errors.caption">{{ errors.caption[0] }}</div>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
              </form>
            </div>
          </div>
        </modal-body>
      </modal-card>
    </form>
  </modal>
</template>

<script>
import Modal from "../Components/Helpers/Modal.vue";
import ModalCard from "../Components/Helpers/ModalCard.vue";
import ModalHeader from "../Components/Helpers/ModalHeader.vue";
import ModalTitle from "../Components/Helpers/ModalTitle.vue";
import ModalBody from "../Components/Helpers/ModalBody.vue";
import ModalFooter from "../Components/Helpers/ModalFooter.vue";
import Close from "../Components/Helpers/Close.vue";
import InlineSpinner from "../Components/Helpers/InlineSpinner.vue";
import Icon from "../Components/Helpers/Icon.vue";

export default {
  name: "PestImageForm",

  components: {
    Modal,
    ModalCard,
    ModalHeader,
    ModalTitle,
    ModalBody,
    ModalFooter,
    Close,
    InlineSpinner,
    Icon,
  },

  props: {
    pest: { required: false, type: Object, default: null },
  },

  data() {
    return {
      image: null,
      caption: null,
      errors: {},
    };
  },

  methods: {
    uploadImage() {
      const formData = new FormData();
      formData.append('image', this.image);
      formData.append('caption', this.caption);
      axios.post(`/api/pests/${this.pest.id}/images`, formData)
        .then(response => {
          this.$emit('close');
          this.$emit('image-uploaded', response.data);
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    },
  },
}
</script>

<style scoped>

</style>