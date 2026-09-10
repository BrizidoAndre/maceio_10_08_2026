<script setup>
import {computed, ref} from "vue";
import {getRelatedInfo, local} from "@/helpers/global.js";
import ImgGet from "@/components/Core/ImgGet.vue";
import {useModal} from "@/helpers/useModal.js";
import ModalCreateTrip from "@/components/Modal/ModalCreateTrip.vue";
import CardSugestion from "@/components/CardSugestion.vue";

const props = defineProps(['id'])
const localCountry = computed(() => {
  return local.value.find(l => l.code === props?.id);
})
const information = computed(() => {
  return getRelatedInfo(localCountry.value)
})
const suggestions = computed(() => {
  let copyLocal = [...local.value]
  copyLocal = copyLocal.filter(l => l.continent === localCountry.value.continent && l.name !== localCountry.value.name);
  let copyInfo = copyLocal.map(c => {
    const inf = getRelatedInfo(c);
    return inf;
  })

  return copyInfo;
})
const indexSuggestion = ref(0);
const selectedSuggestion = computed(() => {
  let index = (indexSuggestion.value + suggestions.value.length) % suggestions.value.length;
  return suggestions.value[index];
})
const prevSelectedSuggestion = computed(() => {
  let index = (indexSuggestion.value - 1 + suggestions.value.length) % suggestions.value.length;
  return suggestions.value[index];
})
const nextSelectedSuggestion = computed(() => {
  let index = (indexSuggestion.value + 1 + suggestions.value.length) % suggestions.value.length;
  return suggestions.value[index];
})

const modal = useModal();

function openModal() {
  modal.open(ModalCreateTrip, {
    'location': {...localCountry.value},
    'information': {...information.value},
  });
}
</script>

<template>
  <div class="row">
    <div class="col-12 col-md-3">
      <img-get :image="information.image" class="w-100 rounded-3"/>
    </div>
    <div class="col-12 col-md">
      <h1>{{ localCountry?.name }} <span class="fs-4 text-body-secondary">{{ localCountry.acronym }}</span></h1>
      <p>Continent: <span class="text-capitalize">{{ localCountry.continent }}</span></p>
      <p>Area: {{ information.area }}km</p>
      <p>Languagues: <span class="me-2 fw-bold fst-italic" v-for="lang in information.languages">{{ lang }}</span></p>
      <p>{{ information.description }}</p>
      <button class="btn btn-success" @click="openModal">Schedule a trip</button>
    </div>
  </div>
  <div>
    <h2>Sugestions</h2>
    <div class="col-sm-8 col-md-5 mx-auto position-relative">
      <div class="w-100 d-flex gap-2">
        <card-sugestion class="position-absolute card-prev" :selectedSuggestion="prevSelectedSuggestion"/>
        <card-sugestion class="position-relative z-2 img-darker" :selectedSuggestion="selectedSuggestion"/>
        <card-sugestion class="position-absolute card-next" :selectedSuggestion="nextSelectedSuggestion"/>
      </div>
    </div>
    <div class="hstack gap-2 justify-content-center mt-2 position-relative z-2">
      <button class="btn btn-secondary" @click="indexSuggestion--">Previous</button>
      <button class="btn btn-secondary" @click="indexSuggestion++">Next</button>
    </div>
  </div>
</template>

<style>

.card-prev {
  transform: translateX(-50%) translateY(20%) rotate(-20deg);
}

.card-next {
  transform: translateX(50%) translateY(20%) rotate(20deg);
}

.img-darker img {
  filter: brightness(.5);
}
</style>