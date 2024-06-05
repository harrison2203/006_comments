<script setup>
import { ref } from'vue';
import { useUserStore } from '@/stores/User';
import { RouterLink } from 'vue-router';
import DeleteUserComponent from '../components/DeleteUserComponent.vue';
import { createToaster } from "@meforma/vue-toaster";
import GeneralButtonComponent from './Buttons/GeneralButtonComponent.vue';

const toaster = createToaster();
const userStore = useUserStore();
const user = ref([]);
const buttonName = "Edit Account";

async function indexUserInformation() {
	try {
		await userStore.getUserById()
		user.value = userStore.user;
	} catch (error) {
		toaster.error(error);
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
					<div class="user-info__creation-date">
						<span class="user-info__span">Account creation date : </span>
						<span class="user-info__span-information">{{ user.formatted_date }}</span>
					</div>
					<span class="user-info__span">Name : </span>
						<span class="user-info__span-information">{{ user.name }}</span>
				</div>
				<div class="user-info__email">
					<span class="user-info__span">Email : </span>
					<span class="user-info__span-information">{{ user.email }}</span>
				</div>
			</div>
			<div class="user-info__buttons">
				<RouterLink :to="{ name: 'update', params: { id: user.id } }">
					<GeneralButtonComponent :typeOfButton="buttonName"></GeneralButtonComponent>
				</RouterLink>
				<DeleteUserComponent/>
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

.user-info__id, .user-info__name, .user-info__email {
	margin-bottom: 1rem;
}
.user-info__span-information {
	font-size: 2rem;
}

</style>