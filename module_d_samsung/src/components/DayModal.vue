<script setup>
import {computed, onMounted, reactive, ref, watchEffect} from "vue";
import CardEvent from "@/components/CardEvent.vue";
import SelectField from "@/components/SelectField.vue";
import Field from "@/components/Field.vue";
import {collection, stringToDate, training} from "@/helpers/global.js";

const props = defineProps(['day'])
const emits = defineEmits(['close'])
const newEvent = reactive({
  type: 'task',
  name: "",
  description: "",
  durationHours: 4,
  kanbanStatus: "pending"
})
const types = {
  'evalutation': 'Evaluation',
  'task': 'Task',
  'other': 'Other',
}
const collectionNames = computed(() => {
  const names = new Set();
  collection.value.forEach(c => {
    names.add(c.name);
  })
  return [...names]
})

watchEffect(() => {
  if (newEvent.type === 'task') {
    const found = collection.value.find(c => c.name === newEvent.name);
    if (found) {
      newEvent.durationHours = found.estTime;
    }
  }
  if (newEvent.type === 'evaluation') {
    newEvent.durationHours = 2;
  }

  if (newEvent.type !== 'other') {
    newEvent.name = '';
    newEvent.description = '';
  }
})
const error = ref('');

function submit() {
  error.value = '';
  const daysToTrain = training.value.days.length;
  if (daysToTrain > 122) {
    error.value = 'At most 122 days may have events.';
  }
  const startTrain = stringToDate(training.value.trainingPeriod.start);
  const endTrain = stringToDate(training.value.trainingPeriod.end);
  if (props.day.datetime < startTrain || props.day.datetime > endTrain) {
    error.value = 'Only days within the defined training period may have events';
  }
  if (!error.value) {
    const dayToAdd = training.value.days.find(d => d.date === props.day.iso);
    if (!dayToAdd) {
      training.value.days.push({
        "date": props.day.iso,
        "events": [
          {
            ...newEvent,
          },
        ]
      })
    } else {
      if (dayToAdd.events.length >= 3) {
        error.value = 'Each day has at most 3 events.';
        return;
      }
      let trainTotal = 0;
      dayToAdd.events.forEach(e => {
        trainTotal += e.durationHours;
      })
      if (trainTotal + newEvent.durationHours > 9) {
        error.value = 'the daily total of all events on that day must not exceed 9 hours.';
        return;
      }
      dayToAdd.events.push({...newEvent})
    }
    emits('close');
  }
}
</script>

<template>
  <div class="hstack justify-content-between">
    <h3>{{ day.iso }} <span class="text-body-secondary fs-5">#{{ day.eventId }}</span></h3>
    <button class="btn btn-close" @click="emits('close')"></button>
  </div>
  <hr>
  <div>
    <card-event v-for="event in day.events" :event="event" :day="day" @close="emits('close')"/>
  </div>
  <div>
    <h3>Add event</h3>
    <form action="" @submit.prevent="submit">
      <select-field v-model="newEvent.type" label="Type">
        <option v-for="(value, key) in types" :value="key">{{ value }}</option>
      </select-field>
      <template v-if="newEvent.type !== 'other'">
        <select-field v-model="newEvent.name" label="MITS task">
          <option v-for="value in collectionNames" :value="value">{{ value }}</option>
        </select-field>
      </template>
      <field v-model="newEvent.durationHours" :disabled="newEvent.type ==='task'" min="1" max="9" step="1"
             type="number">
        Duration (hours)
      </field>
      <div v-if="newEvent.type === 'other'">
        <field v-model="newEvent.name">Name</field>
        <field v-model="newEvent.description">Description</field>
      </div>
      <p class="text-danger" v-if="error">{{ error }}</p>
      <div class="hstack gap-1">
        <button class="btn btn-primary">Send</button>
        <button class="btn btn-secondary" type="button" @click="emits('close')">Cancel</button>
      </div>
    </form>
  </div>
</template>

<style scoped>
</style>