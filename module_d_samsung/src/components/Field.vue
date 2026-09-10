<script setup>
import {useId} from "vue";

const id = useId();
const model = defineModel();
defineOptions({
  inheritAttrs: false,
})
</script>

<template>
  <div class="mb-3">
    <label :for="id" class="form-label">
      <slot></slot>
    </label>
    <input :id="id" type="text" v-model="model" v-bind="$attrs" class="form-control" required>
  </div>
</template>

<style scoped>

</style>