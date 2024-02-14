<script setup>
import { ref } from'vue';
import { useUserStore } from '@/stores/User';
import { useAuthStore } from '@/stores/Auth';
import { RouterLink } from 'vue-router';

const userStore = useUserStore();
const authStore = useAuthStore();
let el = ref();

function deleteModal() {
  el = document.getElementById("container");
  el.style.visibility = el.style.visibility == "visible" ? "hidden" : "visible";
}

//window.onclick = function(event) {
// if (event.target == modal) {
//   modal.style.display = "none";
// }
//}

async function deleteUserFunction() {
	try{
		await userStore.deleteUser();

		console.log('success');
		console.log(userStore.user)
	} catch (error){
		console.error(error)
	}
}
</script>

<template>
	<main>
		<template class="" v-if="userStore.user">
			<div class="">
				<button class="myBtn" @click="deleteModal()" >Delete Account</button>
			</div>
				<div  class="modal" id="container">
					<div>
						<h1>Delete Account</h1>
      			<p>Are you sure you want to delete your account?</p>
						<RouterLink to="/">
							<button @click="deleteUserFunction">Confirm Delete</button>
						</RouterLink>
						<RouterLink to="/">
							<button>Cancel</button>
						</RouterLink>
					</div>
				</div>
		</template>

	</main>
</template>

<style scoped>

.myBtn{
	width: 20rem;
	height: 5rem;
	border-radius: 1.2rem;
	margin-top: 2rem;
	background-color: var(--color-black);
	color: var(--color-background);
	font-weight: bold;
	border: none;
}
#container {
	visibility: hidden;
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	text-align: center;
	z-index: 1000;
}
#container div {
	width: 70rem;
	height: 30rem;
	margin: 100px auto;
	background-color: #f2f2f2;
	border-radius: 10px;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	padding: 15px;
	text-align: center;
	font-weight: bold;
	font-size: 15px;
	border: 3px solid #cccccc;
	position: absolute;
	left: 50%;
	top: 100px;
	transform: translate(-50%, -50%);
	-ms-transform: translate(-50%, -50%);
	-webkit-transform: translate(-50%, -50%);
}
</style>