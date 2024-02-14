<script setup>
import axios from 'axios';
import { watchEffect, ref, defineEmits } from 'vue'

const emits = defineEmits(['search-result-updated', 'user-input-value']);
const searchTerm = ref("");
const titles = ref([]);

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

//searchBar();

</script>

<template>
	<form @submit.prevent>
		<div class="navbar_input">
			<input v-model="searchTerm" class="input_single" type="text" placeholder="Search..." @keyup="searchBar()" @input="$emit('search-result-updated', searchTerm)">
			<div v-if="titles.length > 0">
				<ul>
					<li v-for="post in titles" :key="post.id">
					</li>
				</ul>
    	</div>
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