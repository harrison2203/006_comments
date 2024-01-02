import { ref, watchEffect } from 'vue';
import { defineStore } from 'pinia';
import { createToaster } from "@meforma/vue-toaster";
import axios from 'axios';

export const useAuthStore = defineStore('Auth', () => {

	const toaster = createToaster();
	const isAuthenticated = ref(false);
	const token = ref(null);
	const user = ref(null);

	const setAuthData = (data) => {
    isAuthenticated.value = true;
    token.value = data.token;
		user.value = data.user;
    localStorage.setItem('authData', JSON.stringify(data));
  };

	async function Authentification(email, password) {
		try {
			const response = await axios.post('http://localhost:8000/api/login', {
				email : email,
				password : password,
			});

			const accessToken = response.data.token;
			if(accessToken){
				axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
				toaster.success('login success');
				console.log('la mega response', response.data);
			}else{
				toaster.error('token is undefined')
			}
			setAuthData(response.data);
		} catch (error) {
			console.log('Login error', error);
			toaster.error ('error has occurred');
		}
	};

	// cette fonction met à jour setAuthData
	watchEffect(() => {
    const storedAuthData = localStorage.getItem('authData');
    if (storedAuthData) {
				const data = JSON.parse(storedAuthData);
				setAuthData(data);
    }
  });

	return {
		isAuthenticated,
		token,
		user,
		Authentification,
	}
})