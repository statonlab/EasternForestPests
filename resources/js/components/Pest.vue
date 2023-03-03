<template>
  <div>
    <div class="row">
      <div v-if="loading" class="p-4 d-flex align-items-center justify-content-center">
        <inline-spinner class="text-primary"/>
      </div>
      <div v-if="!loading && !pest">oops</div>
      <div v-if="!loading && pest" class="col-sm-4">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Shorthand Information</h5>
            <div v-if="loading" class="p-4 d-flex align-items-center justify-content-center">
              <inline-spinner class="text-primary"/>
            </div>
            <ul class="list-group" v-if="!loading">
              <li class="list-group-item">
                <strong>Chapter:</strong> {{ pest.chapter ? pest.chapter.title : 'No chapter selected' }}
              </li>
              <li class="list-group-item">
                <strong>Type:</strong> {{ pest.type ? pest.type : 'No type selected' }}
              </li>
              <li class="list-group-item">
                <strong>Affects:</strong> {{ pest.affects_conifer || pest.affects_deciduous }}
              </li>
              <li class="list-group-item">
                <strong>Tree Part:</strong> {{ pest.visible_in_trunk ? 'Trunk' : 'Leaves' }}
              </li>
              <li class="list-group-item">
                <strong>Photos:</strong>
                <div class="row">
                  <div class="col-4">
                    <!--                    <img class="img-fluid" :src="pest.photo1" alt="Pest photo 1">-->
                  </div>
                  <div class="col-4">
                    <!--                    <img class="img-fluid" :src="pest.photo2" alt="Pest photo 2">-->
                  </div>
                  <div class="col-4">
                    <!--                    <img class="img-fluid" :src="pest.photo3" alt="Pest photo 3">-->
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div>
          <div class="card rounded-3 overflow-hidden">
            <div class="card-header border-bottom d-flex align-items-center">
              <div class="flex-grow-1" style="flex-direction: column">
                <div v-if="pest && pest.common_names && pest.common_names.length > 0">
                <span v-if="pest.common_names[0]" class="fw-bold text-gray-800">
                  {{ pest.common_names[0].name }}
                </span>
                  <span v-if="pest.common_names.length>1" class="fw-bold text-gray-800">
                {{ ', ' + pest.common_names[1].name }}
                </span>
                  <span v-if="pest.common_names.length>2" class="fw-bold text-gray-800">
                {{ ', ' + pest.common_names[2].name + '...' }}
                </span>
                </div>
                <span v-else class="fw-bold text-gray-800">
                {{ 'No common name provided' }}
                </span>
              </div>
              <div v-if="user.isSuperUser" class="flex-shrink-0 d-flex">
                <button class="btn btn-primary" type="button" @click.prevent="showImageForm = true">
                  <!--                  <ion-icon name="edit"/>-->
                  <span>{{ 'Upload Images' }}</span>
                </button>
                <button class="btn btn-primary ms-2" type="button" @click.prevent="showForm = true">
                  <!--                  <ion-icon name="edit"/>-->
                  <span>{{ 'Edit' }}</span>
                </button>
              </div>
            </div>

            <div v-if="loading" class="p-4 d-flex align-items-center justify-content-center">
              <inline-spinner class="text-primary"/>
            </div>
            <!--            <div v-if="!loading" class="p-4 d-flex align-items-center justify-content-center">-->
            <!--              {{ 'No pests found' }}-->
            <!--            </div>-->
            <div v-if="!loading" class="table-responsive">
              <table class="table table-borderless mb-0 table-middle table-hover bg-white">
                <tbody>
                <tr
                    class="border-bottom">
                  <td class="p-3">
                    <div class="d-flex align-items-center">
                      <!--                      <div class="border">-->
                      <!--                        img here?-->
                      <!--                      </div>-->
                      <div class="ms-3">
                        <div>
                          <span class="fw-bold text-gray-800">
                            {{ 'Major Hosts' }}
                          </span>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <pest-form v-if="showForm"
               @close="showForm = false"
               :pest="pest"
               @update="loadPest"/>
    <pest-image-form v-if="showImageForm"
                     @close="showImageForm = false"
                     :pest="pest"
                     @update="loadPest"/>
  </div>
</template>

<script>
import axios from 'axios'
import InlineSpinner from "./helpers/InlineSpinner.vue";
import PestForm from "../screens/PestForm.vue";
import PestImageForm from "../forms/PestImageForm.vue";
import User from "./helpers/User";

export default {
  name: "Pest",
  components: {InlineSpinner, PestForm, PestImageForm},

  data() {
    return {
      pest: null,
      loading: true,
      showForm: false,
      showImageForm: false,
      user: User.get()
    }
  },

  mounted() {
    this.loadPest();
  },

  methods: {
    async loadPest() {
      this.loading = true;
      // const {id} = this.$route.params.id
      // if (id) {
        try {
          const response = await axios.get(`/web/pest/` + this.$route.params.id);
          this.pest = response.data;
          this.loading = false
        } catch (error) {
          console.log(error);
          this.loading = false
        }
      // }
    },

    updated() {
      this.loading = true
      this.loadPest()
    },

    async togglePublic(pest) {
      this.loading = true
      try {
        const {data} = await axios.put(`/pests/${pest.id}/public`)
        this.pest = data
        this.$notify({
          text: this.pest.is_public ? 'Pest published successfully.' : 'Pest un-published successfully.',
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
  }
}
</script>

<style scoped>

</style>