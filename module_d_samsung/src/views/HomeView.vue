<script setup>
import previous from "@/assets/svgs/previous.svg";
import next from "@/assets/svgs/next.svg";
import calendar from "@/assets/svgs/calendar-month.svg";
import {computed, onMounted, ref, watch} from "vue";
import {dateToString, formatDate, getEventsFromDay, training} from "@/helpers/global.js";
import Badge from "@/components/Badge.vue";
import DayModal from "@/components/DayModal.vue";
import {useModal} from "@/helpers/useModal.js";

const now = ref(new Date());

function changeMonth(monthToChange) {
  const copy = new Date(now.value);
  copy.setMonth(copy.getMonth() + monthToChange);
  now.value = copy;
}

const days = ref([]);
const weekdays = computed(() => {
  const copy = new Date(now.value);
  const firstDay = new Date(copy.getFullYear(), copy.getMonth(), 1);
  const weeknames = [];
  for (let i = 0; i < 7; i++) {
    firstDay.setDate(i + 1);
    weeknames.push(firstDay.toLocaleDateString('en', {
      weekday: 'short',
    }))
  }
  return weeknames;
})

function generateDays() {
  days.value = [];
  const copy = new Date(now.value);
  const startMonth = new Date(copy.getFullYear(), copy.getMonth(), 1);
  const endMonth = new Date(copy.getFullYear(), copy.getMonth() + 1, 0)
  let day = startMonth
  while (day <= endMonth) {
    const stringDate = dateToString(day);
    const datetime = new Date(day);
    const [events, index] = getEventsFromDay(stringDate);
    const label = getLabelFromEvents(events);
    days.value.push({
      datetime: datetime,
      iso: stringDate,
      events: events,
      eventId: index,
      label,
      types: getTypesFromEvents(events),
      totalHours: getTotalHours(events),
      hasEvents: !!events.length
    })
    day = new Date(day.getFullYear(), day.getMonth(), day.getDate() + 1);
  }
}

function getTotalHours(events) {
  let total = 0;
  events.forEach(e => {
    total += e.durationHours;
  })
  return total;
}

function getTypesFromEvents(events) {
  const types = new Set();
  events.forEach(e => {
    types.add(e.type)
  })
  return [...types];
}

function getLabelFromEvents(events) {
  const eventNames = new Set();
  events.forEach(e => {
    eventNames.add(e.name)
  })
  if (eventNames.size > 1) {
    return 'Multiple different events';
  } else if (events.length) {
    return events[0].name + ' ...';
  }
  return '';
}

const getDayClass = (datetime) => {
  const now = new Date();
  if (datetime.getFullYear() === now.getFullYear() && datetime.getMonth() === now.getMonth() && datetime.getDate() === now.getDate()) {
    return 'border-primary border-2'
  } else if (datetime < now) {
    return 'opacity-50 text-body-secondary';
  }
}

watch(now, value => {
  generateDays()
}, {
  immediate: true,
})

const {open, close, isOpen} = useModal();

function openModal(day) {
  open(DayModal, {
    day: {...day},
  })
}

watch(isOpen, value => {
  generateDays()
})
</script>

<template>
  <div class="card card-body shadow">
    <div class="hstack justify-content-between">
      <button class="btn btn-secondary hstack gap-2" @click="changeMonth(-1)">
        <img :src="previous" alt="Previous icon" width="25">
        <span>Previous</span>
      </button>
      <div class="hstack gap-1">
        <img :src="calendar" alt="Calendar icon" width="30">
        <h2 class="fs-4">{{ formatDate(now, {month: 'long', year: 'numeric'}) }}</h2>
      </div>
      <button class="btn btn-secondary hstack gap-2" @click="changeMonth(1)">
        <span>Next</span>
        <img :src="next" alt="Next icon" width="25">
      </button>
    </div>
    <div class="calendar-grid my-2">
      <div class="text-center bg-body-secondary p-2" v-for="day in weekdays">
        {{ day }}
      </div>
      <div v-for="(day,i) in days" class="calendar-day" :class="[getDayClass(day.datetime)]" @click="openModal(day)">
        <div class="hstack justify-content-between">
          <span>{{ i + 1 }}</span>
          <span v-if="day.events.length">#{{ day.eventId }}</span>
        </div>
        <p>
          {{ day.label }}
        </p>
        <div class="hstack justify-content-between" v-if="day.hasEvents">
          <div class="hstack gap-1">
            <Badge v-for="type in day.types" :type="type" class="text-uppercase">{{ type.slice(0, 1) }}</Badge>
          </div>
          <p>{{ day.totalHours }}h</p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.calendar-grid {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
}

.calendar-day {
  min-height: 150px;
  border: 1px solid var(--bs-secondary);
  padding: .5rem;
}
</style>