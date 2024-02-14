<script setup>
import axios from 'axios'
import { ref } from "vue";
import { createToaster } from "@meforma/vue-toaster";
import { RouterLink } from 'vue-router';

const toaster = createToaster();
const userName = ref("");
const userEmail = ref("");
const userPassword = ref();

//const signInInfo = ref ({
//	value: userName,
//	alertMessage: "le test",
//})

axios.defaults.baseURL = 'http://localhost:8000';
axios.defaults.headers.common['Content-Type'] = 'application/json';

async function Register() {
	try {
		const response = await axios.post('/api/create-user', {
			name: userName.value,
			email: userEmail.value,
			password: userPassword.value
		});

		if(userName.value === "" && userEmail.value !== ""){
			signInInfo.value.alertMessage = "Information manquante ..."
		}
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
	<div class="container-signin__form">
		<form @submit.prevent class="form-user__registration">
				<h1 class="general__title">Sign up !</h1>
				<div class="menu__option">
					<input class="option__input" v-model="userName" type="text" id="name" placeholder="Name" name="user_name">
				</div>
				<!--<p v-if="signInInfo.alertMessage">
					{{ signInInfo.alertMessage }}
				</p>
				-->
				<div class="menu__option">
					<input class="option__input" v-model="userEmail" type="text" id="email" placeholder="Email" name="user_email">
				</div>
				<div class="menu__option">
					<input class="option__input" v-model="userPassword" type="password" id="password" placeholder="Password" name="user_password">
				</div>
			<Router-link class="login-logout-router__button" to="/login">
				<button class="button__submit" @click="Register()" type="submit">Create Account</button>
			</Router-link>
		</form>
	</div>
</template>

<style scoped>
.container-signin__form{
	display: flex;
  justify-content: center;
  align-items: center;
	height: 70rem;
}

.general__title{
	font-weight: bold;
	margin-bottom: 2rem;
	text-align: center;
}

.menu__option{
	margin-bottom: 2rem;
}

.option__input{
	height: 4.8rem;
	width: 50rem;
	border-width: 1px;
	border-color: black;
}

/* répété */
.button__submit{
	height: 4.8rem;
	width: 50rem;
	border-radius: 1rem;
	margin-top: 5rem;
}
</style>