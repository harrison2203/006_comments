<script setup>
import { ref } from 'vue';
import { RouterLink } from 'vue-router';
import { createToaster } from "@meforma/vue-toaster";
import { useCommentStore } from '@/stores/Comment';

const commentStore = useCommentStore();
const toaster = createToaster();
const comment = ref("");

async function submitComment(){
	try {
		await commentStore.createComment(comment.value);
		toaster.success('comment created');
	} catch (error) {
		console.error('error happened during your comment');
	}
}
</script>

<template>
	<form>
		<textarea class="textarea" v-model="comment" maxlength="300" placeholder="Add comment" id="comment" name="comment"></textarea>
		<RouterLink to="">
			<div class="textarea__button">
				<button class= "textarea__style-button" @click="submitComment()">Create Comment</button>
			</div>
		</RouterLink>
	</form>
</template>

<style scoped>
.textarea {
	width: 70rem;
	height: 10rem;
	padding: 2rem;
	margin-left: 4rem;
	border-radius: 2rem;
}

::placeholder {
	font-weight: bold;
}

.textarea__button {
	margin-left: 4rem;
	margin-top: 2rem;
	display: flex;
	justify-content:center;
	width: 70rem;
}
.textarea__style-button {
	width: 20rem;
	height: 5rem;
	border-radius: 1.2rem;
	margin-top: 2rem;
	background-color: var(--color-black);
	color: var(--color-background);
	font-weight: bold;
	border: none;
	margin-bottom: 4rem;
}
</style>