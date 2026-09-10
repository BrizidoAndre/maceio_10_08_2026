<script setup>
import Badge from "@/components/Badge.vue";
import {computed, ref} from "vue";
import {getEventsFromDay, getRelatedCollection, training} from "@/helpers/global.js";
import Field from "@/components/Field.vue";

const props = defineProps(['event', 'day'])
const emits = defineEmits(['close']);
const collection = computed(() => {
  const found = getRelatedCollection(props.event?.name);
  return found;
})

function remove() {
  const foundDay = training.value.days.find(d => d.date === props.day.iso);
  let filtered = foundDay.events.filter(e => {
    return !(e.name === props.event.name && e.durationHours === props.event.durationHours);
  });
  foundDay.events = filtered;
  emits('close');
}

function submit() {
  const dayToAdd = training.value.days.find(d => d.date === date.value);
  if (!dayToAdd) {
    training.value.days.push({
      "date": date.value,
      "events": [
        {
          ...props.event
        },
      ]
    })
  } else {
    
    dayToAdd.events.push({...props.event})
  }
  // filtering element
  const foundDay = training.value.days.find(d => d.date === props.day.iso);
  let filtered = foundDay.events.filter(e => {
    return !(e.name === props.event.name && e.durationHours === props.event.durationHours);
  });
  foundDay.events = filtered;
  emits('close');
}

const date = ref(props?.day.iso ?? '');
</script>

<template>
  <div class="card card-body my-2">
    <div class="hstack justify-content-between">
      <badge :type="event.type" class="text-uppercase">{{ event.type }}</badge>
      <button class="btn" @click="remove(day, event)">
        <img src="@/assets/svgs/trash.svg" alt="Trash icon" class="icon">
      </button>
    </div>
    <h3>{{ event.name }}</h3>
    <p class="text-body-secondary">{{ event.durationHours }}h</p>
    <p class="text-body-tertiary">{{ collection?.description ?? event?.description ?? '' }}</p>
    <form action="" @submit.prevent="submit" class="hstack gap-2">
      <field v-model="date" type="date">Date</field>
      <button class="btn btn-primary mt-3">Move</button>
    </form>
  </div>
</template>

<style scoped>

</style>