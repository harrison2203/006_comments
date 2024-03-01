<script setup>
import CreatePostComponent from '../components/CreatePostComponent.vue';
import NavbarComponent from '../components/NavbarComponent.vue'
import {ref } from'vue';
</script>

<template>
  <header>
    <NavbarComponent/>
	</header>
		<CreatePostComponent/>
</template>
