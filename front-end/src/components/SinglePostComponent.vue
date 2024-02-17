<script setup>
import { usePostStore } from '@/stores/Post';

const postStore = usePostStore();
console.log('me voila', postStore);


async function getPostById() {
		return await postStore.getOnePost();
}

getPostById();

</script>

<template>
	<section class="container">
			<div class="container__one-post">
				<div v-for="description in postStore.post" :key="description.id">
					<p>{{ description.id }}</p>
					<div class="post-description__container">
						<h6 class="post-author__time">{{ description.formatted_date }}</h6>
					</div>
					<h2 class="post__title">{{ description.title }}</h2>
					<p class="post__content">{{ description.content }}</p>
				</div>
			</div>
	</section>
</template>

<style scoped>

.container {
	margin-top: 4rem;
	border-left: 1px solid var(--color-hover-two);
}

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
