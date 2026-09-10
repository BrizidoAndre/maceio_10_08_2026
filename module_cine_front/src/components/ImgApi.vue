<script setup>
const props = defineProps({
  'image': {
  },
})
</script>

<template>
  <img :src="'http://10.83.10.119/cinema_api/public/storage/' + image" :alt="image">
</template>