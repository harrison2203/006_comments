<script setup>
import { ref } from'vue';
import { useAuthStore } from '@/stores/Auth';
import { useUserStore } from '@/stores/User';

const userStore = useUserStore();
const authUser = useAuthStore();
const isEditing = ref(false);
const newName = ref(userStore.user ? userStore.user.name || '' : "");
const newEmail = ref(userStore.user ? userStore.user.email || '' : "");

async function updateUserInformation() {
	try {
		await userStore.updateUser(newName.value, newEmail.value)
		console.log("suceeessssss")
		  isEditing.value = false;

	} catch (error) {
		console.log(error);
	}
}
</script>

<template>
	<main>
		<template v-if="!userStore.user">
			<p>acces denied</p>
		</template>

		<template v-if="userStore.user && !isEditing">
			<h1>Personnal account</h1>
			<div>
				<p>User id : {{ userStore.user.id }}</p>
			</div>
			<div>
				<p>Name : {{ userStore.user.name }}</p>
			</div>
			<div>
				<p>email : {{ userStore.user.email }}</p>
			</div>
			<div>
				<p>account creation date : {{ userStore.user.created_at }}</p>
			</div>
			<button @click="isEditing=true">Edit</button>
		</template >

		<template v-else-if="userStore.user && isEditing">
			<h1>Personnal account</h1>
			<div>
				<p>{{ userStore.user.id }}</p>
			</div>
			<div>
				<input v-model="newName"/>
			</div>
			<div>
				<input v-model="newEmail"/>
			</div>
			<div>
				<p>{{ userStore.user.created_at }}</p>
			</div>
			<button @click="updateUserInformation">Modifier</button>
		</template>
		<template v-else>
			<p>Loading user data...</p>
		</template>
	</main>
</template>