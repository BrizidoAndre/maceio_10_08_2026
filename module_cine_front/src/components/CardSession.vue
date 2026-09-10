<script setup>
import {computed} from "vue";
import {formatStringDate} from "@/helpers/global.js";

const props = defineProps(['session', 'movie'])
const hourFormatted = computed(() => {
  return formatStringDate(props.session.session_date);
})
</script>

<template>
  <div class="card card-body my-2">
    <h4>{{ hourFormatted }}</h4>
    <p><span class="fw-bold">{{ session.room.name }}</span>
      -
      <span class="text-body-secondary text-capitalize">
      {{ session.room.type }}
      </span>
    </p>
  </div>
</template>

<style scoped>

</style>