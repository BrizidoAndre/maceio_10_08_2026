<script setup>

import {computed, onMounted, reactive, ref} from "vue";
import {api} from "@/helpers/api.js";
import {formatValueToPrice, globalCombo, globalSelectedSeats} from "@/helpers/global.js";
import Field from "@/components/Field.vue";
import CheckField from "@/components/CheckField.vue";
import {useRouter} from "vue-router";
import {useModal} from "@/helpers/useModal.js";
import ModalConfirm from "@/components/modal/ModalConfirm.vue";

const props = defineProps(['id'])
const me = ref({});
const payment = reactive({
  card: {
    number: "",
    holder: "",
    expiration: "",
    cvv: ""
  },
  amount: '',
})

const paymentOptions = reactive({
  useWallet: false,
  creditCard: false,
})

async function loadModels() {
  const [res, data] = await api.get('me')
  me.value = data;
}

onMounted(() => {
  loadModels();
})

const comboTotal = computed(() => {
  let total = 0;
  globalCombo.value.forEach(c => {
    total += c.quantity * c.price;
  })
  return total;
})

async function submit() {
  const formattedCombos = globalCombo.value.map(c => {
    return {
      combo_id: c.id,
      quantity: c.quantity,
    }
  })
  const formattedSeats = globalSelectedSeats.value.map(s => {
    return s.id;
  })
  const wallet_amount = paymentOptions.useWallet ? me.value.wallet_balance : 0;
  console.log(props);
  const post = {
    session_id: props.id,
    seat_ids: formattedSeats,
    combos: formattedCombos,
    card: payment.card,
    wallet_amount
  }
  const [res, data] = await api.post('purchases', post);
  if (res.ok) {
    paymentReceived.value = data;
    modal.open(ModalConfirm, {
      payment: paymentReceived.value,
    })
  }
}

const modal = useModal();
const paymentReceived = ref({});

</script>

<template>
  <h1>Pagamento</h1>
  <hr>
  <form action="" @submit.prevent="submit">
    <div class="alert alert-success hstack justify-content-between">
      <p class="m-0">Saldo na carteira</p>
      <p class="m-0">{{ formatValueToPrice(me.wallet_balance) }}</p>
    </div>
    <h2>Forma de pagamento</h2>
    <check-field v-model="paymentOptions.useWallet">Usar saldo na carteira</check-field>
    <check-field v-model="paymentOptions.creditCard">Cartão de crédito</check-field>
    <div class="card card-body">
      <field v-model="payment.card.number">Número do cartão</field>
      <field v-model="payment.card.holder">Nome do cartão</field>
      <field placeholder="MM/AA" v-model="payment.card.expiration" type="text" pattern="\d{2}/\d{2}">Validade</field>
      <field v-model="payment.card.cvv" type="text" pattern="\d{3}">CVV</field>
      <div class="hstack justify-content-between">
        <p>Total a pagar:</p>
        <p>{{ formatValueToPrice(comboTotal) }}</p>
      </div>
      <button class="btn btn-success">Pagar</button>
    </div>
  </form>
</template>

<style scoped>

</style>