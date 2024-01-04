<script setup>
import axios from 'axios'
import { ref } from 'vue'
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster();
let posts = ref([]);

	axios.get('http://localhost:8000/api/posts')
	.then ((response) => {
		console.log(response);
		toaster.success('Download with success');
		posts.value = response.data.posts;
		console.log('post.vaue', posts);
	})
	.catch ((error) => {
    toaster.error('An error has occurred');
    console.error(error);
  })
</script>

<template>
	<main class="main__container">
		<section v-for="element in posts" :key="element.id" class="container__post">
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

<style scoped>
</style>


