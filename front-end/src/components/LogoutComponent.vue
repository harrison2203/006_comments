<script setup>
import { useAuthStore } from '@/stores/Auth';
import { createToaster } from "@meforma/vue-toaster";
import { RouterLink } from 'vue-router';


const toaster = createToaster();
const authUser = useAuthStore();

async function logoutUser() {
  try {
    await authUser.Logout();
  } catch (error) {
    toaster.error("Logout failed. ERROR!!!!! ");
    console.error(error);
  }
}
</script>

<template>
	<RouterLink to="/">
		<button @click="logoutUser" class="buttons__option" >
			<slot>
				Logout
			</slot>
		</button>
	</RouterLink>
</template>

<style scoped>
.buttons__option {
	width: 20rem;
	height: 5rem;
	border-radius: 1.2rem;
	margin-top: 2rem;
	background-color: var(--color-black);
	color: var(--color-background);
	font-weight: bold;
	border: none;
}
.buttons__option:hover {
	background-color: var(--color-button-dropdown-red);
	opacity: 2;
}
</style>