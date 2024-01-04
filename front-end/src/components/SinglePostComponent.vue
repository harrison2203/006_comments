<script setup>
import axios from 'axios'
import { ref } from "vue";
import { createToaster } from "@meforma/vue-toaster";
import { useRoute } from 'vue-router';

//Composant qui affiche un post par l'id.
const toaster = createToaster();
const post = ref([]);
let route = useRoute();

axios.get('http://localhost:8000/api/post/' + route.params.id)
	.then(function(response) {
		console.log('la reponse', response)
		toaster.success ('post downloaded');
		post.value = response.data
		console.log('la value', post.value)
	})
	.catch ((error) => {
    toaster.error('An error has occurred');
    console.error(error);
  })
</script>

<template>
	<main class="main__container">
		<section v-for="description in post">
			{{ description.id }}
			<div class ="post-description__container">
				<h6 class="post-author__time">{{ description.created_at }}</h6>
			</div>
				<h2 class="post__title">{{ description.title }}</h2>
				<p class="post__content">{{ description.content }}</p>
		</section>
	</main>
</template>

