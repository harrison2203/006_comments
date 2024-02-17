<script setup>
import axios from 'axios';
import { watchEffect, ref, defineEmits } from 'vue'
import { usePostStore } from '@/stores/Post';

const postStore = usePostStore();
console.log('on console log', postStore)
const emits = defineEmits(['search-result-updated', 'user-input-value']);
const searchTerm = ref("");
const titles = ref([]);


//async function callSearchBar () {
//	try {
//		if (searchTerm.value === ''){
//			console.log('vide')
//		} else {
//			await postStore.searchBar(searchTerm.value);
//			emits('user-input-value', searchTerm.value);
//			console.log('remplie')
//		}
//
//	} catch (error) {
//		console.log('errorrrrr', error);
//	}
//}

//callSearchBar();


watchEffect(() => {
  searchBar();
});


async function searchBar(){

	if(searchTerm.value.trim() === ''){

	} else {
		try {
			const response = await axios.get(`http://localhost:8000/api/search/${searchTerm.value}`);
			titles.value = response.data;
			console.log('la donnee', titles.value)

				emits('user-input-value', searchTerm.value);
				emits('search-result-updated', titles.value);
			
		} catch (error) {
			console.log(error)
		}
	}
}

searchBar();



</script>

<template>
	<form @submit.prevent>
		<div class="navbar_input">
			<input v-model="searchTerm" class="input_single" type="text" placeholder="Search..." @keyup="searchBar" @input="$emit('search-result-updated', searchTerm)">

		</div>
</form>
</template>

<style scoped>
.input_single{
	padding: 2rem;
	margin-top: 2rem;
	width: 60rem;
	height: 5rem;
	border-radius: 1rem;
	background-color: var(--color-hover);
	border: none;
	transition: background-color 0.3s;
	}

.input_single:hover{
	background-color: var(--color-hover-two);
	opacity: 2;
	}

</style>