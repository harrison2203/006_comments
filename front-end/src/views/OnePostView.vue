<script setup>
import NavbarComponent from '../components/NavbarComponent.vue'
import SinglePostComponent from '../components/SinglePostComponent.vue';
import CreateCommentComponent from '../components/CreateCommentComponent.vue';
import GetCommentsComponent from '../components/GetCommentsComponent.vue';
import AsideComponent from '../components/AsideComponent.vue';

</script>

<template>
  <header>
    <NavbarComponent/>
	</header>
	<div class="container__view">
		<aside class="aside">
			<AsideComponent/>
		</aside>
		<main class="main">
			<SinglePostComponent/>
			<CreateCommentComponent/>
			<GetCommentsComponent/>
		</main>
	</div>
</template>

<style scoped>
	.container__view{
	display: grid;
	grid-template-areas: "aside main";
	grid-template-columns: 15% 85%;
	}
</style>