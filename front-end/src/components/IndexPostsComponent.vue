<script setup>
import { ref,  defineProps, computed } from 'vue';
import DeletePostComponent from './DeletePostComponent.vue';
import { RouterLink } from 'vue-router';
import { usePostStore } from '@/stores/Post';
import { useUserStore } from '@/stores/User';

const postStore = usePostStore();
const userStore = useUserStore();
const isDataLoaded = ref(false);
const props = defineProps({
	searchResultsProp: Array,
	inputValueProp: String
});

// This function automatically evaluates the change of ID using computed.
const userId = computed(() => {
    if (userStore.user) {
        return userStore.user.id;
    } else {
        return null;
    }
});
console.log('computed', userId);

//this fonction calls the postStore and its method.
async function indexPosts() {
	if (props.inputValueProp === '') {
	await postStore.getPosts();
	isDataLoaded.value = true;
	};
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

		<div v-else-if="inputValueProp === '' ">
			<section v-for="element in postStore.posts" :key="element.id" :class="{ 'user-post': userId === element.user.id }" class="container__post" >
				<RouterLink class="post__router" :to="{name: 'post', params: {id: element.id}}">
					<div class="post-description__container">
						<h1 class="post-author__name">{{ element.user.name }}</h1>
						<img src="../assets/Icons/Point.svg" class="point_logo" alt="icon_post">
						<h6 class="post-author__time">{{ element.formatted_created_at }}</h6>
					</div>
						<h2 class="post__title">{{ element.title }}</h2>
						<p class="post__content">{{ element.content }}</p>
				</RouterLink>
						<div class="dropdown">
							<ul class="dropdown-general">
								<li class="dropdown-general__item-delete">
									<DeletePostComponent :postId="element.id"/>
								</li>
								<li class="dropdown-general__item-edit">
									<RouterLink  class="router" :to="{name: 'edit-post', params: {id: element.id}}">
										<img src="../assets/Icons/Pencil.svg" class="item__logo" alt="icon__pencil">
										<a class="item__text">Edit</a>
									</RouterLink>
								</li>
							</ul>
						</div>
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
.main__container {
	margin-top: 4rem;
	border-left: 4px solid var(--color-hover-two);
}
.container__post {
	background-color: var(--color-post);
	border-radius: 1rem;
	margin-bottom: 4rem;
	margin-left: 4rem;
	width: 70rem;
	height: 40rem;
	padding: 2rem;
	position: relative;
}
.container__post:hover {
	opacity:2;
	background-color: var(--color-hover)
}
.post__router {
	text-decoration: none;
  color: var(	--color-titles);
}
.post__title {
	margin-top: 1rem;
	font-size: 4rem;
}
.post__content {
	font-size: 2rem;
}
.post-description__container {
	display: flex;
	align-items:baseline;
}
.post-author__name {
	font-size: medium;
	font-weight: 600;
}
.post-author__time {
	font-size: x-small;
	font-weight: lighter;
}
.point_logo {
	margin-left: 1rem;
	margin-right: 1rem;
	margin-bottom: 1rem;
}
/* si la condition userId === element.user.id s'applique donc la class dropdown devient visible */
.user-post:hover .dropdown {
	display: block;
}
.dropdown {
	display: none;
	position: absolute;
	top: 0;
	width: 20rem;
	height: 12.8rem;
	right: -19rem; /* ajustez la position du dropdown à votre besoin */
	background-color: #ffffff;
	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	color: var(--color-text);
	min-width: 180px;
	border-radius: 1rem;
	z-index: 1;
}
.dropdown-general {
	display: flex;
	flex-direction: column;
}
.dropdown-general__item-delete, .dropdown-general__item-edit {
	padding: 1rem;
}
.dropdown-general__item-delete:hover {
	background-color: var(--color-hover);
	opacity: 2;
	border-radius: 1rem 1rem 0 0;
}
.dropdown-general__item-edit:hover {
	background-color: var(--color-hover);
	opacity: 2;
	border-radius: 0 0 1rem 1rem;
}
.item__logo {
	margin-left: 4rem;
}
.item__text {
	padding: 1rem;
	margin-left: 1rem;
	font-size: medium;
	color: var(--color-black);
	border-radius: 3rem;
}
.router {
	display: flex;
}
.dropdown button {
	display: block;
	margin-bottom: 5px;
}
</style>