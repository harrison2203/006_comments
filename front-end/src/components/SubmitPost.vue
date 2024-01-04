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
    toaster.error("failed");
  }
}
</script>

<template>
	<form @submit.prevent>
		<div>
			<textarea v-model="postTitle" maxlength="300" placeholder="Title" id="title" name="title"></textarea>
		</div>

		<div>
			<textarea v-model="postContent" maxlength="600" placeholder="Content" id="content" name="content"></textarea>
		</div>

		<div>
			<RouterLink to="/">
				<button @click="CreatePostComponent" type="submit">Create</button>
			</RouterLink>
		</div>
	</form>
</template>
