<script setup>
import { ref } from 'vue'
import AsideComponent from '../components/AsideComponent.vue';
import IndexPostsComponent from '../components/IndexPostsComponent.vue';
import NavbarComponent from '../components/NavbarComponent.vue'

const searchResults = ref([]);
const searchTerm = ref("");

// this function gets the result from the search bar / navbar.
const onSearchResultUpdated = (searchResultsData) => {
  searchResults.value = searchResultsData;
	console.log('eh ben', searchResultsData.value)
}

// this function get the value from the searchBar
const userSearchBarValue = (userValueData) => {
	searchTerm.value = userValueData;
	console.log('eh benddfdsfsdf', searchTerm.value)
}
</script>

<template>
  <header>
    <NavbarComponent @search-result-updated="onSearchResultUpdated" @user-input-value="userSearchBarValue"/>
	</header>

	<div class="container__view">
		<aside class="aside">
			<AsideComponent/>
		</aside>
		<main class="main">
			<IndexPostsComponent :searchResultsProp="searchResults" :inputValueProp="searchTerm"/>
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
