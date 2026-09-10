<script setup>
import {reactive} from "vue";
import Field from "@/components/Field.vue";
import {api} from "@/helpers/api.js";
import {token} from "@/helpers/global.js";
import {useRouter} from "vue-router";

const router = useRouter();
const user = reactive({
  email: "customer@example.com",
  password: "password"
})

async function submit() {
  const [res, data] = await api.post('auth/login', user);
  if (res.ok) {
    token.value = data.token;
    user.value = data.user;
    router.push('/');
  }
}
</script>

<template>
  <h1>Login</h1>
  <form action="" @submit.prevent="submit">
    <field type="email" v-model="user.email">E-mail</field>
    <field type="password" v-model="user.password">Password</field>
    <button class="btn btn-primary w-100">Entrar</button>
    <div class="hstack justify-content-center mt-2">
      <a href="#" class="text-center">Esqueci minha senha</a>
    </div>
  </form>
  <p class="text-center mt-3">Ainda não tem conta? <a href="#">Cadastre-se</a></p>
</template>
