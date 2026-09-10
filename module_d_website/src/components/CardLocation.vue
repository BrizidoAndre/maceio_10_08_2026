<script setup>
import {computed} from "vue";
import {getRelatedInfo} from "@/helpers/global.js";
import ImgGet from "@/components/Core/ImgGet.vue";

const props = defineProps(['location'])
const info = computed(() => {
  return getRelatedInfo(props.location);
})
</script>

<template>
  <router-link :to="'/locations/' + props.location.code" class="card my-2 text-decoration-none">
    <img-get :image="info?.image" class="card-img-top"></img-get>
    <div class="card-body">
      <h3 class="card-title">{{ location.name }}</h3>
    </div>
  </router-link>
</template>

<style scoped>

</style>