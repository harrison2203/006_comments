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
		<textarea v-model="comment" maxlength="300" placeholder="comment" id="comment" name="comment"></textarea>
		<RouterLink to="">
			<button @click="submitComment()">Create Comment</button>
		</RouterLink>
	</form>
</template>

<style scoped>


</style>