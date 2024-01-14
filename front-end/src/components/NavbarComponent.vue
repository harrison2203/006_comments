<script setup>
import { RouterLink } from 'vue-router';
import { ref, computed, watchEffect } from 'vue'
import LogoutComponent from '../components/LogoutComponent.vue';
import { useAuthStore } from '@/stores/Auth';
import { useUserStore } from '@/stores/User';
import MyAccountButtonComponent from './Buttons/MyAccountButtonComponent.vue';

const userStore = useUserStore();
const authUser = useAuthStore();
console.log('le store est ici', authUser);
console.log('on regarde le state', authUser.isAuthenticated)

const isLogged = computed(() => authUser.isAuthenticated);
const noUser = computed(() => userStore.user)

watchEffect(() => {
  console.log('isAuthenticated changed:', authUser.isAuthenticated);
	console.log('User Value', noUser.value);
});


</script>

<template>
	<nav class="navbar">
			<div class="navbar_image">
				<img src="../assets/img/logo.svg" class="image_logo" alt="icon_navbar">
			</div>

			<div class="navbar_menu">
				<ul class="menu_list">
					<li class="list_option">
						<RouterLink to="/">
							<a class="list_link">Home</a>
						</RouterLink>
					</li>
					<li class="list_option">
							<MyAccountButtonComponent/>
					</li>
				</ul>
			</div>

			<div class="navbar_input">
				<input class="input_single" type="text" placeholder="Search...">
			</div>

			<div class="create__button">
				<RouterLink to="/submit">
					<button class="button__post">Create</button>
				</RouterLink>
			</div>

				<div v-if="!isLogged || !noUser">
					<div class="dropdown">
					<span>Connexion / Inscription</span>
					<div class="dropdown__content">
						<div>
							<p>new User ?</p>
							<RouterLink to="/register">
								<button class="buttons__option">Sign Up</button>
							</RouterLink>
						</div>
						<div>
							<p>Old User ?</p>
							<RouterLink to="/login">
								<button>login</button>
							</RouterLink>
						</div>
					</div>
				</div>
			</div>

				<div v-else>
				<div class="dropdown">
					<span>Hello {{ userStore.user.name }}</span>
					<div class="dropdown__content">
						<div>
							<LogoutComponent/>
						</div>
					</div>
				</div>
			</div>
	</nav>
</template>

<style scoped>

.navbar{
	background-color: var(--color-secondary);
	height: auto;
	display: grid;
	grid-template-areas: "image menu input button content";
	grid-template-columns: 10% 25% 35% 10% 20%
}

.navbar_image{
	grid-area: image;
	position: relative;
	width: 4rem;
	display: inline-block;
	margin-top: 1rem;
	z-index: 1; /* capa uno */
}

.image_logo{
	width: 100%;
	padding: 10px 20px 10px;
}

.navbar_menu{
	grid-area: menu;
}



.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown__content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown__content {
  display: block;
}
</style>
