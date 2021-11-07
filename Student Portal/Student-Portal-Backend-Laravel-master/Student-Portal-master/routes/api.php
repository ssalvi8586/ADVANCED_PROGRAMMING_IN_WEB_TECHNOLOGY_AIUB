<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\commentController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['api-cors', 'web']], function() {
    Route::post('/login', [LoginController::class,'apiVerify']);
    Route::get('/logout', [LogoutController::class,'apiLogout']);

    //POSTS
    Route::get('/posts', [PostController::class, 'apiViewAll']);
    Route::get('/post', [PostController::class, 'apiViewAllPost']);
    Route::get('/posts/category/{cat}', [PostController::class, 'apiViewAllPostCat']);
    Route::post('/create/post', [PostController::class, 'apiCreatePost']);
    Route::get('/posts/search/{text}', [PostController::class,'apiViewSearched']);
    Route::get('/posts/category/{subcat}', [PostController::class,'apiCatwiseView']);
    Route::get('/posts/{id}', [PostController::class,'apiSingleView']);
    Route::post('/posts/vote/{status}/{pid}/{uid}', [PostController::class,'apiVote']);
    Route::delete('/posts/{id}/{uid}', [PostController::class,'apiDeleteSinglePost']);
    Route::post('/posts/comment/{pid}/{uid}', [CommentController::class,'apiCommentPost']);
    Route::get('/categories', [CategoryController::class,'apiGetAll']);

    Route::get('/users/search/{uname}', [UserController::class, 'apiSearch']);
    //Registration
    Route::post('/student/registration', [RegistrationController::class, 'apiStudentVerify']);
    Route::post('/instructor/registration', [RegistrationController::class, 'apiInstructorVerify']);
    Route::post('/moderator/registration', [RegistrationController::class, 'apiModeratorVerify']);
    Route::get('/profile/{uname}', [UserController::class,'apiView']);
    Route::delete('/profile/{uname}', [UserController::class,'apiOwnProfileDelete']);
    Route::post('/profile/basic/{uname}', [UserController::class,'apiProfileUpdate']);
    Route::post('/profile/password/{uname}', [UserController::class,'apiPassUpdate']);


    Route::group(['middleware' => ['api-general-login']], function() {
        Route::post('/posts/create', [PostController::class,'apiAdminCreate']);
        Route::delete('/posts/{id}/delete', [PostController::class,'apiDelete']);
        Route::post('/posts/edit', [PostController::class,'apiUpdate']);
        Route::get('/posts/upvote/{post_id}', [VoteController::class, 'apiUpVote'])->name('posts.upvote');
        Route::get('/posts/downvote/{post_id}', [VoteController::class, 'apiDownVote'])->name('posts.downvote');
        Route::post('/posts/comment/{post_id}', [commentController::class, 'apiInsertComment']);
        Route::post('/profile/info/edit', [UserController::class,'apiUpdate']);

        Route::group(['middleware' => ['api-general-login', 'web', 'api-admin-login']], function() {

            Route::get('/admin/dashboard/data', [AdminController::class, 'apiDashboardData']);

            Route::post('/admin/categories/create', [CategoryController::class,'apiCreate']);
            Route::post('/admin/categories/edit', [CategoryController::class, 'apiEdit']);
            Route::delete('/admin/categories/delete/{id}', [CategoryController::class, 'apiDelete']);

            Route::delete('/admin/posts/delete/{id}', [PostController::class, 'apiAdminDelete']);

            Route::get('/admin/users', [UserController::class,'apiGetAll']);
            Route::get('/admin/users/{id}', [UserController::class, 'apiViewUser']);
            Route::delete('/admin/users/delete/{id}', [UserController::class, 'apiDelete']);
            Route::post('/admin/users/role/edit-role', [UserController::class, 'apiChangeRole']);
            Route::get('/admin/users/ban/{id}', [UserController::class, 'apiBan']);
            Route::get('/admin/users/unban/{id}', [UserController::class, 'apiUnban']);
            Route::get('/admin/users/toggle_ban/{id}', [UserController::class, 'apiToggleBan']);

            Route::get('/admin/moderator/request', [AdminController::class,'apiModeratorRequests']);
            Route::get('/admin/moderator/approve/{id}', [AdminController::class, 'apiApproveModerator']);
            Route::get('/admin/moderator/decline/{id}', [AdminController::class, 'apiDeclineModerator']);

            Route::get('/admin/instructor/request', [AdminController::class,'apiInstructorRequests']);
            Route::get('/admin/instructor/approve/{id}', [AdminController::class, 'apiApproveInstructor']);
            Route::get('/admin/instructor/decline/{id}', [AdminController::class, 'apiDeclineInstructor']);
        });
    });

});

