import { ref } from 'vue';
import { defineStore } from 'pinia';
import { createToaster } from "@meforma/vue-toaster";
import { useAuthStore } from '@/stores/Auth';
import { usePostStore } from '@/stores/Post';
import axios from 'axios';
import { useRoute } from 'vue-router';

export const useCommentStore = defineStore('Comment', () => {
	const toaster = createToaster();
	const authStore = useAuthStore();
	const postStore = usePostStore();
	const comments = ref([]);
	let route = useRoute();


	async function getCommentByPostId() {
		try {
			const response = await axios.get('http://localhost:8000/api/comments/' + route.params.id);
			
			console.log('on te cherche', response.data);
			comments.value = response.data.comments;

		} catch (error) {
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
