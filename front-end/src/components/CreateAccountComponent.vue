<script setup>
import axios from 'axios'
import { ref } from "vue";
import { createToaster } from "@meforma/vue-toaster";
import { useRoute } from 'vue-router';

const toaster = createToaster();
let route = useRoute();
const userName = ref("");
const userEmail = ref("");
const userPassword = ref();

axios.defaults.baseURL = 'http://localhost:8000';
axios.defaults.headers.common['Content-Type'] = 'application/json';

async function Register() {
	try {
		const response = await axios.post('/api/create-user', {
			name: userName.value,
			email: userEmail.value,
			password: userPassword.value
		});
		console.log(response)
		toaster.success("You have created your account");

		userName.value = "";
		userEmail.value = "";
		userPassword.value = "";

	} catch (error){
		toaster.error("A problem has ocurred");
		console.log(error);
	}
}
</script>

<template>
	<form @submit.prevent>
		<ul>
			<li>
				<label>Name</label>
				<input v-model="userName" type="text" id="name" name="user_name">
			</li>
			<li>
				<label>	Email</label>
				<input v-model="userEmail" type="text" id="email" name="user_email">
			</li>
			<li>
				<label>Password</label>
				<input v-model="userPassword" type="password" id="password" name="user_password">
			</li>
		</ul>
			<button @click="Register()" type="submit">Create Account</button>
	</form>
</template>

<style scoped>

</style>