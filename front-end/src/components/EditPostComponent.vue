<script setup>
import { ref } from'vue';
import { createToaster } from "@meforma/vue-toaster";
import { usePostStore } from '@/stores/Post';
import { RouterLink } from 'vue-router';
import GeneralButtonComponent from './Buttons/GeneralButtonComponent.vue';

const toaster = createToaster();
const postStore = usePostStore();
const newTitle = ref("");
const newContent = ref("");
const postId = ref("");
const post = ref([]);
const buttonGoBack = "Go Back";
const buttonEditPost = "Save";

async function getPostById() {
	try {
		await postStore.getOnePost()
		post.value = postStore.post
    if (post.value) {
			  newTitle.value = post.value.post.title;
			  newContent.value = post.value.post.content;
				postId.value = post.value.post.id;
    } else {
			console.log("La récupération du post a échoué.");
    }
	} catch (error) {
		console.log(error);
	}
}

	getPostById();

async function editPostComponent () {
	console.log('LE TEST', postId)
	try {
		await postStore.editPost(newTitle.value, newContent.value, postId.value)
		toaster.success("post created with success");
		window.location.reload();
	} catch (error) {
		toaster.error('erreur', error);
	}
}
</script>

<template>
	<section class="container-edit">
			<div v-for="element in post">
				<div class="container-edit__position">
					<h1 class="edit__title">Edit Post: </h1>
					<div class="container-edit__general">
						<input class="container-edit__input-title" v-model="newTitle" type="text">
						<textarea class="container-edit__textarea-content" v-model="newContent" type="text"></textarea>
					</div>
					<div class="container-edit__buttons">
						<RouterLink to="/">
							<GeneralButtonComponent :typeOfButton="buttonGoBack"></GeneralButtonComponent>
						</RouterLink>
						<RouterLink :to="{name: 'post', params: {id: element.id}}">
							<GeneralButtonComponent @click="editPostComponent()" :typeOfButton="buttonEditPost"></GeneralButtonComponent>
						</RouterLink>
					</div>
				</div>
			</div>
	</section>
</template>

<style scoped>
.container-edit {
	margin-top: 4rem;
	border-left: 1px solid var(--color-hover-two);
}
.container-edit__position {
	background-color: var(--color-post);
	border-radius: 1rem;
	margin-left: 4rem;
	width: 70rem;
	height: 40rem;
	padding: 2rem;
}
.edit__title {
	margin-left: 8rem;
	font-weight:bold;
	font-size:2.9rem;
	text-align: left;
	margin-bottom: 2rem;
}
.container-edit__general {
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
}
.container-edit__input-title {
	display: flex;
	justify-content: center;
	align-items: center;
	height: 4.8rem;
	width: 50rem;
	border-width: 1px;
	border-color: black;
	border-radius: 0.5rem;
}
.container-edit__textarea-content {
	height: 18rem;
	margin-top: 2rem;
	width: 50rem;
	border-width: 1px;
	border-color: black;
	border-radius: 0.5rem;
}

.container-edit__input-title, .container-edit__textarea-content[type=text] {
	padding: 1rem;
	padding: 2rem;
	font-weight: normal;
}
.container-edit__buttons {
	margin-top: 10rem;
	display: flex;
	justify-content: space-evenly;
}
</style>

