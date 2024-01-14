import { ref } from 'vue';
import axios from 'axios';
import { createToaster } from "@meforma/vue-toaster";
import { defineStore } from 'pinia';
import { useRoute } from 'vue-router';
import { useAuthStore } from '@/stores/Auth';

export const usePostStore = defineStore('Post', () => {
	const toaster = createToaster();
	const isAuthenticated = ref(null);
	const user = ref(null);
	const token = ref();
	const authStore = useAuthStore();
	const posts = ref([]);
	const post = ref([]);
	let route = useRoute();

	async function getPosts() {
		try {
			const response = await axios.get('http://localhost:8000/api/posts')

			if(response.status === 200){
				posts.value = response.data.posts;
				toaster.success(`${response.data.message}`);
			} else {
				toaster.error('any post here');
			}
		} catch (error) {
			console.log("something wrong happened")
		}
	}

	async function getOnePost() {
		try {
			const response = await axios.get('http://localhost:8000/api/post/' + route.params.id)

			if(response.status === 200){
				post.value = response.data;
				toaster.success(`${response.data.message}`);
			} else {
				toaster.error('error here');
			}
		} catch (error) {
			console.log(error)
		}
	}

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

			if(response.status === 200) {
				toaster.success(`${response.data.message}`);
				console.log(`${response.data.message}`);
			} else {
				console.error('there is no data');
			}
		} catch (error) {
			console.error(`Error updating user data. Status: ${response.data.error}`);
			toaster.error (`${response.data.error}`);
		}
	}

	return {
		isAuthenticated,
		token,
		user,
		posts,
		post,
		route,
		getPosts,
		getOnePost,
		createPost
	}
})
