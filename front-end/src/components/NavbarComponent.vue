<script setup>
import { RouterLink } from 'vue-router';
import { computed, watchEffect, ref, defineEmits } from 'vue'
import LogoutComponent from '../components/LogoutComponent.vue';
import { useAuthStore } from '@/stores/Auth';
import { useUserStore } from '@/stores/User';
import SearchBarComponent from './SearchBarComponent.vue';
import GeneralButtonComponent from './Buttons/GeneralButtonComponent.vue';

const userStore = useUserStore();
const authUser = useAuthStore();
console.log('le store est ici', authUser);
const isLogged = computed(() => authUser.isAuthenticated);
console.log("hes logged or not",isLogged)
const noUser = computed(() => userStore.user);
let getFirstName = ref();
const buttonSignIn = "Sign In";
const buttonLogIn = "Log In";
const emits = defineEmits(['search-result-updated', 'user-input-value']);

// this function gets the result from the searchBar component and sends it to the HomeView.vue
const searchBarResult = (searchResults) => {
  emits('search-result-updated', searchResults);
	console.log('le résultat', searchResults)
}

//this function gets the value from the searchBar and sends it to the HomeView
const userSearchBarValue = (userValue) => {
	emits('user-input-value', userValue);
	console.log('eh benddfdsfsdf', userValue)
}

watchEffect(() => {
	console.log('isAuthenticated changed:', authUser.isAuthenticated);
	console.log('User Value', noUser.value);

  //const userName = noUser.value?.name || '';
	const userName = noUser.value && noUser.value.name ? noUser.value.name : '';
	console.log('USER NAME', userName)
	const getFullName = userName.split(' ');
	let firstName;
	for (let i = 0; i < getFullName.length; i ++){
		firstName = getFullName[0];
		getFirstName = firstName;
	}
});
</script>

<template>
	<nav class="navbar">
			<div class="navbar_image">
				<RouterLink to="/">
					<img src="https://res.cloudinary.com/didthhgmq/image/upload/v1709670144/it_1_aazvp0.png" class="oficial_logo" alt="icon_navbar">
				</RouterLink>
			</div>
			<SearchBarComponent  @search-result-updated="searchBarResult" @user-input-value="userSearchBarValue"/>
			<div class="navbar-button__create">
				<RouterLink to="/submit">
					<button class="create__button">
						<img src="../assets/Icons/Create.svg" class="button__icon" alt="icon__plus">
						<span class="button__text">Create</span>
					</button>
				</RouterLink>
			</div>
				<div v-if="!isLogged || !noUser">
					<div class="dropdown">
					<button class="dropdown__button">
						<img src="../assets/Icons/User.svg" class="button__icon-dropdown" alt="icon__user">
						<span class="button__text-dropdown">Sign in / Log in</span>
					</button>
					<div class="dropdown__content">
						<div class="content-option__new-user">
							<span class="content__text">New User ?</span>
							<RouterLink to="/register">
								<GeneralButtonComponent :type-of-button="buttonSignIn"></GeneralButtonComponent>
							</RouterLink>
						</div>
						<div class="content-option__old-user">
							<span class="content__text">Old User ?</span>
							<RouterLink to="/login">
								<GeneralButtonComponent :type-of-button="buttonLogIn"></GeneralButtonComponent>
							</RouterLink>
						</div>
					</div>
				</div>
			</div>
			<div v-else>
				<div class="dropdown">
					<button class="dropdown__button">
						<img src="../assets/Icons/UserCheck.svg" class="button__icon-user-check" alt="icon__user-check">
						<span class="dropdown__user-greet">Hello !</span>
							<span class="dropdown__user-name">
								{{ getFirstName }}
							</span>
					</button>
					<div class="dropdown__content">
							<LogoutComponent/>
					</div>
				</div>
		</div>
	</nav>
</template>

<style scoped>
.navbar {
	height: auto;
	display: grid;
	grid-template-areas: "image input button content";
	grid-template-columns: 20% 40% 20% 20%;
	border-bottom: 1px solid var(--color-hover-two);
	margin-bottom: 10px
}

.navbar_image {
	grid-area: image;
	position: relative;
	display: inline-block;
	z-index: 1;
}

.oficial_logo {
	width: 	20rem;
	height: 4rem;
	display: flex;
	margin-left: 5rem;
	margin-top: 2rem;
}

.navbar_input {
	grid-area: input;
	position: relative;
	margin-left: 3rem;
}

.navbar-button__create {
	grid-area: button;
	margin-left: 10rem;
}

.create__button {
	padding: 1.6rem;
	display: flex;
	padding-left: 2rem;
	margin-top: 2rem;
	margin-bottom: 1rem;
	border-radius: 4rem;
	width: 13rem;
	color: var(--color-text);
	background-color: var(--color-background);
	border: none;
}

.button__icon {
	width: 2rem;
	height: 2rem;
	margin-left: 0.5rem;
}

.button__text {
	margin-left: 0.5rem;
	font-weight: 650;
	color: var(--color-black);
}

.dropdown {
  position: relative;
  display: inline-block;
	margin-left: 5rem;
}

.dropdown__content {
	grid-area: content;
  display: none;
  position: absolute;
	color: var(--color-text);
  min-width: 180px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown__content {
  display: block;
}

.dropdown__button {
	padding: 1.6rem;
	display: flex;
	padding-left: 1rem;
	margin-top: 2rem;
	margin-bottom: 1rem;
	border-radius: 4rem;
	color: var(--color-text);
	background-color: var(--color-background);
	width: 23rem;
	border: none;
	font-weight: 510;
}

.button__icon-dropdown {
	width: 2rem;
	height: 2rem;
	margin-left: 4rem;
}

.button__text-dropdown {
	margin-left: 0.5rem;
	font-weight: 650;
	color: var(--color-black);
}

.dropdown__button:hover,
.create__button:hover {
	background-color: var(--color-hover-two);
	opacity: 2;
}

.content__text {
	font-weight: 650;
	color: var(--color-black);
}

.content-option__new-user {
	margin-bottom: 3rem;
	margin-top: 1rem;
}

.content-option__old-user {
	margin-bottom: 3rem;
	margin-top: 3rem;
}

.dropdown__user-greet {
	margin-left: 1rem;
	font-weight: 600;
}

.button__icon-user-check {
	width: 2rem;
	height: 2rem;
	margin-left: 2.5rem;
}

.dropdown__user-name {
	margin-left: 0.7rem;
	font-weight: 400;
}
</style>