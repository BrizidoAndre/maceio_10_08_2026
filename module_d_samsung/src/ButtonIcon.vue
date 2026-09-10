<script setup>
const props = defineProps(['icon'])
</script>

<template>
  <button class="btn btn-primary d-flex flex-column align-items-center">
    <img :src="icon" alt="Theme" class="icon">
    <span>
          <slot></slot>
    </span>
  </button>
</template>

<style scoped>
.icon {
  width: 30px;
}
</style>