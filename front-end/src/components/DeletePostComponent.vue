<script setup>
import { ref, defineProps } from'vue';
import { createToaster } from "@meforma/vue-toaster";
import { usePostStore } from '@/stores/Post';

const toaster = createToaster();
const postStore = usePostStore();

const props = defineProps({
    postId: {
        type: Number,
        required: true
    }
});

function openModal () {
	console.log("APPEL FONCTION OPEN MODAL");
	const modal = document.querySelector('.modal-post');
	modal.style.display = "block";
}

function closeModal () {
	const modal = document.querySelector('.modal-post');
	modal.style.display = "none";
}

window.onclick = function(event) {
	const modal = document.querySelector('.modal-post');
  if (event.target === modal) {
    modal.style.display = "none";
  }
}

async function deletePostComponent(){
	try {
		console.log('Tentative de suppression du post avec ID:', props.postId);
		// Supprimer le post avec l'ID actuel
		await postStore.deletePost(props.postId);
		closeModal();
		window.location.reload();
		toaster.success("post Deleted");
	} catch (error) {
		console.log(error);
	}
}
</script>

<template>
<main>
	<li class="button">
		<img src="../assets/Icons/Trash.svg" class="item__logo" alt="icon__trash">
		<a class="button__delete" id="delete" @click="openModal">Delete</a>
	</li>
	<div class="modal-post" id="container-post">
		<div class="modal-post__content">
			<h1 class="modal-post__title">Delete Post ?</h1>
			<p class="modal-post__word">Once you delete this post it can't be restored.</p>

			<div class="modal-post__buttons">
				<button class="buttons__cancel-button" @click="closeModal">Go Back</button>
				<div class="buttons__position">
					<button class="buttons__confirm-button" @click="deletePostComponent()">Yes, Delete</button>
				</div>
			</div>
		</div>
	</div>
</main>
</template>

<style scoped>

.button {
	display: flex;
}

.item__logo {
	margin-left: 4rem;
	margin-top: 2rem;
}
.button__delete {
	margin-top: 2rem;
	color: var(--color-black);
	font-size: medium;
	border: none;
	margin-left: 2rem;
}
.modal-post {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
	background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 5rem;
}
.modal-post__content {
	background-color: #fefefe;
  margin: auto;
	border-radius: 2rem;
	margin-top: 10rem;
  border: 1px solid #888;
	width: 54rem;
	height: 30rem;
}
.modal-post__title {
	text-align: left;
	margin-left: 3rem;
	margin-bottom: 2rem;
	margin-top: 4rem;
	font-size: xx-large;
}
.modal-post__word {
	text-align: left;
	margin-left: 3rem;
	font-size: x-large;
}
.modal-post__buttons{
	display: flex;
	margin-left: 20rem;
	margin-top: 8rem;
}
.buttons__cancel-button, .buttons__confirm-button {
	border-radius: 3rem;
	border-style: none;
	width: 13rem;
	height: 5rem;
	font-size: medium;
	background-color: var(--color-black);
	color: var(--color-background);
}
.buttons__cancel-button:hover {
	background-color: var(--color-principal);
	opacity: 2;
}
.buttons__confirm-button:hover {
	background-color: var(--color-button-dropdown-red);
	opacity: 2;
}
.buttons__position {
	margin-left: 1.8rem;
}
</style>
