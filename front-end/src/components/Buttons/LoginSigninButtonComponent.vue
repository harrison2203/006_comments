<script setup>
	import { defineProps } from 'vue';
	const { buttonText } = defineProps(['buttonText']);
</script>

<template>
	<button class="button__submit">
		<slot>
			{{ buttonText }}
		</slot>
	</button>
</template>

<style scoped>
.button__submit{
	height: 4.8rem;
	width: 50rem;
	border-radius: 1rem;
	margin-top: 5rem;
	border: none;
	background-color: var(--color-black);
	color: var(--color-background);
	font-weight: bold;
}
.button__submit:hover {
	background-color: var(--color-button-dropdown-red);
	opacity: 2;
}
</style>