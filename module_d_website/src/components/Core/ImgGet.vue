<script setup>
defineProps({
  image: {
    required: true,
  }
})
const url = 'http://10.83.10.173';
</script>

<template>
  <img :src="url + image" :alt="'image cover'">
</template>