<script setup>
import {computed, isMemoSame, onMounted, onUnmounted, ref} from "vue";
import {trips} from "@/helpers/global.js";
import ImgGet from "@/components/Core/ImgGet.vue";
import {useRouter} from "vue-router";
import {addAlert} from "@/helpers/addAlert.js";

const now = ref(new Date());
const days = ref([]);
const weekDays = computed(() => {
  const copy = new Date(now.value);
  const startMonth = new Date(copy.getFullYear(), copy.getMonth(), 1);
  const day = new Date(startMonth);
  let weekNames = [];
  for (let i = 0; i < 7; i++) {
    day.setDate(day.getDate() + 1);
    weekNames.push(day.toLocaleDateString('en', {weekday: 'long'}))
  }
  return weekNames;
});

function generateDays() {
  days.value = [];
  const copy = new Date(now.value);
  const startMonth = new Date(copy.getFullYear(), copy.getMonth(), 1);
  const endMonth = new Date(copy.getFullYear(), copy.getMonth() + 1, 0);
  const day = new Date(startMonth);
  while (day <= endMonth) {
    const iso = String(day.toISOString()).slice(0, 10);
    const trip = trips.value.find((t) => {
      return iso >= t.startDate && iso <= t.endDate;
    })
    const newObject = {
      datetime: new Date(day),
      iso: iso,
      dayFormat: day.getDate(),
      trip: trip ?? {},
    }
    days.value.push(newObject)
    day.setDate(day.getDate() + 1);
  }
}

const getDayClass = (day) => {
  const copy = new Date(now.value);
  if (day.getDate() < copy.getDate()) {
    return 'opacity-50'
  }
  if (
      day.getMonth() === copy.getMonth()
      && day.getFullYear() === copy.getFullYear()
      && day.getDate() === copy.getDate()
  ) {
    return 'border-primary border-2';
  }
  return '';
}

// adding and removing events during mounted cycles
onMounted(() => {
  generateDays();
  window.addEventListener('keydown', keydown);
  window.addEventListener('keyup', keyup);
  window.addEventListener('mousedown', mousedown);
  window.addEventListener('mouseup', mouseup);
})
onUnmounted(() => {
  window.removeEventListener('keydown', keydown);
  window.removeEventListener('keyup', keyup);
  window.removeEventListener('mousedown', mousedown);
  window.removeEventListener('mouseup', mouseup);
})

// helper variables to check if user is dragging a trip
const shiftKey = ref(false);
const mouseDown = ref(false);
const isDragging = computed(() => {
  return shiftKey.value && mouseDown.value;
})

// keyboard related actions
function keydown(ev) {
  let {key} = ev;
  if (key === 'Shift') {
    shiftKey.value = true;
  }
}

function keyup(ev) {
  let {key} = ev;
  if (key === 'Shift') {
    shiftKey.value = false;
  }
}

// mouse related actions
function mousedown(ev) {
  mouseDown.value = true;
}

function mouseup(ev) {
  mouseDown.value = false;
}

const router = useRouter();

// if there is a trip then redirects the user
function handleClick(day) {
  if (!!day.trip?.startDate) {
    router.push('/locations/' + day.trip.location.code)
  }
}

const draggedDay = ref(null);

function dayMouseDown(day) {
  draggedDay.value = day;
}

// if is dragging actually reschedule the user's trip
function dayMouseUp(day) {
  if (!isDragging.value) {
    return;
  }
  const isStart = draggedDay.value.iso === draggedDay.value.trip.startDate;
  // finding the current dragged trip
  const found = trips.value.find(t => {
    return t.startDate === draggedDay.value.trip.startDate &&
        t.endDate === draggedDay.value.trip.endDate
  });
  // setting dates for easier replacement after
  let startDate = found.startDate;
  let endDate = found.endDate;
  if (isStart) startDate = day.iso
  else endDate = day.iso

  // cheching if there is conflict schedule
  let copyTrips = [...trips.value];
  copyTrips = copyTrips.filter(t => t.startDate !== found.startDate && t.endDate !== found.endDate);
  let tripsFound = copyTrips.filter(t => {
    let isAfter = t.startDate <= endDate;
    let isBefore = t.endDate >= startDate;
    return isAfter && isBefore;
  });
  // if trip is found, shows a warning and nothing is done
  if (tripsFound.length) {
    addAlert('Scheduling conflict', 'danger');
    return;
  }
  if (startDate === endDate || endDate < startDate) {
    addAlert('The end date should be after the start date', 'danger');
    return;
  }
  // if code reach here then is able to update the founded trip
  found.startDate = startDate;
  found.endDate = endDate;
  // reset the days
  generateDays();
}
</script>

<template>
  <h1>Trip management</h1>
  <p class="text-body-secondary">*Drag the first or the last day to reschedule</p>
  <p></p>
  <div class="grid-calendar">
    <div class="bg-body-secondary text-center p-2" v-for="day in weekDays">
      {{ day }}
    </div>
    <div
        v-for="day in days"
        class="box-day border p-2 position-relative"
        :class="[
            getDayClass(day.datetime),
            ]"
        @click="handleClick(day)"
        @mouseup.prevent="dayMouseUp(day)"
        @mousedown.prevent="dayMouseDown(day)"
    >
      <img-get v-if="day?.trip?.location" :image="day?.trip?.information?.image" class="img-total"/>
      <div class="h-100 w-100 position-relative z-1 fw-bold">
        <div class="">
          <span class="badge text-bg-light">
          {{ day.dayFormat }}
          </span>
        </div>
        <div>
          <p class="badge text-bg-light btn">{{ day?.trip?.location?.name }}</p>
          <p class="badge text-bg-light" v-if="day.trip?.startDate === day.iso">Start date!</p>
          <p class="badge text-bg-light" v-if="day.trip?.endDate === day.iso">End date!</p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.grid-calendar {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
}

.box-day {
  min-height: 120px;
}

.img-total {
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  object-fit: cover;
  filter: opacity(.8);
}
</style>