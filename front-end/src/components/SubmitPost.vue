<script setup>
import { usePostStore } from '@/stores/Post';
import {ref} from'vue';
import { createToaster } from "@meforma/vue-toaster";

const postCreator = usePostStore();
const postTitle= ref("");
const postContent= ref("");
const toaster = createToaster();

async function CreatePostComponent() {
  try {
    await postCreator.createPost(postTitle.value, postContent.value);
    toaster.success("Créé youpii");
		console.log('post', postCreator)
  } catch (error) {
    toaster.error("failed");
    console.error(error);
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
			<button @click="CreatePostComponent" type="submit">Create</button>
		</div>
	</form>
</template>
