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
            <!--            <img :src="pest.cover_image ? pest.cover_image.url : ''"-->
            <!--                 :alt="img"-->
            <!--                 class="object-cover rounded flex-shrink-0" style="height: 50px; width: 50px;">-->
            <div class="ms-3">
              <span class="fw-bold text-gray-800">
                {{ pest.common_name[0] ? pest.common_name[0] : 'No name provided' }}
              </span>
              <span v-if="pest.common_name.length>1" class="fw-bold text-gray-800">
                {{ ', ' + pest.common_name[1] }}
              </span>
              <span v-if="pest.common_name.length>2" class="fw-bold text-gray-800">
                {{ ', ' + pest.common_name[2] + '...' }}
              </span>
              <div>
                <small v-if="pest.description.length<40" class="text-muted">{{ pest.description }}</small>
                <small v-else class="text-muted">{{ pest.description.substring(0, 40) + ".." }}</small>
              </div>
            </div>
          </div>
        </td>
        <!--        <td class="p-4" v-if="!shortForm">-->
        <!--          <span class="badge bg-light text-gray-800 rounded-pill"-->
        <!--                v-tooltip="'Your Role'">{{ pest.roles[0].name }}</span>-->
        <!--        </td>-->
        <td class="p-4 text-gray-600">
          <span>{{ 'Chapter ' + pest.chapter.number + ': ' + pest.chapter.title }}</span>
          <!--            v-if="!shortForm">{{ pest.responses_count | plural('Response', 'Responses') }}-->
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
import icon from "./Icon.vue";
import User from "./helpers/User";
import Pager from "./Pager.vue";

export default {
  name: 'pestsList',
  components: {icon, Pager},
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