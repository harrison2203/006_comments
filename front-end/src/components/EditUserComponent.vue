<script setup>
import { ref, onMounted } from'vue';
import { useUserStore } from '@/stores/User';
import { RouterLink } from 'vue-router';
import GeneralButtonComponent from './Buttons/GeneralButtonComponent.vue';

const userStore = useUserStore();
console.log('le user storeeeeeeeeeeeeeeeeee', userStore);
//const isEditing = ref(false);
const newName = ref(userStore.user ? userStore.user.name || '' : "");
const newEmail = ref(userStore.user ? userStore.user.email || '' : "");
const buttonNameConfirm = "Confirm";
const buttonNameEdit = "Go Back";

async function updateUserInformation() {
	try {
		await userStore.updateUser(newName.value, newEmail.value)
		console.log("suceeessssss")
		//isEditing.value = false;

	} catch (error) {
		console.log(error);
	}
}

onMounted (() =>
	updateUserInformation
) 
</script>

<template>
	<main class="main__user-info">
		<template v-if="userStore.user">
			<h1 class="user-info__title">Personnal account</h1>
			<div class="user-info__information">
				<div class="user-info__id">
					<span class="user-info__span">User id : </span>
					<span class="user-info__span-information">{{ userStore.user.id }}</span>
				</div>
				<div class="user-info__creation-date">
					<span class="user-info__span">Account creation date : </span>
					<span class="user-info__span-information">{{ userStore.user.formatted_date }}</span>
				</div>
				<div class="user-info__name">
					<span class="user-info__span">Name : </span>
					<input class="user-info__input" v-model="newName"/>
				</div>
				<div class="user-info__email">
					<span class="user-info__span">Email : </span>
					<input class="user-info__input" v-model="newEmail"/>
				</div>
			</div>
			<div class="user-info__modify-button">
				<RouterLink :to="{ name: 'userAccount', params: { id: userStore.user.id } }">
					<GeneralButtonComponent :typeOfButton="buttonNameEdit"></GeneralButtonComponent>
				</RouterLink>
				<RouterLink :to="{ name: 'userAccount', params: { id: userStore.user.id } }">
					<GeneralButtonComponent :typeOfButton="buttonNameConfirm" @click="updateUserInformation"></GeneralButtonComponent>
				</RouterLink>
			</div>
		</template>
	</main>
</template>

<style scoped>
.user-info__title {
	margin-left: 15rem;
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
.user-info__id, .user-info__name, .user-info__email {
	margin-bottom: 1rem;
}
.user-info__span-information {
	font-size: 2rem;
}
.user-info__input {
	padding: 2rem;
	margin-top: 2rem;
	width: 40rem;
	height: 5rem;
	border-radius: 1rem;
}
.user-info__modify-button {
	margin-top: 5rem;
	display: flex;
	justify-content: space-around;
	margin-right: 18rem;
}
</style>