<script setup>
import theme from "@/assets/svgs/theme-light.svg"
import fullscreen from "@/assets/svgs/fullscreen.svg"
import exportIcon from "@/assets/svgs/export.svg"
import importIcon from "@/assets/svgs/import.svg"
import ButtonIcon from "@/ButtonIcon.vue";
import {darkTheme, training} from "@/helpers/global.js";
import AppModal from "@/components/AppModal.vue";

// toggle between page full screen
function toogleFullScreen() {
  if (document.fullscreenElement) {
    document.exitFullscreen()
  } else {
    document.body.requestFullscreen();
  }
}

// get values to json
function exportJson() {
  const blob = new Blob([JSON.stringify(training.value)], {
    type: 'application/json',
  })
  const url = URL.createObjectURL(blob);
  const link = document.createElement('a');
  link.download = 'training';
  link.href = url;
  link.click();
  link.remove();
}

const jsonKeys = [
  'version',
  'trainingPeriod',
  'days'
]

// get json to values
function importJson(ev) {
  const file = ev.target.files[0];
  if (file.type !== 'application/json') {
    alert('The file type is not JSON!')
    return;
  }
  let error = false;
  const reader = new FileReader();
  reader.readAsText(file);
  reader.onload = () => {
    const result = JSON.parse(reader.result);
    jsonKeys.forEach(key => {
      if (!Object.hasOwn(result, key)) {
        error = true;
        alert(`The file must be on correct format! (Key missing: ${key})`)
      }
    })
    if (!error) {
      if (confirm('Are you sure you want to replace the data?')) {
        training.value = result;
      }
    }
  }
}
</script>

<template>
  <div class="d-flex flex-column min-vh-100">
    <!--    header sytling-->
    <header style="height: 80px"
            class="hstack justify-content-between container-fluid position-sticky top-0 bg-body z-1">
      <h1 class="fs-5">
        <img src="@/assets/images/gifts-logo.png" alt="GIFTS training" width="100" class="me-2">
        Training Manager
      </h1>
      <div class="hstack gap-2">
        <ButtonIcon :icon="theme" @click="darkTheme = !darkTheme">
          Dark
        </ButtonIcon>
        <ButtonIcon :icon="fullscreen" @click="toogleFullScreen">
          Fullscreen
        </ButtonIcon>
        <ButtonIcon :icon="exportIcon" @click="exportJson">
          Export
        </ButtonIcon>
        <input type="file" name="" id="file" class="d-none" @change="importJson">
        <label for="file" class="btn btn-primary d-flex flex-column align-items-center">
          <img :src="importIcon" alt="Theme" class="icon">
          <span>
            Import
          </span>
        </label>
      </div>
    </header>
    <!--    center contennt style-->
    <div class="flex-grow-1 d-flex">
      <!--      aside navigation-->
      <aside class="bg-body-secondary flex-shrink-0 container-fluid py-3" style="width: 200px">
        <nav>
          <router-link class="hstack gap-2 text-decoration-none font-bold rounded-3 p-2 nav-link" to="/">
            <img src="@/assets/svgs/calendar-month.svg" alt="Calencar icon" class="icon-side">
            <span>Month</span>
          </router-link>
          <router-link class="hstack gap-2 text-decoration-none font-bold rounded-3 p-2 nav-link" to="/kanban">
            <img src="@/assets/svgs/kanban.svg" alt="Calencar icon" class="icon-side">
            <span>Kanban</span>
          </router-link>
          <router-link class="hstack gap-2 text-decoration-none font-bold rounded-3 p-2 nav-link" to="/statistics">
            <img src="@/assets/svgs/statistics.svg" alt="Calencar icon" class="icon-side">
            <span>Statistics</span>
          </router-link>
        </nav>
      </aside>
      <!--      main content page-->
      <main class="bg-body flex-grow-1 p-3">
        <RouterView/>
      </main>
    </div>
    <!--    footer styling-->
    <footer class="position-sticky bottom-0 text-bg-dark w-100 hstack justify-content-between p-2">
      <p class="m-0">© HRDKorea. All rights reserved.</p>
      <p class="m-0">Powered by <a href="https://skillsit.eu/" class="text-primary">MITS</a></p>
    </footer>
  </div>
  <app-modal></app-modal>
</template>

<style>
.icon-side, .icon {
  width: 30px;
}

</style>

