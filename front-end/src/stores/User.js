import { ref } from 'vue';
import { defineStore } from 'pinia';
import { createToaster } from "@meforma/vue-toaster";
import axios from 'axios';
import { useAuthStore } from '@/stores/Auth';

export const useUserStore = defineStore('User', () => {

	const toaster = createToaster();
	const isAuthenticated = ref(false);
	const token = ref(null);
	const user = ref(null);
	const authStore = useAuthStore();
	const  users = ref ([]);
	const Patch = ref();


	async function getUsers() {
		try {
			const response = await axios.get('http://localhost:8000/api/users')
			users.value = response.data.users;

			if (!users.value){
				console.log('User informaton is empty')
				console.log('empty values', users.value)
			}else{
				console.log('all users information here', users.value)
			}

		} catch (error){
			console.log('error', error);
			toaster.error('not data found');
			throw error;
		}
	}

	async function getUserById() {
		try {
			const userId = authStore.user.id;
			const response = await axios.get(`http://localhost:8000/api/user/${userId}`,
			{
				headers: {
          Authorization: `Bearer ${authStore.token}`,
				}
			})

			if(userId){
				console.log('UserID:', userId);
				toaster.success('User information by id'),
				console.log('user information', response.data.user.id)
				Patch.value = response.data.user.id;
				console.log('le patch',Patch.value)
			}else{
				toaster.error('there is not user id')
			}
		} catch (error) {
			toaster.error ('The API request has failed')
		}
	}

	return {
		isAuthenticated,
		token,
		user,
		users,
		Patch,
		getUsers,
		getUserById,
	}
})