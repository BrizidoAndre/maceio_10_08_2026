<script setup>
import {computed, onMounted, ref} from "vue";
import {local} from "@/helpers/global.js";
import CardLocation from "@/components/CardLocation.vue";
import Field from "@/components/Field.vue";
import {useRoute} from "vue-router";

const route = useRoute();

const search = computed(() => {
  let query = route?.query;
  return query?.local ?? '';
})

const divided = computed(() => {
  return splitIntoLists()
});


const filters = ref([
  '',
  '',
  '',
  '',
  '',
]);

function splitIntoLists() {
  const locationsCopy = [...local.value];
  let continents = new Set();
  locationsCopy.forEach(l => {
    continents.add(l.continent);
  })
  continents = [...continents];
  const splitted = [
    locationsCopy.filter(l => l.continent === continents[0]).filter(l => l.name.includes(filters.value[0])),
    locationsCopy.filter(l => l.continent === continents[1]).filter(l => l.name.includes(filters.value[1])),
    locationsCopy.filter(l => l.continent === continents[2]).filter(l => l.name.includes(filters.value[2])),
    locationsCopy.filter(l => l.continent === continents[3]).filter(l => l.name.includes(filters.value[3])),
    locationsCopy.filter(l => l.continent === continents[4]).filter(l => l.name.includes(filters.value[4])),
  ]
  return splitted;
}

const anythingFound = computed(() => {
  let found = local.value.find(l => l.name.includes(search.value));
  let somethingFound = !!found;
  return somethingFound;
})
const getCountryClass = (country) => {
  if (search.value === '' || !anythingFound.value) {
    return '';
  }
  if (country?.name.includes(search.value)) {
    return 'border border-primary border-3';
  }
  return 'opacity-50';
}

const getColClass = (countries) => {
  if (!anythingFound.value) {
    return '';
  }
  let found = countries.find(c => c.name.includes(search.value))
  if (!found) {
    return 'overflow-y-hidden'
  }
}
</script>

<template>
  <div class="">
    <h1>Locations</h1>
    <p class="text-body-secondary">*Press on a location to go to its page</p>
    <div class="row g-1">
      <div
          class="col min-height"
          :class="getColClass(countries)"
          v-for="(countries,i) in divided"
      >
        <field v-model="filters[i]">Search</field>
        <card-location
            v-for="country in countries"
            :location="country"
            :class="getCountryClass(country, countries)"
        />
      </div>
    </div>
  </div>
</template>

<style>
.min-height {
  height: 80vh;
  overflow-y: auto;
}
</style>
