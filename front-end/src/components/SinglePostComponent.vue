<script setup>
import { usePostStore } from '@/stores/Post';

const postStore = usePostStore();

async function getPostById() {
		return await postStore.getOnePost();
}

getPostById();

</script>

<template>
	<main>
		<section v-for="description in postStore.post">
			<p>{{ description.id }}</p>
			<div class ="post-description__container">
				<h6 class="post-author__time">{{ description.created_at }}</h6>
			</div>
			<h2 class="post__title">{{ description.title }}</h2>
			<p class="post__content">{{ description.content }}</p>
		</section>
	</main>
</template>
