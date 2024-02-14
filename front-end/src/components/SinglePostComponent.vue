<script setup>
import { usePostStore } from '@/stores/Post';

const postStore = usePostStore();
console.log('me voila', postStore)
async function getPostById() {
		return await postStore.getOnePost();
}

getPostById();

</script>

<template>
	<main>
		<div class="container__one-post" v-for="description in postStore.post" :key="description.id">
				<p>{{ description.id }}</p>
				<div class ="post-description__container">
					<h6 class="post-author__time">{{ description.created_at }}</h6>
				</div>
				<h2 class="post__title">{{ description.title }}</h2>
				<p class="post__content">{{ description.content }}</p>
		</div>
	</main>
</template>

<style scoped>
.container__one-post{
	background-color: var(--color-post);
	border-radius: 1rem;
	margin-bottom: 1.5rem;
	margin-left: 4rem;
	width: 70rem;
	height: 40rem;
	padding: 2rem;
}

.container__one-post:hover{
	opacity:2;
	background-color: var(--color-hover)
}
</style>
