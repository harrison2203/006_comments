<script setup>
import LoginComponent from '../components/LoginComponent.vue';
import NavbarComponent from '../components/NavbarComponent.vue'
import { useAuthStore } from '@/stores/Auth';
import { useRouter } from 'vue-router';

const authStore = useAuthStore();
const router = useRouter();

const redirectTo = () => {
  if (authStore.isAuthenticated) {
		router.push('/')
	}
}

redirectTo();
</script>

<template>
	<header>
		<NavbarComponent/>
	</header>
		<LoginComponent/>
</template>

<style scoped>
.error {
	text-align: center;
	padding: 10rem;
}
</style>