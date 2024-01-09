<script setup>
import { ref } from'vue';
import UpdateAccountComponent from '../components/UpdateAccountComponent.vue';
import NavbarComponent from '../components/NavbarComponent.vue'
import DeleteUserAccount from '../components/DeleteUserAccount.vue';

const deletingUser = ref(false);

function receiveEmit() {
  deletingUser.value = true;
}

</script>

<template>
  <header>
    <NavbarComponent/>
	</header>

	<div v-if="deletingUser">
		<DeleteUserAccount @eventHandler="receiveEmit"/>

	</div>

	<div v-else>
		<UpdateAccountComponent/>
		<DeleteUserAccount @eventHandler="receiveEmit"/>

	</div>

</template>

<style scoped>
</style>