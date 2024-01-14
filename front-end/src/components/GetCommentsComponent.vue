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
		toaster.success('your comment has been published')
		console.log('on logge le store', commentStore)

	} catch (error) {
		toaster.error('error');
	}
}

indexComments();

</script>

<template>

{{ commentStore }}



</template>