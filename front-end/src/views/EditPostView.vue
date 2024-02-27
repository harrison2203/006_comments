<script setup>
import NavbarComponent from '../components/NavbarComponent.vue'
import SinglePostComponent from '../components/SinglePostComponent.vue';
import EditPostComponent from '../components/EditPostComponent.vue';

import AsideComponent from '../components/AsideComponent.vue';
</script>

<template>
  <header>
    <NavbarComponent/>
	</header>

	<div class="post__container">
		<aside class="aside">
			<AsideComponent/>
		</aside>

		<main class="main">
			<div>
				<EditPostComponent/>
			</div>
		</main>
	</div>
</template>

<style scoped>
.post__container{
	display: grid;
	grid-template-areas: "aside main";
	grid-template-columns: 15% 85%;
}
</style>