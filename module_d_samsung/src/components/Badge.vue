<script setup>
const props = defineProps(['type'])
const styles = {
  'task': 'bg-blue',
  'evaluation': 'bg-green',
  'other': 'bg-purple'
}
</script>

<template>
<span class="badge" :class="styles[props.type]">
  <slot></slot>
</span>
</template>

<style scoped>

</style>