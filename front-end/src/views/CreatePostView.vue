<script setup>
import CreatePostComponent from '../components/CreatePostComponent.vue';
import NavbarComponent from '../components/NavbarComponent.vue'
import {ref } from'vue';

const postTitle = ref('');
const postContent = ref('');

function receiveCreatePostValues (newTitleValue, newContentValue) {
	postTitle.value = newTitleValue;
	postContent.value = newContentValue;
}

</script>

<template>
  <header>
    <NavbarComponent/>
	</header>
	<CreatePostComponent @test="receiveCreatePostValues"/>
</template>
