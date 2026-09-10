<script setup>
import {onMounted, ref} from "vue";
import {api} from "@/helpers/api.js";
import {loading, movies} from "@/helpers/global.js";
import Spinner from "@/components/Spinner.vue";
import {useRouter} from "vue-router";
import CardSession from "@/components/CardSession.vue";

const props = defineProps(['id'])
const movie = ref(null);

async function loadModels() {
  const [res, data] = await api.get('movies/' + props?.id)
  movie.value = data;
}

onMounted(() => {
  loadModels();
})
const router = useRouter();
</script>

<template>
  <template v-if="!loading && movie">
    <h1>{{ movie.title }}</h1>
    <div class="alert alert-primary">
      <button class="btn btn-secondary mb-2" @click="router.back()">Go Back</button>
      <p class="m-0">{{ movie.description }}</p>
    </div>
    <div>
      <router-link
          v-for="session in movie.sessions"
          :to="'/sessions/' + session.id"
          class="text-decoration-none text-body"
      >
        <card-session :session="session" :movie="movie"></card-session>
      </router-link>
    </div>
  </template>
  <template v-else>
    <spinner/>
  </template>

</template>

<style scoped>

</style>