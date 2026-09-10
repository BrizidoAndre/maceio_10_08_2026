<script setup>

import {computed, onMounted, ref} from "vue";
import {api} from "@/helpers/api.js";
import {useRouter} from "vue-router";
import {formatStringDate, globalSelectedSeats, loading} from "@/helpers/global.js";
import Spinner from "@/components/Spinner.vue";
import Badge from "@/components/Badge.vue";
import {addAlert} from "@/helpers/addAlert.js";

const props = defineProps(['id'])
const session = ref(null);
const seats = ref([]);
const letters = computed(() => {
  const abc = new Set();
  seats.value.forEach(s => {
    let letter = s.code.slice(0, 1);
    abc.add(letter);
  })
  return [...abc];
})

async function loadModels() {
  const [res, data] = await api.get('sessions/' + props?.id)
  session.value = data;
}

async function loadSeats() {
  const [res, data] = await api.get('sessions/' + props?.id + '/seats')
  seats.value = data.seats;
}

onMounted(() => {
  loadModels();
  loadSeats();
})
const router = useRouter();
const selectedSeats = ref([]);

function addSeat(seat) {
  if (seat.status === 'available') {
    const copySelected = [...selectedSeats.value];
    const has = copySelected.some(c => {
      return c.code === seat.code;
    })
    if (has) {
      selectedSeats.value = selectedSeats.value.filter(s => s.code !== seat.code);
    } else {
      selectedSeats.value.push({...seat})
    }
  }
}

const getSelectedClass = (seat) => {
  const copySelected = [...selectedSeats.value];
  const has = copySelected.some(c => {
    return c.code === seat.code;
  })
  if (has) {
    return 'bg-success';
  }
  return '';
}

function nextPage() {
  if (!selectedSeats.value.length) {
    addAlert('Select a seat to continue', 'warning');
    return;
  }
  globalSelectedSeats.value = [...selectedSeats.value];
  router.push(`/sessions/${props.id}/combos`)
}
</script>

<template>
  <template v-if="!loading && session">
    <button @click="router.back()" class="btn btn-secondary">Go back</button>
    <h1>Seleção de assentos</h1>
    <div class="card card-body text-center">
      <h2>{{ session?.movie?.title }}</h2>
      <p>{{ formatStringDate(session.session_date) }}</p>
      <p class="hstack gap-1 justify-content-center">
        <badge class="text-bg-secondary">Occupied</badge>
        <badge class="text-bg-primary">Available</badge>
        <badge class="text-bg-success">Selected</badge>
      </p>
    </div>
    <div class="mt-2">
      <div class="text-bg-secondary w-100 p-2 rounded-circle text-center">
        Tela
      </div>
      <div class="d-flex mt-2">
        <div class="d-flex flex-column justify-content-between gap-1 me-1">
          <span class="seat-width" v-for="letter in letters">{{ letter }}</span>
        </div>
        <div class="grid-movie flex-grow-1" :style="{'--columns': seats.length / letters.length}">
          <div
              v-for="(seat,i) in seats"
              class="seat-box"
              :class="[
              {  'seat-taken': seat.status === 'occupied',},
                  getSelectedClass(seat),
              ]"
              @click="addSeat(seat)"
          >
          </div>
        </div>
      </div>
      <div class="hstack justify-content-between mt-2">
        <div class="">
          <h3>Selected: </h3>
          <div class="hstack gap-2">
            <span v-for="seat in selectedSeats">{{ seat.code }}</span>
          </div>
        </div>
        <button class="btn btn-primary" @click="nextPage">Continue</button>
      </div>
    </div>
  </template>
  <spinner v-else></spinner>
</template>

<style scoped>
.grid-movie {
  display: grid;
  grid-template-columns:repeat(var(--columns, 10), 1fr);
  gap: 1rem;
}

.seat-box {
  width: 30px;
  aspect-ratio: 1;
  background: var(--bs-primary-bg-subtle);
  border-radius: .5rem;
}

.seat-taken {
  background: var(--bs-secondary)
}

.seat-width {
  width: 30px;
  height: 30px;
}
</style>