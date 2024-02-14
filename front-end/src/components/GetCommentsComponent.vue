<script setup>
import { onMounted, watch } from 'vue';
import { createToaster } from "@meforma/vue-toaster";
import { useCommentStore } from '@/stores/Comment';

const commentStore = useCommentStore();
const toaster = createToaster();
console.log('logge store avant function', commentStore)

async function indexComments() {
	try {
		await commentStore.getCommentByPostId();
    toaster.success('your comment has been published')
    console.log('on logge le store', commentStore)
  } catch (error) {
		toaster.error('error');
  }
}

onMounted(() => {
	indexComments();
});
</script>

<template>

<main>
	<template v-if="commentStore">
		<section v-for="element in commentStore.comments">
			<h2>{{ element.id }} </h2>
			{{ element.user_id }}
			<p>{{ element.created_at }}</p>
			<p>{{ element.commentary }}</p>
		</section>

	</template>
	<template v-else>
		<section>
			<p>tata</p>
		</section>
	</template>
</main>

 
</template>
