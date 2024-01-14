import { ref } from 'vue';
import { defineStore } from 'pinia';
import { createToaster } from "@meforma/vue-toaster";
import { useAuthStore } from '@/stores/Auth';
import { usePostStore } from '@/stores/Post';
import axios from 'axios';

export const useCommentStore = defineStore('Comment', () => {
	const toaster = createToaster();
	const authStore = useAuthStore();
	const postStore = usePostStore();
	const comments = ref([]);

	async function getCommentByPostId() {
		console.log('function')
		try {
			const postId = postStore.post.post.id;
			console.log('iddddddddddddddd', postId)
			const response = await axios.get(`http://localhost:8000/api/comments/${postId}`,
			{
				headers: {
					Authorization: `Bearer ${authStore.token}`,
				},
				timeout: 50000, 
			});

			console.log('on te cherche', response.data)

			if(response.data) {
				comments.value = response.data;
				console.log('SUCCESS', comments.value)

				toaster.success('on affiche les commentaires');
			} else {
				console.error('error');
			}
		} catch (error) {
			console.log('error', comments.value)
			toaster.error('errorcito')
		}
	}

	async function createComment(newComment) {
		try {
			const postId = postStore.post.post.id;
				const response = await axios.post(`http://localhost:8000/api/createComment/${postId}`, {
					commentary : newComment,
				}, {
					headers: {
						Authorization: `Bearer ${authStore.token}`,
					}
				});

				if(response.status === 200) {
					toaster.success(`${response.data.message}`);
				} else {
					console.error(`${response.data.message}`)
				}
		} catch (error) {
			console.log(error);
			toaster.error(`${response.data.errors.message}`)
		}
	}

	return {
		comments,
		createComment,
		getCommentByPostId,
	}
})
