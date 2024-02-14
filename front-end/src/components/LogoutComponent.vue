<script setup>
import { useAuthStore } from '@/stores/Auth';
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster();
const authUser = useAuthStore();

async function logoutUser() {
  try {
    await authUser.Logout();
    toaster.success("Logout success!!!");
  } catch (error) {
    toaster.error("Logout failed. ERROR!!!!! ");
    console.error(error);
  }
}
</script>

<template>
	<button @click="logoutUser" class="buttons__option" >
		<slot>
			Logout
		</slot>
	</button>
</template>