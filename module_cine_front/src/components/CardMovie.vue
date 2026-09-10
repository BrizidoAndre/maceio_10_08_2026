<script setup>
import ImgApi from "@/components/ImgApi.vue";
import Badge from "@/components/Badge.vue";

const props = defineProps(['movie']);
</script>

<template>
  <router-link :to="'/movies/' + movie.id" class="text-decoration-none card">
    <img-api :image="movie.image" class="card-img-top"/>
    <div class="card-body">
      <h3 class="card-title">{{ movie.title }}</h3>
      <p class="card-text">{{ movie.description }}</p>
      <p class="text-body-secondary">{{ movie?.release_date?.slice(0, 10) }}</p>
      <badge :class="[movie.in_theaters ? 'text-bg-success':'text-bg-secondary']">
        {{ movie.in_theaters ? 'Em cartaz!' : 'Em breve' }}
      </badge>
    </div>
  </router-link>
</template>