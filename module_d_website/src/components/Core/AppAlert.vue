<script setup>
import {alerts} from "@/helpers/addAlert.js";
</script>

<template>
  <div class="position-fixed end-0 bottom-0 m-5">
    <transition-group>
      <div v-for="alert in alerts" class="alert" :key="alert.id" :class="'alert-' + alert.type">
        {{ alert.message }}
      </div>
    </transition-group>
  </div>
</template>

<style scoped>
.v-enter-active,
.v-leave-active,
.v-move {
  transition: .4s;
}

.v-leave-active {
  position: absolute;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
  transform: translateX(100%);
}

.position-fixed {
  z-index: 99 !important;
}
</style>