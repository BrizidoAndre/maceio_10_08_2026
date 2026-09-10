<script setup>
import {useId} from "vue";

const id = useId();
const model = defineModel();
defineOptions({
  inheritAttrs: false,
})
const props = defineProps({
  required: {
    default: true
  }
})
</script>

<template>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" v-model="model" :id="id">
    <label class="form-check-label" :for="id">
      <slot></slot>
    </label>
  </div>
</template>