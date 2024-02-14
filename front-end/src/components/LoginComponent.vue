<script setup>
import { useAuthStore } from '@/stores/Auth';
import { RouterLink } from 'vue-router';
import { ref, defineEmits } from 'vue'
import { createToaster } from "@meforma/vue-toaster";

const authUser = useAuthStore();
const userEmail = ref("");
const userPassword = ref("");
const toaster = createToaster();
//const emits = defineEmits(['userLoggedIn']);

async function loginUser() {
  try {
    await authUser.Authentification(userEmail.value, userPassword.value);
		
    toaster.success("Login success!!!");

		userEmail.value = "";
    userPassword.value = "";
		//emits('userLoggedIn', true);

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
				<input class="email__input" v-model="userEmail" type="text" id="email" name="user_email">
			</div>

			<div class="login-container__password">
				<input class="password__input" v-model="userPassword" type="password" id="password" name="user_password">
			</div>

			<RouterLink class="login-logout-router__button" to="/">
				<button class="button__submit" @click="loginUser" type="submit">Login</button>
			</RouterLink>
		</form>
	</div>
</template>



<style scoped>

.container-login__form{
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	height: 70rem;
}


.general__title{
	font-weight: bold;
	margin-bottom: 2rem;
	text-align: center;
}

.login-container__email,
.login-container__password {
	margin-bottom: 2rem;
}

.email__input{
	height: 4.8rem;
	width: 50rem;
	border-width: 1px;
	border-color: black;
}

.password__input{
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