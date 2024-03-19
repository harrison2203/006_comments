<script setup>
import EditUserComponent from '../components/EditUserComponent.vue';
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
			<div class="main__user-page">
				<EditUserComponent/>
			</div>
		</main>
	</div>
</template>

<style scoped>
.general__container{
	display: grid;
	grid-template-areas: "aside main";
	grid-template-columns: 15% 60%;
}
.main{
	margin-top: 4rem;
	padding-left: 7.5rem;
}
</style>