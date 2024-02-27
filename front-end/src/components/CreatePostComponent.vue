<script setup>
import { usePostStore } from '@/stores/Post';
import {ref, defineEmits } from'vue';
import { createToaster } from "@meforma/vue-toaster";
import { useRouter } from 'vue-router';

const postStore = usePostStore();
const postTitle= ref("");
const postContent= ref("");
const toaster = createToaster();
const router = useRouter();
const emits = (['test']);

const postInfo =  ref({
	errorMessage: '',
	invalidValues : null,
})

async function CreatePostComponent() {
	try {
		await postStore.createPost(postTitle.value, postContent.value);
			postTitle.value = "";
			postContent.value = "";
			router.push('/')
  } catch (error) {
		postInfo.value.invalidValues = true;
		postInfo.value.errorMessage = "Both values are required";
  }
}
</script>

<template>
	<div class="main-post__container">
		<form @submit.prevent class="container-creation__post">
			<h1 class="general__title">Create a post</h1>
			<div class="input-textarea__container">
				<input class="input__title" v-model="postTitle" maxlength="300" placeholder="Title" id="title" name="title" type="text">
			</div>
			<div class="input-textarea__container">
				<textarea class="text-area__content" v-model="postContent" maxlength="600" placeholder="Text" id="content" name="content" type="text"></textarea>
			</div>
			<p v-if="postInfo.errorMessage" :style="{ fontSize: postInfo.invalidValues = '2rem', color:postInfo.invalidValues = 'red'}">
    		{{ postInfo.errorMessage }}
			</p>
				<div class="creation-router__button">
					<button class="button-creation__post" @click="CreatePostComponent" type="submit">Create</button>
				</div>
		</form>
	</div>
</template>

<style scoped>
.main-post__container {
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	height: 70rem;
}
.general__title {
	font-weight: bold;
	text-align: left;
	margin-bottom: 2rem;
}
.input__title {
	height: 4.8rem;
	width: 50rem;
	border-width: 1px;
	border-color: black;
	border-radius: 0.5rem;
}
.text-area__content {
	height: 18rem;
	margin-top: 2rem;
	width: 50rem;
	border-width: 1px;
	border-color: black;
	border-radius: 0.5rem;
	font-weight: inherit;

}
.text-area__content, .input__title[type="text"] {
	padding: 2rem;
	font-weight: normal;
}

::placeholder {
	font-weight: bold;
}
.creation-router__button {
	display: flex;
	justify-content: end;
}
.button-creation__post {
	height: 4.8rem;
	width: 25rem;
	border-radius: 1rem;
	margin-top: 5rem;
}
.dynanic {
	margin-top: 2rem;
	font-weight: bold;
	color: red;

}
</style>