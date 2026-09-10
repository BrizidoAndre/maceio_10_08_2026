<script setup>

import {computed} from "vue";
import {training} from "@/helpers/global.js";

const daysWithTraining = computed(() => {
  const validDays = training.value.days.filter(d => d?.events.length > 0).length;
  return validDays;
})
const daysCompleted = computed(() => {
  const validDays = training.value.days.filter(d => d?.events.some(e => e.type !== 'other') && d?.events.every(e => e.kanbanStatus === 'done')).length;
  return validDays;
})
const plannedHours = computed(() => {
  let total = 0;
  training.value.days.forEach(d => {
    d.events.forEach(e => {
      total += e.durationHours;
    })
  })
  return total;
})
const completedHours = computed(() => {
  let total = 0;
  training.value.days.forEach(d => {
    d.events.forEach(e => {
      if (e.kanbanStatus === 'done') {
        total += e.durationHours;
      }
    })
  })
  return total;
})

const taskTotal = computed(() => {
  let events = [];
  training.value.days.forEach(d => {
    d.events.forEach(e => {
      if (e.type === 'task') {
        events.push(e);
      }
    })
  })
  return events;
})
const taskHoursTotal = computed(() => {
  let total = 0;
  taskTotal.value.forEach(t => {
    total += t.durationHours;
  })
  return total
})
const evaluationTotal = computed(() => {
  let events = [];
  training.value.days.forEach(d => {
    d.events.forEach(e => {
      if (e.type === 'evaluation') {
        events.push(e);
      }
    })
  })
  return events;
})
const evaluationHoursTotal = computed(() => {
  let total = 0;
  evaluationTotal.value.forEach(t => {
    total += t.durationHours;
  })
  return total
})
const otherTotal = computed(() => {
  let events = [];
  training.value.days.forEach(d => {
    d.events.forEach(e => {
      if (e.type === 'other') {
        events.push(e);
      }
    })
  })
  return events;
})
const otherHoursTotal = computed(() => {
  let total = 0;
  evaluationTotal.value.forEach(t => {
    total += t.durationHours;
  })
  return total
})
</script>
<template>
  <h2>Preparation Statistics</h2>
  <div class="alert alert-warning" v-if="daysWithTraining < 120">
    Warning: only {{ daysWithTraining }}/120 training days have active events.
  </div>
  <div class="alert alert-warning" v-else-if="daysWithTraining > 122">
    Warning: the number of days {{ daysWithTraining }}exceeds the allowed maximum (122).
  </div>
  <div class="row row-cols-3 g-2">
    <div class="col">
      <div class="card card-body">
        <p class="text-body-secondary text-uppercase">Completed training days</p>
        <p class="fs-2">{{ daysCompleted }}</p>
      </div>
    </div>
    <div class="col">
      <div class="card card-body">
        <p class="text-body-secondary text-uppercase">Planned Hours</p>
        <p class="fs-2">{{ plannedHours }}</p>
      </div>
    </div>
    <div class="col">
      <div class="card card-body">
        <p class="text-body-secondary text-uppercase">Completed hours</p>
        <p class="fs-2">{{ completedHours }}</p>
      </div>
    </div>
  </div>
  <h3>Events by type</h3>
  <table class="table">
    <thead>
    <tr>
      <th>Type</th>
      <th>Events</th>
      <th>Hours</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td>Task</td>
      <td>{{ taskTotal.length }}</td>
      <td>{{ taskHoursTotal }}h</td>
    </tr>
    <tr>
      <td>Evaluation</td>
      <td>{{ evaluationTotal.length }}</td>
      <td>{{ evaluationHoursTotal }}h</td>
    </tr>
    <tr>
      <td>Other</td>
      <td>{{ otherTotal.length }}</td>
      <td>{{ otherHoursTotal }}h</td>
    </tr>
    </tbody>
  </table>
  <p class="text-body-secondary">Active training days: {{ daysWithTraining }} (target: 120, max: 122)</p>
</template>

<style scoped>

</style>