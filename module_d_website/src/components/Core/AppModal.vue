<script setup>
import {useModal} from "@/helpers/useModal.js";

const {options, component, isOpen, open, close} = useModal();
</script>

<template>
  <transition>
    <div
        class="position-fixed w-100 h-100 top-0 left-0 d-flex justify-content-center align-items-center" @click="close"
        v-if="isOpen">
      <div class="container-wrapper rounded-3 p-3 bg-body-tertiary" @click.stop>
        <component :is="component" v-bind="options" @close="close"></component>
      </div>
    </div>
  </transition>
</template>

<style scoped>
.position-fixed {
  background: rgba(0, 0, 0, .7);
  z-index: 4;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}

.v-enter-active,
.v-leave-active {
  transition: .4s;
}

.container-wrapper {
  width: clamp(300px, 80%, 800px);
  max-height: 700px;
  overflow-y: auto;
}
</style>