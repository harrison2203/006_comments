<script setup>
import { usePostStore } from '@/stores/Post';
import {ref} from'vue';
import { createToaster } from "@meforma/vue-toaster";
import { RouterLink } from 'vue-router';

const postCreator = usePostStore();
const postTitle= ref("");
const postContent= ref("");
const toaster = createToaster();

async function CreatePostComponent() {
  try {
    await postCreator.createPost(postTitle.value, postContent.value);
    toaster.success("Créé youpii");

		postTitle.value = "";
		postContent.value = "";
  } catch (error) {
    toaster.error("The title and the content are mandatory");
  }
}
</script>

<template>
	<div class="main-post__container">
		<form @submit.prevent class="container-creation__post">
			<h1 class="general__title">Create a post</h1>
			<div class="input-textarea__container">
				<input class="input__title" v-model="postTitle" maxlength="300" placeholder="Title" id="title" name="title">
			</div>

			<div class="input-textarea__container">
				<textarea class="text-area__content" v-model="postContent" maxlength="600" placeholder="Text" id="content" name="content"></textarea>
			</div>
				<RouterLink  class="creation-router__button" to="/">
					<button class="button-creation__post" @click="CreatePostComponent" type="submit">Create</button>
				</RouterLink>
		</form>
	</div>
</template>

<style scoped>
.main-post__container{
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	height: 70rem;
}

.general__title{
	font-weight: bold;
	text-align: left;
	margin-bottom: 2rem;
}

.input__title{
	height: 4.8rem;
	width: 50rem;
	border-width: 1px;
	border-color: black;
	border-radius: 0.5rem;
}

.text-area__content{
	height: 18rem;
	margin-top: 2rem;
	width: 50rem;
	border-width: 1px;
	border-color: black;
	border-radius: 0.5rem;
}

.creation-router__button{
	display: flex;
	justify-content: end;
}

.button-creation__post{
	height: 4.8rem;
	width: 25rem;
	border-radius: 1rem;
	margin-top: 5rem;
}
</style>