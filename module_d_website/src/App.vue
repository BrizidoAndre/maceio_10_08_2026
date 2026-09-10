<script setup>
import AppHeader from "@/components/Core/AppHeader.vue";
import AppModal from "@/components/Core/AppModal.vue";
import AppAlert from "@/components/Core/AppAlert.vue";
</script>

<template>
  <AppHeader/>
  <main class="container py-3">
    <RouterView/>
  </main>
  <app-modal/>
  <app-alert></app-alert>
</template>

<style scoped>
</style>
