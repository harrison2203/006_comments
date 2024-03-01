<script setup>
import { ref, reactive } from "vue";
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/Auth';
import GeneralButtonComponent from './Buttons/GeneralButtonComponent.vue';
import LoginSigninButtonComponent from "./Buttons/LoginSigninButtonComponent.vue";


const router = useRouter();
const authStore = useAuthStore();
const userName = ref("");
const userEmail = ref("");
const userPassword = ref();
const countNumbers = ref(0);
const buttonCreateAccount = "Create Account";

const signInInfo = reactive ({
	alert: "",
	messageError: null,
	hasError: null,
})

async function validateRules () {
	signInInfo.alert = "";
	signInInfo.messageError = null;
	signInInfo.hasError = null;
	countNumbers.value = 0;

	if(userName.value && userEmail.value && userPassword.value) {
		if (userPassword.value.match(/\d/g)) {
			for(let i = 0; i < userPassword.value.length; i ++) {
				if(!isNaN(parseInt(userPassword.value[i]))) {
					countNumbers.value ++;
				}
			};
			if (countNumbers.value <=  3) {
				(console.log("la value ça va pas", countNumbers));
				signInInfo.messageError = true;
				signInInfo.alert = "the password field must have at least  numbers";
				return;
			};
		}
		if (userPassword.value.length < 8) {
			console.log("THE LENGTH", userPassword)
			signInInfo.alert = "The password field must be at least 8 characters.";
			signInInfo.messageError = true;
			return;
		};

		signInUser();

	} else if (userName.value || userEmail.value || userPassword.value){
		signInInfo.alert = "All fields are mandatory";
		signInInfo.messageError = true;
		signInInfo.hasError = true;
	} else {
		signInInfo.alert = "Sign in failed, try again please!";
		signInInfo.messageError = true;
	}
}

async function signInUser () {
	try {
		await authStore.singInStore(userName.value, userEmail.value, userPassword.value);
		router.push('/login');
	} catch (error) {
		console.log(error)
	}
}
</script>

<template>
	<div class="container-signin__form">
		<form @submit.prevent class="form-user__registration">
				<h1 class="general__title">Sign In !</h1>
				<div class="menu__option">
					<input class="option__input" v-model="userName" type="text" id="name" placeholder="Name" name="user_name">
				</div>
				<div class="menu__option">
					<input class="option__input" v-model="userEmail" type="email" id="email" placeholder="Email" name="user_email">
				</div>
				<div class="menu__option">
					<input class="option__input" v-model="userPassword" type="password" id="password" placeholder="Password" name="user_password">
				</div>
				<div :class="{ 'handle__errors': signInInfo.messageError, 'font-size-x-large': signInInfo.hasError }">
						{{ signInInfo.alert }}
				</div>
			<div class="login-logout-router__button" to="/login">
				<LoginSigninButtonComponent @click="validateRules" type="submit" :buttonText="buttonCreateAccount"></LoginSigninButtonComponent>
			</div>
		</form>
	</div>
</template>

<style scoped>
.container-signin__form {
	display: flex;
  justify-content: center;
  align-items: center;
	height: 70rem;
}
.general__title {
	font-weight: bold;
	margin-bottom: 2rem;
	text-align: center;
}
.menu__option {
	margin-bottom: 2rem;
}
.option__input {
	height: 4.8rem;
	width: 50rem;
	border-width: 1px;
	border-color: black;
}
.handle__errors {
 color: red;
}
.font-size-xx-large {
	font-size: xx-large;
}
.option__input[type=text], .option__input[type="email"], .option__input[type="password"] {
    padding: 2rem;
    font-weight: normal;
}
::placeholder {
	font-weight: bold;
}
</style>