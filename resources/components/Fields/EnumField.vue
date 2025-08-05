<script>
  export default {
    inheritAttrs: false,
  }
</script>

<script setup>
  import { computed } from 'vue'

  const emit = defineEmits(['input'])

  const props = defineProps([
    'accept',
    'as',
    'autofocus',
    'columns',
    'disabled',
    'endpoints',
    'enum',
    'field',
    'form-data',
    'grow',
    'guessFieldType',
    'help',
    'hidden',
    'icon',
    'label',
    'labels',
    'layout',
    'max',
    'min',
    'name',
    'options',
    'required',
    'reset',
    'resource',
    'saveable',
    'search',
    'section',
    'separator',
    'sort',
    'translate',
    'type',
    'value',
    'when',
    'width',
  ])

  const options = computed(() => props.options)
</script>

<template>
  <component :is="field" v-bind="props" :class="['k-enum-field', $attrs.class]" :options="options" @input="$emit('input', $event)" />
</template>

<style scoped>
  .k-enum-field {
    /**/
  }

  @container (min-width: 30rem) {
    .k-enum-field {
      /**/
    }
  }
</style>
