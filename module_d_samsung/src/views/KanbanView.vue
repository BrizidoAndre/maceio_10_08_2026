<script setup>
import {computed, ref} from "vue";
import previous from "@/assets/svgs/previous.svg";
import calendar from "@/assets/svgs/calendar-month.svg";
import next from "@/assets/svgs/next.svg";
import {collection, formatDate, stringToDate, training} from "@/helpers/global.js";
import CardKanban from "@/components/CardKanban.vue";

const now = ref(new Date());
const startWeek = computed(() => {
  const copy = new Date(now.value);
  while (copy.getDay() !== 0) {
    copy.setDate(copy.getDate() - 1);
  }
  return copy;
});
const endWeek = computed(() => {
  const copy = new Date(now.value);
  while (copy.getDay() !== 6) {
    copy.setDate(copy.getDate() + 1)
  }
  return copy;
});

function changeWeek(weekCount) {
  const copy = new Date(now.value);
  copy.setDate(copy.getDate() + (weekCount * 7));
  now.value = copy;
}

const eventWeek = computed(() => {
  const days = [];
  training.value.days.forEach(d => {
    const datetime = stringToDate(d.date);
    if (datetime > startWeek.value && datetime < endWeek.value) {
      days.push(d);
    }
  })
  let events = [];
  days.forEach(d => {
    d.events.forEach(e => {
      if (e.type !== 'other') {
        events.push({
          event: e,
          day: d,
        });
      }
    })
  })
  return events;
})

const taskTodo = computed(() => {
  const copy = eventWeek.value.filter(e => e.event.kanbanStatus === 'todo');
  return copy;
})
const taskInProgress = computed(() => {
  const copy = eventWeek.value.filter(e => e.event.kanbanStatus === 'in_progress');
  return copy;
})
const taskDone = computed(() => {
  const copy = eventWeek.value.filter(e => e.event.kanbanStatus === 'done');
  return copy;
})

const dragged = ref(null);

function handleDrop(status) {
  console.log('teste');
  dragged.value.status = status;
  dragged.value = null;
}

function handleDrag(event) {
  dragged.value = event.event;
}
</script>
<template>
  <div class="hstack justify-content-between">
    <button class="btn btn-secondary hstack gap-2" @click="changeWeek(-1)">
      <img :src="previous" alt="Previous icon" width="25">
      <span>Previous</span>
    </button>
    <div class="hstack gap-1">
      <img :src="calendar" alt="Calendar icon" width="30">
      <h2 class="fs-4">
        {{ formatDate(startWeek, {month: 'short', day: 'numeric'}) }}
        -
        {{ formatDate(endWeek, {month: 'short', day: 'numeric', year: 'numeric'}) }}
      </h2>
    </div>
    <button class="btn btn-secondary hstack gap-2" @click="changeWeek(1)">
      <span>Next</span>
      <img :src="next" alt="Next icon" width="25">
    </button>
  </div>
  <div class="row row-cols-3">
    <div class="col">
      <h3>Todo ({{ taskTodo.length }})</h3>
      <div draggable="true" @dragover.prevent @drop="handleDrop('todo')">
        <card-kanban v-for="event in taskTodo" :event="event.event" :day="event.day"
                     @dragstart="handleDrag(event)"/>
      </div>
    </div>
    <div class="col">
      <h3>InProgress ({{ taskInProgress.length }})</h3>
      <div draggable="true" @dragover.prevent @drop="handleDrop('in_progress')">
        <card-kanban v-for="event in taskInProgress" :event="event.event" :day="event.day"
                     @dragstart="handleDrag(event)"/>
      </div>
    </div>
    <div class="col">
      <h3>Done ({{ taskDone.length }})</h3>
      <div draggable="true" @dragover.prevent @drop="handleDrop('done')">
        <card-kanban v-for="event in taskDone" :event="event.event" :day="event.day"
                     @dragstart="handleDrag(event)"/>
      </div>
    </div>
  </div>
</template>
