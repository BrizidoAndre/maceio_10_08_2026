<script setup>

import {side, token} from "@/helpers/global.js";
import {api} from "@/helpers/api.js";

async function logout() {
  const [res, data] = await api.post('auth/logout', {});
}
</script>

<template>
  <header class="container">
    <div class="bg-body-terticary">
      <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
          <router-link class="navbar-brand" to="/">Cinema Movies</router-link>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                  aria-label="Toggle navigation" @click="side = !side">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent" :class="{'show': side}">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <template v-if="token">
                <li class="nav-item">
                  <router-link class="nav-link" to="/">Home</router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link" to="/wallet/1">Customer Wallet</router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link" to="/profile">My page</router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link" to="/cart/1">My cart</router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link" to="/orders">My orders</router-link>
                </li>
                <li class="nav-item">
                  <router-link class="btn btn-danger" to="/login" @click="logout">Logout</router-link>
                </li>
              </template>
              <template v-else>
                <li class="nav-item">
                  <router-link class="nav-link" to="/login">Login</router-link>
                </li>
              </template>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
</template>

<style scoped>

</style>