<script setup>
import { usePostStore } from '@/stores/Post';
import {ref } from'vue';
import { useRouter } from 'vue-router';
import GeneralButtonComponent from './Buttons/GeneralButtonComponent.vue';

const postStore = usePostStore();
const postTitle= ref("");
const postContent= ref("");
const router = useRouter();
const buttonCreatePost = "Create";

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
			<p :class="{ 'handle__errors': postInfo.invalidValues }">
    		{{ postInfo.errorMessage }}
			</p>
				<div class="creation-router__button">
					<GeneralButtonComponent  @click="CreatePostComponent" :typeOfButton="buttonCreatePost"></GeneralButtonComponent>
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
.dynanic {
	margin-top: 2rem;
	font-weight: bold;
	color: red;
}
</style>