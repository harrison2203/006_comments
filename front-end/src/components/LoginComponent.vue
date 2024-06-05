<script setup>
import { useAuthStore } from '@/stores/Auth';
import { useRouter } from 'vue-router';
import { ref } from 'vue'
import { createToaster } from "@meforma/vue-toaster";
import LoginSigninButtonComponent from './Buttons/LoginSigninButtonComponent.vue';

const authStore = useAuthStore();
const userEmail = ref("");
const userPassword = ref("");
const toaster = createToaster();
const router = useRouter();
const buttonLogin = "Login";

async function loginUser() {
  try {
    await authStore.authentification(userEmail.value, userPassword.value);
		// faire un if pour comparer les valeurs de l'input avec la bd
    toaster.success("Login success!!!");
		router.push('/');
  } catch (error) {
    toaster.error("Login failed. Please check your credentials.");
    console.error(error);
  }
}
</script>

<template>
	<div class="container-login__form">
		<form @submit.prevent class="form-user__login">
			<h1 class="general__title">Login !</h1>
			<div class="login-container__email">
				<input class="email__input" v-model="userEmail" type="email" placeholder="mail" id="email" name="user_email">
			</div>
			<div class="login-container__password">
				<input class="password__input" v-model="userPassword" type="password" placeholder="password" id="password" name="user_password">
			</div>
			<div class="login-logout-router__button">
				<LoginSigninButtonComponent @click="loginUser" type="submit" :buttonText="buttonLogin"></LoginSigninButtonComponent>
			</div>
		</form>
	</div>
</template>

<style scoped>

.container-login__form {
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	height: 70rem;
}
.general__title {
	font-weight: bold;
	margin-bottom: 2rem;
	text-align: center;
}
.login-container__email,
.login-container__password {
	margin-bottom: 2rem;
}
.email__input, .password__input{
	height: 4.8rem;
	width: 50rem;
	border-width: 1px;
	border-color: black;
}
.email__input, .password__input[type="email"] {
	padding: 2rem;
	font-weight: normal;
}
.password__input[type="password"] {
	padding: 2rem;
	font-weight: normal;
}
::placeholder {
	font-weight: bold;
}

</style>