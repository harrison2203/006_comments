<script setup>
import { useAuthStore } from '@/stores/Auth';
import { RouterLink } from 'vue-router';
import { ref } from 'vue'
import { createToaster } from "@meforma/vue-toaster";

const authUser = useAuthStore();
const userEmail = ref("");
const userPassword = ref("");
const toaster = createToaster();

async function loginUser() {
  try {
    await authUser.Authentification(userEmail.value, userPassword.value);
    toaster.success("Login success!!!");

		userEmail.value = "";
    userPassword.value = "";
		
  } catch (error) {
    toaster.error("Login failed. Please check your credentials.");
    console.error(error);
  }
}
</script>

<template>
	<form @submit.prevent>
		<ul>
			<li>
				<label>	Email</label>
				<input v-model="userEmail" type="text" id="email" name="user_email">
			</li>
			<li>
				<label>Password</label>
				<input v-model="userPassword" type="password" id="password" name="user_password">
			</li>
		</ul>
		<button @click="loginUser" type="submit">Login</button>
	</form>
</template>



<style scoped>

</style>