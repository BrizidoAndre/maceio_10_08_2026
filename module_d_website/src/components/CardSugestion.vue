<script setup>

import ImgGet from "@/components/Core/ImgGet.vue";

const props = defineProps(['selectedSuggestion'])
</script>

<template>
  <transition mode="out-in">
    <router-link :to="'/locations/' + props.selectedSuggestion['country-code']" class="card text-bg-dark"
                 :key="props.selectedSuggestion['country-code']">
      <img-get :image="selectedSuggestion?.image" class="card-img"/>
      <div class="card-img-overlay">
        <h3>{{ selectedSuggestion['country-code'] ?? '' }}</h3>
        <p class="card-text">{{ selectedSuggestion?.description }}</p>
      </div>
    </router-link>
  </transition>
</template>

<style scoped>
.v-enter-active,
.v-leave-active {
  transition: .4s;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>