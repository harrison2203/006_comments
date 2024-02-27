<script setup>
import { ref, defineProps } from'vue';
import { useUserStore } from '@/stores/User';
import { useAuthStore } from '@/stores/Auth';
import { RouterLink } from 'vue-router';

const userStore = useUserStore();
const authStore = useAuthStore();
console.log('je logge le auth store',authStore)
let el = ref();

async function deleteUserFunction() {
	try{
		await userStore.deleteUser();
		console.log('success');
		console.log(userStore.user)
	} catch (error){
		console.error(error)
	}
}

// function handles the appearance of the modal.
function deleteUserModal() {
	el = document.getElementById("container");
	//el.style.visibility = el.style.visibility == "visible" ? "hidden" : "visible";
	if (el.style.visibility === "visible") {
		el.style.visibility = "hidden";
	} else {
		el.style.visibility = "visible";
	}
}


/*
	window.addEventListener('click', myFunction);
	function myFunction(event) {
		const modalContent = document.querySelector('.modal');
		const deleteButton = document.querySelector('.myBtn');
		const container = document.getElementById('container');
		const button = document.getElementById('cancel-button');
		// Si l'élément cliqué est le bouton "Delete Account", ou s'il est contenu dans le modal
		console.log('modal conten', modalContent)
		console.log('event', event.target)
		console.log('le bouton', button)
    if (modalContent && (event.target === deleteButton || modalContent.contains(event.target))) {
        return;
    }
    // Si l'élément cliqué est en dehors de la zone modal-content et n'est pas le bouton "Delete Account", fermer le modal
    if (container) {
        container.style.visibility = 'hidden';
    }
	};
*/

	window.onclick = function(event) {
	const modal = document.querySelector('.modal');
  if (event.target === modal) {
    modal.style.visibility = "hidden";
  }
}
</script>

<template>
	<main  v-if="userStore.user">
				<button class="myBtn" @click="deleteUserModal()" >Delete Account</button>
			<div  class="modal" id="container">
				<div class="modal-content">
					<h1 class="modal__title">Delete Account ?</h1>
					<p class="modal__word">Once you delete this account it can't be restored.</p>
					<div class="modal__buttons">
						<div class="buttons__position">
							<button class="buttons__cancel-button" id="cancel-button" @click="deleteUserModal">Go Back</button>
						</div>
						<div class="buttons__position">
							<RouterLink to="/">
								<button class="buttons__confirm-button" @click="deleteUserFunction">Yes, Delete</button>
							</RouterLink>
						</div>
					</div>
				</div>
			</div>
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
.myBtn:hover {
	background-color: var(--color-button-dropdown-red);
	opacity: 2;
}
.modal {
	position: fixed;
	z-index: 1;
	font-size: 15px;
  position: fixed; /* Stay in place */
	top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  left: 0;
	background-color: rgb(0,0,0); /* Fallback color */
	background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	visibility: hidden;
	padding-top: 5rem;
}
.modal-content {
	background-color: #fefefe;
  margin: auto;
	border-radius: 2rem;
	margin-top: 10rem;
  border: 1px solid #888;
	width: 54rem;
	height: 30rem;
}
.modal__title {
	text-align: left;
	margin-left: 3rem;
	margin-bottom: 2rem;
	margin-top: 4rem;
}
.modal__word {
	text-align: left;
	margin-left: 3rem;
	font-size: x-large;
}
.modal__buttons{
	display: flex;
	margin-left: 20rem;
	margin-top: 8rem;
}
.buttons__confirm-button, .buttons__cancel-button {
	border-radius: 3rem;
	width: 13rem;
	border-style: none;
	height: 5rem;
	font-size: medium;
	background-color: var(--color-black);
	color: var(--color-background);
}
.buttons__confirm-button:hover {
	background-color: var(--color-button-dropdown-red);
	opacity: 2;
}
.buttons__cancel-button:hover {
	background-color: var(--color-principal);
	opacity: 2;
}
.buttons__position {
	margin-left: 1.8rem;
}
</style>