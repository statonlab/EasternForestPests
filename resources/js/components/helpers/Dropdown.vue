<template>
  <div class="dropdown" ref="dropdown">
    <button :class="['btn', {'btn-light': value === null, 'btn-primary': value !== null}, 'd-flex', 'justify-content-between', 'w-100', ...buttonClass]"
            type="button"
            :disabled="disabled"
            data-toggle="dropdown">
      <span class="pr-1">{{ selectedValue }}</span>
      <icon name="ios-arrow-down"/>
    </button>
    <div class="dropdown-menu w-100" :class="{'dropdown-menu-right': rightAligned}" aria-labelledby="Options">
      <div v-if="enableSearch" class="px-2 pb-1">
        <input type="text"
               class="form-control form-control-sm"
               :value="search"
               @keydown="$emit('search', $event.target.value)"
               ref="search"
               :title="$t('general.search')"
               :placeholder="$t('general.search')"/>
      </div>
      <div class="max-height">
        <a href="#"
           v-for="option in options"
           :class="['dropdown-item', {'active': option.value === value}, 'text-overflow-visible']"
           @click.prevent="$emit('input', option.value === value ? null : option.value)">
          {{ option.label }}
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import Icon from "./Icon.vue";

export default {
  name: 'Dropdown',

  components: {Icon},

  props: {
    label       : {required: true, type: String},
    value       : {required: true},
    options     : {required: true, type: Array},
    buttonClass : {required: false, default: () => []},
    disabled    : {required: false, type: Boolean, default: false},
    search      : {required: false, type: String},
    enableSearch: {required: false, type: Boolean, default: false},
    rightAligned: {required: false, type: Boolean, default: false},
    multiple    : {required: false, type: Boolean, default: false},
  },

  data() {
    return {
      index: null,
      open : false,
    }
  },

  computed: {
    selectedValue() {
      if (this.index !== null) {
        return this.options[this.index].label
      }

      return this.label
    },
  },

  mounted() {
    $(this.$refs.dropdown).on('shown.bs.dropdown', this.onOpen)
  },

  beforeDestroy() {
    $(this.$refs.dropdown).off('shown.bs.dropdown', this.onOpen)
  },

  watch: {
    value: {
      immediate: true,
      handler() {
        this.extractIndex()
      },
    },

    'options.length': {
      handler() {
        this.extractIndex()
      },
    },

    open(open) {
      if (open) {
        this.onOpen()
      }
    },
  },

  methods: {
    extractIndex() {
      if (this.value === null) {
        this.index = null
        return
      }

      for (let i = 0; i < this.options.length; i++) {
        if (this.options[i].value === this.value) {
          this.index = i
          return
        }
      }

      this.index = null
    },

    onOpen() {
      if (this.$refs.search) {
        this.$refs.search.focus()
      }
    },
  },
}
</script>

<style scoped>
.max-height {
  max-height: calc(100vh - 170px);
  overflow-y: auto;
}
</style>
