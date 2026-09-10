<script setup>
import {onMounted, ref} from "vue";
import {api} from "@/helpers/api.js";
import CardMovie from "@/components/CardMovie.vue";
import {loading, movies} from "@/helpers/global.js";
import Spinner from "@/components/Spinner.vue";


async function loadModels() {
  const [res, data] = await api.get('movies')
  movies.value = data;
}

onMounted(() => {
  loadModels();
})
</script>

<template>
  <h1>Filmes</h1>
  <div class="row g-2" v-if="!loading">
    <div class="col-12 col-sm-4" v-for="movie in movies">
      <card-movie :movie="movie"/>
    </div>
  </div>
  <spinner v-else></spinner>
</template>
