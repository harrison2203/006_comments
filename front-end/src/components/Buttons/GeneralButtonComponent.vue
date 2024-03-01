<script setup>
	import { defineProps } from 'vue';
	const { typeOfButton } = defineProps(['typeOfButton']);
</script>

<template>
	<button class="buttons__option">
		<slot>
			{{ typeOfButton }}
		</slot>
	</button>
</template>

<style scoped>
.buttons__option {
	width: 20rem;
	height: 5rem;
	border-radius: 1.2rem;
	margin-top: 2rem;
	background-color: var(--color-black);
	color: var(--color-background);
	font-weight: bold;
	border: none;
}
.buttons__option:hover {
	background-color: var(--color-button-dropdown-red);
	opacity: 2;
}
</style>