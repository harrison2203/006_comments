<script setup>
import IndexUserPageComponent from '../components/IndexUserPageComponent.vue';
import NavbarComponent from '../components/NavbarComponent.vue'
import AsideComponent from '../components/AsideComponent.vue';

</script>

<template>
	  <header>
    <NavbarComponent/>
	</header>
	<div class="general__container">
		<aside class="aside">
			<AsideComponent/>
		</aside>

		<main class="main">
			<IndexUserPageComponent/>
		</main>
	</div>
</template>


<style scoped>
.general__container{
	display: grid;
	grid-template-areas: "aside main";
	grid-template-columns: 15% 50%;
}

.main{
	margin-top: 4rem;
	padding-left: 7.5rem;
}
</style>