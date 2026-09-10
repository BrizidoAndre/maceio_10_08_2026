<script setup>
import AppHeader from "@/components/AppHeader.vue";
import AppAlert from "@/components/AppAlert.vue";
import AppModal from "@/components/AppModal.vue";
</script>

<template>
  <AppHeader/>
  <main class="container py-3">
    <RouterView/>
  </main>
  <app-alert></app-alert>
  <app-modal></app-modal>
</template>

<style scoped>

</style>
