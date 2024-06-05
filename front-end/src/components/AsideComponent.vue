<script setup>
import { RouterLink } from 'vue-router';
import MyAccountButtonComponent from './Buttons/MyAccountButtonComponent.vue';
</script>

<template>
	<div class="layout">
		<aside class="layout__aside">
			<ul class="aside__list">
				<li class="list__item">
					<img src="../assets/Icons/HomeIcon.svg" class="item__logo" alt="icon__home">
					<RouterLink to="/">
						<a class="item__title">Home</a>
					</RouterLink>
				</li>
				<li class="list__item">
					<img src="../assets/Icons/HomeIcon.svg" class="item__logo" alt="icon__home">
					<a class="item__title"><MyAccountButtonComponent/></a>
				</li>
				<li class="list__item">
					<img src="../assets/Icons/Help.svg" class="item__logo" alt="icon__help">
					<a class="item__title">Help</a>
				</li>
				<li class="list__item">
					<img src="../assets/Icons/Careers.svg" class="item__logo" alt="icon__careers">
					<a class="item__title">Careers</a>
				</li>
			</ul>
		</aside>
	</div>
</template>

<style scoped>

.layout {
	margin-left: 6rem;
	margin-top: 4rem;
	display: flex;
	justify-content: left;
}
.layout__aside {
	margin-top: 2rem;
	margin-bottom: 1rem;
}
.aside__list {
	
}
.list__item {
	margin-bottom: 1.8rem;
	display: flex;
}

.list-item:hover {
	background-color: var(--color-button-dropdown-red);
	opacity: 2;
}
.item__title {
	margin-left: 1rem;
	color: var(--color-black);
}

</style>