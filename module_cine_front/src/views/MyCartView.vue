<script setup>
import {computed, onMounted, ref} from "vue";
import {api} from "@/helpers/api.js";
import {formatStringDate, formatValueToPrice, globalCombo, globalSelectedSeats, loading} from "@/helpers/global.js";
import Spinner from "@/components/Spinner.vue";
import ImgApi from "@/components/ImgApi.vue";
import {useRouter} from "vue-router";

const session = ref({});
const props = defineProps(['id'])

const comboTotal = computed(() => {
  let total = 0;
  globalCombo.value.forEach(c => {
    total += c.quantity * c.price;
  })
  return total;
})

async function loadModels() {
  const [res, data] = await api.get('sessions/' + props?.id)
  session.value = data;
}

onMounted(() => {
  loadModels();
})

const router =useRouter();
function nextPage(){
    router.push('/wallet/' + props.id);
}
</script>

<template>
  <template v-if="!loading && session">
    <h1 class="text-center">Resumo do pedido</h1>
    <div class="card card-body">
      <h2>Sessão</h2>
      <div class="row g-2">
        <div class="col-12 col-sm-6">
          <img-api :image="session.movie?.image" class="w-100 rounded-2"/>
        </div>
        <div class="col">
          <h3>{{ session.movie?.title }}</h3>
          <p class="text-body-secondary">{{ formatStringDate(session.session_date) }}</p>
        </div>
      </div>
      <h3>Assentos</h3>
      <div class="hstack gap-1">
        <span class="fw-bold" v-for="seat in globalSelectedSeats">{{ seat.code }}</span>
      </div>
      <p class="text-body-secondary">{{ globalSelectedSeats.length }} Ingressos</p>
      <h3>Combos</h3>
      <div class="card my-2" v-for="combo in globalCombo">
        <div class="row g-0">
          <div class="col-3">
            <img-api class="w-100 h-100 object-fit-cover" :image="combo.image"/>
          </div>
          <div class="col">
            <div class="card-body">
              <h4>{{ combo.name }}</h4>
              <p class="card-text">{{ combo.quantity }}x</p>
              <p class="text-success">{{ formatValueToPrice(combo.price) }}</p>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="hstack justify-content-between">
        <h3>Total</h3>
        <p class="text-success fs-1">{{formatValueToPrice(comboTotal)}}</p>
      </div>
      <button class="btn btn-primary" @click="nextPage">Continue</button>
    </div>
  </template>
  <spinner v-else></spinner>
</template>

<style scoped>

</style>