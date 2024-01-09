import { ref } from 'vue';
import { defineStore } from 'pinia';
import { createToaster } from "@meforma/vue-toaster";
import axios from 'axios';
import { useAuthStore } from '@/stores/Auth';

export const usePostStore = defineStore('Post', () => {
	const toaster = createToaster();
	const isAuthenticated = ref(null);
	const user = ref(null);
	const token = ref();

	const authStore = useAuthStore();
	console.log('le store par ici', authStore)

	async function createPost(title,content) {
		try {
			const userId = authStore.user.id;
			const response = await axios.post(`http://localhost:8000/api/user/${userId}/post/`, {
				title : title,
				content : content,
			}, {
				headers: {
          Authorization: `Bearer ${authStore.token}`,
				}
			});
			toaster.success('success request api');

			// à voir s'il faut effacer ou pas 
			isAuthenticated.value = true;
			user.value = response.data.user;
			token.value = authStore.token.value;

		} catch (error) {
			console.log('error', error);
			toaster.error ('Erro request for post api');
		}
	}
	return {
		isAuthenticated,
		token,
		user,
		createPost,
	}
})
