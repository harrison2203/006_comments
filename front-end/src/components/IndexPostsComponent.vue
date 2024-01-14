<script setup>
import { RouterLink } from 'vue-router';
import { usePostStore } from '@/stores/Post';

const postStore = usePostStore();

async function indexPosts() {
	return await postStore.getPosts();
}

indexPosts()

</script>

<template>
	<main class="main__container">
		<section v-for="element in postStore.posts" :key="element.id" class="container__post">
			<RouterLink class="post__router" :to="{name: 'post', params: {id: element.id}}">
				<div class ="post-description__container">
					<h1 class="post-author__name">{{ element.user.name }}</h1>
					<h6 class="post-author__time">{{ element.created_at }}</h6>
				</div>
					<h2 class="post__title">{{ element.title }}</h2>
					<p class="post__content">{{ element.content }}</p>
			</RouterLink>
		</section>
	</main>
</template>