<?php

use App\Http\Controllers\Api\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;

// Routes pour gérer le Login
Route::get('login', function () {
	return [
		'login',
	];
})->name('login');

// Route pour créer un utilisateur
Route::post('create-user', [UserController::class, 'createUser']);
// Routes pour gérer le Login
Route::post('login', [LoginController::class, 'authenticate']);
//Route pour le logout
Route::middleware('auth:sanctum')->post('logout', [LogoutController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {

	Route::get('/user/{userId}', [UserController::class, 'showOneUser']); // ok
	Route::put('/user/update/{userId}', [UserController::class, 'updateUser']); // ok
	Route::delete('/user/delete/{userId}', [UserController::class, 'deleteUser']); // ok

	Route::post('/user/{userId}/post/', [PostController::class, 'createOnePost']); // ok
	Route::get('/user/posts/{user_Id}', [PostController::class, 'showPosts']);
	Route::put('/user/{userId}/edit/{postId}', [PostController::class, 'updatePost']);
	Route::delete('/user/{userId}/delete/{postId}', [PostController::class, 'deletePost']);

	Route::get('/comments/', [CommentController::class, 'indexComments']);
	Route::post('/createComment/{postId}', [CommentController::class, 'createComment']);
	Route::get('/comments/{postId}', [CommentController::class, 'getComments']);
	Route::delete('/user/{user_Id}/deleteComment/{commentId}', [CommentController::class, 'deleteComment']);
});


// Route pour récupérer tous les posts
Route::get('/posts', [PostController::class, 'indexPost']); // ok
// Route pour récupérer un post par l'id
Route::get('/post/{postId}', [PostController::class, 'showOnePost']); // ok

//Route pour récupérer tous les utilisateurs (non connectés)
Route::get('/users', [UserController::class, 'indexUser']);


Route::delete('/usersDelete', [AdminController::class, 'deleteUsers']);
Route::delete('/postDelete', [AdminController::class, 'deletePosts']);
Route::delete('/commentsDelete', [AdminController::class, 'deleteComments']);
Route::get('/allComments', [AdminController::class, 'indexComments']);
