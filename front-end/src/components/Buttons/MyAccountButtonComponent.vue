<script setup>
import {ref, watchEffect} from'vue';
import { createToaster } from "@meforma/vue-toaster";
import { RouterLink } from 'vue-router';
import { useUserStore } from '@/stores/User';

const userStore = useUserStore();
const toaster = createToaster();
const patchValue = ref(null);


// réagit de manière réactive aux changements permettant d'exécuter au bon moment la logique
watchEffect(() => {
  patchValue.value = userStore.Patch;
});

console.log('le test', userStore)

async function userData() {
  try {
    await userStore.getUserById();
    toaster.success("here your information");
		console.log('la informacion por 	aca',userStore)
		console.log('User id recuperé', patchValue.value);
  } catch (error) {
    toaster.error("Nothing to see here ERROR!!!!! ");
    console.error(error);
  }
}

userData();

</script>

<template>

	<RouterLink :to="{ name: 'userAccount', params: { id: patchValue } }">
		<a class="list_link">
			<slot>
				My account
			</slot>
		</a>
	</RouterLink>


		
</template>