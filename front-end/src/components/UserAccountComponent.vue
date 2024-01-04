<script setup>
import {ref} from'vue';
import { createToaster } from "@meforma/vue-toaster";
import { RouterLink } from 'vue-router';
import { useAuthStore } from '@/stores/Auth';
import { useUserStore } from '@/stores/User';

const userStore = useUserStore();
const authUser = useAuthStore();
const toaster = createToaster();

//console.log('voici les info de l user', userStore);
//console.log('auth store', authUser)
</script>

<template>
	<div>Personnal account</div>
	<p>user account component</p>
</template>