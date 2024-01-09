<script setup>
import {ref, defineEmits} from'vue';
import { createToaster } from "@meforma/vue-toaster";
import { RouterLink } from 'vue-router';
import { useUserStore } from '@/stores/User';


// a regarder si je l'efface ou pas
// Composant qui récupère tous les utilisateurs non authentifié.
const userStore = useUserStore();
const toaster = createToaster();
const users = ref([]);

async function getDataUsers() {
	try{
		await userStore.getUsers();
		users.value = userStore.users;
		console.log('Le user store est ici', userStore);
    console.log('Les données des utilisateurs', users.value);

	} catch {
		toaster.error("data not found.");
    console.error(error);
	}
}

getDataUsers()
</script>

<template>
	<main>
		<section v-for="user in users" :key="user.id">
		</section>
	</main>
</template>