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
  <div class="mb-3">
    <label :for="id" class="form-label">
      <slot></slot>
    </label>
    <input type="text" class="form-control" v-model="model" v-bind="$attrs" :required="required">
  </div>
</template>