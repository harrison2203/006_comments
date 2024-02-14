<script setup>
import { ref } from 'vue';
import { createToaster } from "@meforma/vue-toaster";
import { RouterLink } from 'vue-router';
import { useUserStore } from '@/stores/User';
import { useAuthStore } from '@/stores/Auth';

const authUser = useAuthStore();
const userStore = useUserStore();
const toaster = createToaster();
const patchValue = ref(null);

async function userData() {
	try {
    if (authUser.isAuthenticated) {
      await userStore.getUserById();
      toaster.success("here your information");
      patchValue.value = userStore.user.id;
    } else {
      toaster.error('You are not connected');
    }
  } catch (error) {
    toaster.error("The user is not authentified");
    console.error(error);
  }
}

userData();

</script>

<template>
	<div v-if="patchValue && authUser.isAuthenticated">
		<RouterLink :to="{ name: 'userAccount', params: { id: patchValue } }">
			<a class="list_link">
				<slot>
					My account
				</slot>
			</a>
		</RouterLink>
	</div>
	<div v-else>
			<a class="list_link">
				<slot>
					<a>My account</a>
				</slot>
			</a>
	</div>
</template>

<style scoped>
	.list__link{
		display: none;
		margin-right: 1rem;
	}
</style>