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
		console.log('Setting auth data:', data);
    isAuthenticated.value = true;
    token.value = data.token;
		user.value = data.user;
    localStorage.setItem('authData', JSON.stringify(data));
  };


	async function singInStore (name, email, password) {
		try {
			axios.defaults.headers.common['Content-Type'] = 'application/json';
			const response = await axios.post('http://localhost:8000/api/create-user',
			{
				name: name,
				email: email,
				password: password,
			});
			console.log("ACCOUNT", response);
			if(response.status === 201) {
				console.log(`${response.data.message}`);

			} else {
				console.error(`delete error: ${response.data.error}`);
			}

		} catch (error) {
			console.log(error)
		}
	}

	async function authentification(email, password) {
		try {
			const response = await axios.post('http://localhost:8000/api/login', {
				email : email,
				password : password,
			});

			const accessToken = response.data.token;
			if(accessToken){
				axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
				toaster.success('login success');
				console.log('la mega response', accessToken);
			}else{
				toaster.error('token is undefined')
				isAuthenticated.value = false;
			}
			setAuthData(response.data);
		} catch (error) {
			console.log('Login error', error);
			toaster.error ('error has occurred pour le login');
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

	async function logout() {
		try {
			const response = await axios.post('http://localhost:8000/api/logout',
			{},{
				headers: {
          Authorization: `Bearer ${token.value}`,
				}
			});

			const accessToken = response.data.token;

			if (accessToken === undefined || accessToken === null) {
				toaster.success('logout success');
				localStorage.removeItem('authData'); 
				isAuthenticated.value = false;
				return isAuthenticated.value;
				
			}else{
				toaster.error('error')
			}
		} catch (error) {
			toaster.error('You are already logged out');
		}
	}

	return {
		isAuthenticated,
		token,
		user,
		authentification,
		logout,
		singInStore,
	}
})