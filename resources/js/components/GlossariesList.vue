<template>
  <div class="table-responsive">
    <table class="table table-borderless mb-0 table-middle table-hover bg-white">
      <tbody>
      <tr v-for="glossary in glossaries"
          class="border-bottom cursor-pointer"
          @click="$emit('select', glossary)">
        <td class="p-3">
          <div class="d-flex align-items-center">
            <div class="border">
              img here

            </div>
            <!--            <img :src="glossary.cover_image ? glossary.cover_image.url : ''"-->
            <!--                 :alt="img"-->
            <!--                 class="object-cover rounded flex-shrink-0" style="height: 50px; width: 50px;">-->
            <div class="ms-3">
              <span class="fw-bold text-gray-800">
                {{ glossary.term }}
              </span>
              <div>
                <small v-if="glossary.description.length<40" class="text-muted">{{ glossary.description }}</small>
                <small v-else class="text-muted">{{ glossary.description.substring(0, 40) + ".." }}</small>
              </div>
            </div>
          </div>
        </td>
        <!--        <td class="p-4" v-if="!shortForm">-->
        <!--          <span class="badge bg-light text-gray-800 rounded-pill"-->
        <!--                v-tooltip="'Your Role'">{{ glossary.roles[0].name }}</span>-->
        <!--        </td>-->
        <td class="p-4 text-gray-600">
          <!--          <span>{{ 'Chapter ' + glossary.chapter.number + ': ' + glossary.chapter.title }}</span>-->
          <!--            v-if="!shortForm">{{ glossary.responses_count | plural('Response', 'Responses') }}-->
        </td>
        <!--        <td class="p-4 text-gray-600">-->
        <!--            v-if="!shortForm">{{ glossary.participants_count | plural('Participant', 'Participants') }}-->
        <!--        </td>-->
        <td class="p-4 text-end">
          <a href="#" class="btn btn-link" @click.stop.prevent="$emit('select', glossary)">
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
  name: 'GlossariesList',
  components: {icon},
  props: {
    glossaries: {required: true, type: Array},
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