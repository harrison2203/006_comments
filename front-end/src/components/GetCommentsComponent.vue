<script setup>
import { onMounted } from 'vue';
import { createToaster } from "@meforma/vue-toaster";
import { useCommentStore } from '@/stores/Comment';

const commentStore = useCommentStore();
const toaster = createToaster();
console.log('logge store avant function', commentStore)

async function indexComments() {
	try {
		await commentStore.getCommentByPostId();
    toaster.success('your comment has been published');
    console.log('on logge le store', commentStore);
  } catch (error) {
		toaster.error('error');
  }
}

onMounted(() => {
	indexComments();
});
</script>

<template>
	<main class="container">
		<div v-if="commentStore">
			<section v-for="element in commentStore.comments" class="container-comment">
				<div class="comment__information">
					<h2>{{ element.user.name }}</h2>
					<p class="comment__date">{{ element.formatted_created_at }}</p>
					<p class="comment__commentary">{{ element.commentary }}</p>
				</div>
			</section>
		</div>
	</main>
</template>

<style scoped>

.container {
	margin-top: 4rem;
	border-left: 1px solid var(--color-hover-two);}

.container-comment {
	margin-left: 4rem;
	background-color: var(--color-post);
	border-radius: 1rem;
	margin-bottom: 1.5rem;
	margin-left: 4rem;
	width: 70rem;
	height: 15rem;
	padding: 2rem;
}
</style>
