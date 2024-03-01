<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/stores/Auth';
import { createToaster } from "@meforma/vue-toaster";
import { RouterLink } from 'vue-router';
import GeneralButtonComponent from './Buttons/GeneralButtonComponent.vue';

const toaster = createToaster();
const authUser = useAuthStore();
const buttonName = "Logout";

async function logoutUser() {
  try {
    await authUser.logout();
  } catch (error) {
    toaster.error("Logout failed. ERROR!!!!! ");
    console.error(error);
  }
}
</script>

<template>
	<RouterLink to="/">
		<GeneralButtonComponent :typeOfButton="buttonName" @click="logoutUser"></GeneralButtonComponent>
	</RouterLink>
</template>
