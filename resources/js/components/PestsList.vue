<template>
  <div class="table-responsive">
    <table class="table table-borderless mb-0 table-middle table-hover bg-white">
      <tbody>
      <tr v-for="pest in pests"
          class="border-bottom cursor-pointer"
          @click="$emit('select', pest)">
        <td class="p-3">
          <div class="d-flex align-items-center">
            <div class="border">
              img here
            </div>
            <div class="ms-3">
              <div v-if="pest.common_names && pest.common_names.length > 0">
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

              <!--              <span v-if="pest.common_names" v-for="name in pest.common_names" class="fw-bold text-gray-800">-->
              <!--                {{ name.name + ' ' }}-->
              <!--              </span>-->
              <!--              {{pest.common_names}}-->
              <div v-if="pest.description">
                <small v-if="pest.description.length<40" class="text-muted">{{
                    pest.description
                  }}</small>
                <small v-else class="text-muted">{{ pest.description.substring(0, 40) + ".." }}</small>
              </div>
            </div>
          </div>
        </td>
        <!--        <td class="p-4" v-if="!shortForm">-->
        <!--          <span class="badge bg-light text-gray-800 rounded-pill"-->
        <!--                v-tooltip="'Your Role'">{{ pest.roles[0].name }}</span>-->
        <!--        </td>-->
        <td v-if="pest.chapter" class="p-4 text-gray-600">
          <span>{{ 'Chapter ' + pest.chapter.number + ': ' + pest.chapter.title }}</span>
        </td>
        <td v-else class="p-4 text-gray-600">
          <span>{{ 'No chapter provided' }}</span>
        </td>
        <!--        <td class="p-4 text-gray-600">-->
        <!--            v-if="!shortForm">{{ pest.participants_count | plural('Participant', 'Participants') }}-->
        <!--        </td>-->
        <td class="p-4 text-end">
          <a href="#" class="btn btn-link" @click.stop.prevent="$emit('select', pest)">
            <icon name="arrow-forward"/>
          </a>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import icon from "./helpers/Icon.vue";
import User from "./helpers/User";

export default {
  name: 'PestsList',
  components: {icon},
  props: {
    pests: {required: true, type: Array},
    shortForm: {required: false, type: Boolean, default: false},
  },
  data() {
    return {
      user: User.get(),
    }
  },
}
</script>

<style scoped>
</style>