<?php

use App\Http\Controllers\Api\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\SearchController;


Route::get('login', function () {
	return [
		'login',
	];
})->name('login');

Route::post('create-user', [UserController::class, 'createUser']);
Route::post('login', [LoginController::class, 'authenticate']);
Route::middleware('auth:sanctum')->post('logout', [LogoutController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
		Route::get('/user/{userId}', [UserController::class, 'showOneUser']); // ok
		Route::put('/user/update/{userId}', [UserController::class, 'updateUser']); // ok
		Route::delete('/user/delete/{userId}', [UserController::class, 'deleteUser']); // ok
		Route::post('/user/post/{postId}/favorites', [UserController::class, 'favorites']);

		Route::post('/user/{userId}/post/', [PostController::class, 'createOnePost']); // ok
		Route::get('/user/posts/{user_Id}', [PostController::class, 'showPosts']);
		Route::put('/user/{userId}/edit/{postId}', [PostController::class, 'updatePost']);
		Route::delete('/user/{userId}/delete/{postId}', [PostController::class, 'deletePost']);

		Route::post('/createComment/{postId}', [CommentController::class, 'createComment']);
		Route::delete('/user/{user_Id}/deleteComment/{commentId}', [CommentController::class, 'deleteComment']);
	});

	Route::get('/posts', [PostController::class, 'indexPost']); // ok
	Route::get('/post/{postId}', [PostController::class, 'showOnePost']); // ok
	Route::get('/comments/{postId}', [CommentController::class, 'getComments']); //ok
	Route::get('/search/{title}', [SearchController::class, 'search']);
	Route::get('/comments/', [CommentController::class, 'indexComments']);


//Route pour récupérer tous les utilisateurs (non connectés)
Route::get('/users', [UserController::class, 'indexUser']);

//compte admin à modifier
Route::delete('/usersDelete', [AdminController::class, 'deleteUsers']);
Route::delete('/postDelete', [AdminController::class, 'deletePosts']);
Route::delete('/commentsDelete', [AdminController::class, 'deleteComments']);
Route::get('/allComments', [AdminController::class, 'indexComments']);


