<script setup>
import {useModal} from "@/helpers/useModal.js";

const {isOpen, component, options, open, close} = useModal();
</script>

<template>
  <transition>
    <div class="position-fixed top-0 left-0 w-100 h-100 d-flex justify-content-center align-items-center" v-if="isOpen">
      <div class="container-wrapper bg-body-tertiary rounded-3 p-2" @click.stop>
        <component @close="close" :is="component" v-bind="options"></component>
      </div>
    </div>
  </transition>
</template>

<style scoped>
.v-enter-from,
.v-leave-to {
  opacity: 0;
}

.v-enter-active,
.v-leave-active {
  transition: .4s;
}

.position-fixed {
  background: rgba(0, 0, 0, .8);
}

.container-wrapper {
  width: clamp(300px, 80%, 900px);
}
</style>