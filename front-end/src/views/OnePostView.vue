<script setup>
import NavbarComponent from '../components/NavbarComponent.vue'
import SinglePostComponent from '../components/SinglePostComponent.vue';
import CreateCommentComponent from '../components/CreateCommentComponent.vue';
import GetCommentsComponent from '../components/GetCommentsComponent.vue';
</script>


<template>
	<header>
    <NavbarComponent/>
	</header>

	<main>
		<SinglePostComponent/>
		<CreateCommentComponent/>
		<GetCommentsComponent/>
	</main>
</template>
