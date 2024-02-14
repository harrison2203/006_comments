import { ref } from 'vue';
import { defineStore } from 'pinia';
import { createToaster } from "@meforma/vue-toaster";
import axios from 'axios';
import { useAuthStore } from '@/stores/Auth';

export const useUserStore = defineStore('User', () => {

	const toaster = createToaster();
	const isAuthenticated = ref(false);
	const user = ref(null);
	const authStore = useAuthStore();
	const  users = ref ([]);

  const setUserData = (data) => {
		isAuthenticated.value = true;
		user.value = data.user;
  };

	async function getUsers() {
		try {
			const response = await axios.get('http://localhost:8000/api/users')
			users.value = response.data.users;

			if (!users.value) {
				console.log('User informaton is empty')
				console.log('empty values', users.value)
			} else {
				console.log('all users information here', users.value)
			}
		} catch (error) {
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

			if (userId || response) {
				toaster.success('You are connected'),
				console.log('la data', response.data, 
										'user id', response.data.user.id)
				setUserData(response.data);
			} else {
				toaster.error('there is not user id')
			}
		} catch (error) {
			toaster.error ('You are not connecteddddd')
		}
	}
	
	async function updateUser(newNameInfo, newEmailInfo) {
		try {
			const userId = authStore.user.id;
			const response = await axios.put(`http://localhost:8000/api/user/update/${userId}`,
			{
				name: newNameInfo,
        email: newEmailInfo,
      },
			{
				headers: {
					Authorization: `Bearer ${authStore.token}`,
				}
			});

			if (userId || response) {
				console.log('Message:', response.data.message, 
										'Updated User:', response.data.user);
			} else {
				console.error(`Error updating user data. Status: ${response.status}`);
			}
		} catch (error) {
			console.error('Error updating user data:', error);
		}
	}

	async function deleteUser() {
		try{
			const userId = authStore.user.id;
			const response = await axios.delete(`http://localhost:8000/api/user/delete/${userId}`,
			{
				headers: {
					Authorization: `Bearer ${authStore.token}`,
				}
			})
			console.log(response.data)
			console.log('testtttttttt', response)
			if(userId === response.data.user.id){
				console.log(`${response.data.messsage}`)
			} else {
				console.error(`${response.data.messsage}`)
			}
		} catch (error) {
			console.error
		}
	}

	return {
		isAuthenticated,
		user,
		users,
		getUsers,
		getUserById,
		updateUser,
		deleteUser
	}
})