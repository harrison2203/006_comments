<script setup>
import DeleteUserAccount from '../components/DeleteUserAccount.vue';
import { ref, watchEffect, computed } from'vue';
import { useUserStore } from '@/stores/User';
import { RouterLink } from 'vue-router';
import { format } from 'date-fns';

const userStore = useUserStore();
console.log('ce par ici', userStore)
const user = ref([]);

async function indexUserInformation() {
	try {
		await userStore.getUserById()
		user.value = userStore.user
		console.log('coucou', user)
		
		console.log("suceeessssss")

	} catch (error) {
		console.log(error);
	}
}

indexUserInformation();
</script>

<template>
	<main class="main__user-info">
		<template class="user-info" v-if="userStore.user">
			<h1 class="user-info__title">Personnal account</h1>
			<div class="user-info__information">
				<div class="user-info__id">
					<span class="user-info__span">User id : </span>
						<span class="user-info__span-information">{{ user.id }}</span>
				</div>
				<div class="user-info__name">
					<span class="user-info__span">Name : </span>
						<span class="user-info__span-information">{{ user.name }}</span>
				</div>
				<div class="user-info__email">
					<span class="user-info__span">Email : </span>
					<span class="user-info__span-information">{{ user.email }}</span>
				</div>
				<div class="user-info__creation-date">
					<span class="user-info__span">Account creation date : </span>
					<span class="user-info__span-information">{{ user.formatted_date }}</span>
				</div>
			</div>
			<div class="user-info__buttons">
				<RouterLink :to="{ name: 'update', params: { id: user.id } }">
					<button class="user-info__editing-button">Modifier</button>
				</RouterLink>
				<DeleteUserAccount/>
			</div>
		</template>
		<template v-else>
			Loading...
		</template>
	</main>
</template>

<style scoped>

.user-info__title {
	text-align: center;
	font-weight: bold;
	font-size: 4rem;
}

.user-info__information {
	margin-top: 5rem;
	margin-left: 8rem;
}

.user-info__span {
	font-weight: bold;
	font-size: 2.5rem;
}

.user-info__buttons {
	margin-top: 5rem;
	display: flex;
	justify-content: space-around;
}

.user-info__editing-button {
	width: 20rem;
	height: 5rem;
	border-radius: 1.2rem;
	margin-top: 2rem;
	background-color: var(--color-black);
	color: var(--color-background);
	font-weight: bold;
	border: none;
}

.user-info__id, .user-info__name, .user-info__email {
	margin-bottom: 1rem;
}

.user-info__span-information {
	font-size: 2rem;
}
</style>