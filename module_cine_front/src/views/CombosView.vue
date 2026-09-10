<script setup>

import {computed, onMounted, ref} from "vue";
import {api} from "@/helpers/api.js";
import {useRouter} from "vue-router";
import ImgApi from "@/components/ImgApi.vue";
import {formatValueToPrice, globalCombo, loading} from "@/helpers/global.js";
import Spinner from "@/components/Spinner.vue";

const props = defineProps(['id'])
const session = ref({});
const combos = ref([]);
const comboQuantity = computed(() => {
  let total = 0;
  combos.value.forEach(c => {
    if (c.quantity > 0) {
      total++;
    }
  })
  return total;
})
const comboTotal = computed(() => {
  let total = 0;
  combos.value.forEach(c => {
    total += c.quantity * c.price;
  })
  return total;
})

async function loadCombos() {
  const [res, data] = await api.get('combos')
  combos.value = data.map(d => {
    return {
      ...d,
      quantity: 0,
    }
  })
}

onMounted(() => {
  loadCombos();
})

const router = useRouter();

function nextPage() {
  const copy = [...combos.value];
  globalCombo.value = copy.filter(c => c.quantity > 0);
  router.push('/cart/' + props.id)
}
</script>

<template>
  <template v-if="!loading">
    <h1>Combos</h1>
    <div class="row">
      <div class="col-12 col-md-4" v-for="combo in combos">
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-4">
              <img-api :image="combo.image" class="img-fluid rounded-start h-100 object-fit-cover"/>
            </div>
            <div class="col-8">
              <div class="card-body">
                <h3 class="card-title">{{ combo.name }}</h3>
                <p class="card-text">{{ combo.description }}</p>
                <p class="card-text text-success fw-bold">{{ formatValueToPrice(combo.price) }}</p>
                <div class="hstack gap-1">
                  <button class="btn btn-danger" @click="combo.quantity = Math.max(0,combo.quantity -1)">Remove</button>
                  <span class="fs-2 mx-3">{{ combo.quantity }}</span>
                  <button class="btn btn-primary" @click="combo.quantity +=1">Add</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <button class="w-100 alert alert-success hstack justify-content-between" @click="nextPage">
      <span class="fs-3">Ver meu pedido ({{ comboQuantity }})</span>
      <span class="fs-3 font-bold">{{ formatValueToPrice(comboTotal) }}</span>
    </button>
  </template>
  <template>
    <spinner></spinner>
  </template>
</template>