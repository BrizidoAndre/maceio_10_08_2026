<script setup>
import {useId} from "vue";

const id = useId();
const model = defineModel();
defineOptions({
  inheritAttrs: false,
})
const props = defineProps(['label'])
</script>

<template>
  <div class="mb-3">
    <label :for="id" class="form-label">
      {{ label }}
    </label>
    <select name="" :id="id" class="form-select" required v-model="model" v-bind="$attrs">
      <option value="">Select a value</option>
      <slot></slot>
    </select>
  </div>
</template>

<style scoped>

</style>