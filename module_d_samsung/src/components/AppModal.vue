<script setup>
import {useModal} from "@/helpers/useModal.js";
import {onMounted, onUnmounted} from "vue";

const {component, options, isOpen, close, open} = useModal();
onMounted(()=>{
  window.addEventListener('keydown',keydown);
})
onUnmounted(()=>{
  window.removeEventListener('keydown',keydown);
})
function keydown(ev){
  let {key} = ev;
  if (key === 'Escape') {
    close();
  }
}
</script>

<template>
  <teleport to="body">
    <transition>
      <div class="position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center z-3"
           v-if="isOpen"
           @click="close">
        <div class="container-modal rounded-3 bg-body-tertiary p-3" @click.stop>
          <component :is="component" v-bind="options" @close="close"></component>
        </div>
      </div>
    </transition>
  </teleport>
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

.position-fixed {
  background: rgba(0, 0, 0, .7);
}

.container-modal {
  width: clamp(300px, 80%, 800px);
  height: 500px;
  overflow-y: auto;
}
</style>