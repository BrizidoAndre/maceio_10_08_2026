<script setup>
import Badge from "@/components/Badge.vue";

const props = defineProps(['event', 'day'])
</script>

<template>
  <div class="card card-body my-2" draggable="true">
    <p>
      <badge class="text-uppercase" :type="event.type">{{ event.type }}</badge>
    </p>
    <h3 class="fs-5">{{ event.name }}</h3>
    <p class="text-body-secondary">{{ day.date }} - {{ event.durationHours }}h</p>
  </div>
</template>

<style scoped>

</style>