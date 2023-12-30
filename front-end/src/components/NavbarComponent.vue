<script setup>

</script>

<template>

	<nav class="navbar">
			<div class="navbar_image">
				<img src="../assets/img/logo.svg" class="image_logo" alt="icon_navbar">
			</div>

			<div class="navbar_menu">
				<ul class="menu_list">
					<li class="list_option">
						<a class="list_link">Home</a>
					</li>
					<li class="list_option">
						<a class="list_link">My account</a>
					</li>
				</ul>
			</div>

			<div class="navbar_input">
				<input class="input_single" type="text" placeholder="Search...">
			</div>

		<div class="navbar_buttons">
			<button class="buttons_option">
				Login
			</button>
			<button class="buttons_option">
				Sign-up
			</button>
			<button class="buttons_option">
				Logout
			</button>
		</div>
	</nav>

</template>

<style scoped>

.navbar{
	background-color: var(--color-secondary);
	height: auto;
	display: grid;
	grid-template-areas: "image menu input buttons";
	grid-template-columns: 10% 25% 35% 30%
}

.navbar_image{
	grid-area: image;
	position: relative;
	width: 4rem;
	display: inline-block;
	margin-top: 1rem;
	z-index: 1; /* capa uno */
}

.image_logo{
	width: 100%;
	padding: 10px 20px 10px;
}

.navbar_menu{
	grid-area: menu;
}
</style>
