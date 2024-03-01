<script setup>
import { ref } from 'vue'
import AsideComponent from '../components/AsideComponent.vue';
import IndexPostsComponent from '../components/IndexPostsComponent.vue';
import NavbarComponent from '../components/NavbarComponent.vue'
import FooterComponent from '../components/FooterComponent.vue';

const searchResults = ref([]);
const searchTerm = ref("");

// this function gets the posts from the search bar / navbar.
const onSearchResultUpdated = (searchResultsData) => {
  searchResults.value = searchResultsData;
	console.log('eh ben', searchResults)
}

// this function get the value from the searchBar(mot écrit dans la barre de recherche)
const userSearchBarValue = (userValueData) => {
	searchTerm.value = userValueData;
	console.log('la value de search term home view', searchTerm)
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

	<footer>
		<FooterComponent/>
	</footer>
</template>

<style scoped>
	.container__view{
	display: grid;
	grid-template-areas: "aside main";
	grid-template-columns: 15% 85%;
	}
</style>
