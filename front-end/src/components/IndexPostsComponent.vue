<script setup>
import { ref,  defineProps, watch, computed } from 'vue';
import { RouterLink } from 'vue-router';
import { usePostStore } from '@/stores/Post';

const postStore = usePostStore();
const isDataLoaded = ref(false);

const props = defineProps({
	searchResultsProp: Array,
	inputValueProp: String
});

async function indexPosts() {
	if (props.inputValueProp === '') {
	await postStore.getPosts();
	isDataLoaded.value = true;
	}
}

indexPosts();

</script>

<template>
<main class="main__container">
<div v-if="isDataLoaded">
	<div v-if="inputValueProp !==''">
		<section  v-for="post in searchResultsProp" :key="post.id" class="container__post">
			<div class ="post-description__container">
				<div class="post__name-hour">
					<h1 class="post-author__name">{{ post.user_name }}</h1>
					<img src="../assets/Icons/Point.svg" class="point_logo" alt="icon_post">
					<h6 class="post-author__time">{{ post.formatted_created_at }}</h6>
				</div>
			</div>
			<h2 class="post__title">{{ post.title }}</h2>
			<p class="post__content">{{ post.content }}</p>
		</section>
	</div>
	<div v-else-if="inputValueProp === ''">
		<section v-for="element in postStore.posts" :key="element.id" class="container__post">
				<RouterLink class="post__router" :to="{name: 'post', params: {id: element.id}}">
					<div class ="post-description__container">
						<div class="post__name-hour">
							<h1 class="post-author__name">{{ element.user.name }}</h1>
							<img src="../assets/Icons/Point.svg" class="point_logo" alt="icon_post">
							<h6 class="post-author__time">{{ element.formatted_created_at }}</h6>
						</div>
					</div>
						<h2 class="post__title">{{ element.title }}</h2>
						<p class="post__content">{{ element.content }}</p>
				</RouterLink>
			</section>
	</div>
	<div v-else>
		<p>Loading...</p>
	</div>
</div>
</main>

<!--
	<main class="main__container">
		<div v-if="isDataLoaded">
			<section v-for="element in postStore.posts" :key="element.id" class="container__post">
				<RouterLink class="post__router" :to="{name: 'post', params: {id: element.id}}">
					<div class ="post-description__container">
						<div class="post__name-hour">
							<h1 class="post-author__name">{{ element.user.name }}</h1>
							<img src="../assets/Icons/Point.svg" class="point_logo" alt="icon_post">
							<h6 class="post-author__time">{{ formattedDate }}</h6>
						</div>
					</div>
					<h2 class="post__title">{{ element.title }}</h2>
					<p class="post__content">{{ element.content }}</p>
				</RouterLink>
			</section>
		</div>
		<p v-else>Loading...</p>
	</main>
-->
</template>

<style scoped>
.main__container{
	margin-top: 4rem;
	border-left: 1px solid var(--color-hover-two);
}

.container__post{
	background-color: var(--color-post);
	border-radius: 1rem;
	margin-bottom: 1.5rem;
	margin-left: 4rem;
	width: 70rem;
	height: 40rem;
	padding: 2rem;
}

.container__post:hover{
	opacity:2;
	background-color: var(--color-hover)
}

.post__router{
	text-decoration: none;
  color: var(	--color-titles);
}

.post__title{
	font-size: 3rem;
	margin-bottom: 2rem;
}

.post__content{
	font-size: 2rem;
}

.post__name-hour{
	display: flex;
	align-items:baseline;
}

.point_logo{
	margin-left: 1rem;
	margin-right: 1rem;
	margin-bottom: 1rem;
}
</style>