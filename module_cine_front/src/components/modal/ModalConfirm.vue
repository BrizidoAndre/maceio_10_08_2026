<script setup>
import {computed} from "vue";

const emits = defineEmits(['close']);
const props = defineProps(['payment'])
const order = computed(() => {
  return String(Math.random()).slice(3)
})
</script>

<template>
  <h1 class="text-center">Confirmação</h1>
  <div class="text-center">
    <p>Compra realizada com sucesso!</p>
    <p>Numero do pedido: #{{ order }}</p>
    <p>Enviamos os detalhes para seu e-mail.</p>
    <div class="vstack gap-2 align-items-center">
      <router-link @click="emits('close')" class="btn btn-secondary" to="/">Start another purchase</router-link>
      <router-link @click="emits('close')" class="text-uppercase fw-bold text-decoration-none fs-4" to="/">Voltar para a home</router-link>
    </div>
  </div>
</template>

<style scoped>

</style>