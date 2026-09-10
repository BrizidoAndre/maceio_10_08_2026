<script setup>

import Field from "@/components/Field.vue";
import {trips} from "@/helpers/global.js";
import {reactive} from "vue";
import {addAlert} from "@/helpers/addAlert.js";

const emits = defineEmits(['close'])
const props = defineProps(['location', 'information'])
const newTrip = reactive({
  location: props?.location,
  information: props?.information,
  startDate: '',
  endDate: '',
})

function submit() {
  if (newTrip.endDate <= newTrip.startDate) {
    addAlert('End date must be higher than the start date', 'warning');
    return;
  }
  const copyTrips = [...trips.value];
  let tripFound = copyTrips.filter(t => {
    let isAfter = t.startDate <= newTrip.endDate;
    let isBefore = t.endDate >= newTrip.startDate;
    return isAfter && isBefore;
  });
  if (tripFound.length > 0) {
    addAlert('Scheduling conflict', 'danger');
    return null;
  }
  trips.value.push({
    ...newTrip,
    location: props?.location,
    information: props?.information,
  })
  addAlert('Trip added!');
  console.log(trips.value);
  emits('close');
}
</script>

<template>
  <h1>Create trip</h1>
  <form action="" @submit.prevent="submit">
    <field v-model="newTrip.startDate" type="date">Start Date</field>
    <field v-model="newTrip.endDate" type="date">End Date</field>
    <button class="btn btn-primary">Send</button>
  </form>

</template>

<style scoped>

</style>