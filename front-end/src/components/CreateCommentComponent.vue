<script setup>
import { ref } from 'vue';
import { RouterLink } from 'vue-router';
import { createToaster } from "@meforma/vue-toaster";
import { useCommentStore } from '@/stores/Comment';
import GeneralButtonComponent from './Buttons/GeneralButtonComponent.vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const commentStore = useCommentStore();
const toaster = createToaster();
const buttonNameComment = "Create Comment";
const comment = ref("");

const commentInfo =  ref({
	errorMessage: '',
	invalidValues : null,
})

async function submitComment(){
	try {
		await commentStore.createComment(comment.value);
		window.location.reload();
	} catch (error) {
		commentInfo.value.invalidValues = true;
		commentInfo.value.errorMessage = "Not empty value is accepted";
	}
}
</script>

<template>
	<form>
		<textarea class="textarea" v-model="comment" maxlength="300" placeholder="Add comment" id="comment" name="comment"></textarea>
		<p :class="{ 'handle__errors': commentInfo.invalidValues }">
    		{{ commentInfo.errorMessage }}
			</p>
		<RouterLink to="">
			<div class="textarea__button">
				<GeneralButtonComponent @click="submitComment()" :typeOfButton="buttonNameComment" ></GeneralButtonComponent>
			</div>
		</RouterLink>
	</form>
</template>

<style scoped>
.textarea {
	width: 70rem;
	height: 10rem;
	padding: 2rem;
	margin-left: 4rem;
	border-radius: 2rem;
}
::placeholder {
	font-weight: bold;
}
.textarea__button {
	margin-left: 4rem;
	margin-top: 2rem;
	display: flex;
	justify-content:center;
	width: 70rem;
}
.handle__errors {
	margin-left: 5rem;
	margin-top: 2rem;
	font-weight: bold;
	color: red;
}
</style>