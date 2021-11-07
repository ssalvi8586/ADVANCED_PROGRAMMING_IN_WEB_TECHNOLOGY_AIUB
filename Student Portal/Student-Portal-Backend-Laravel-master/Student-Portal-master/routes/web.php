<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MsgController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Http\Controllers\commentController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/blog', [HomeController::class,'blog'])->name('blog');
Route::post('/', [HomeController::class,'search'])->name('home.search');

//------------LOGIN SECTION-------------//
Route::get('/login', [LoginController::class,'index'])->name('login.index');
Route::post('/login', [LoginController::class,'verify'])->name('login.verify');
Route::get('/logout', [LogoutController::class,'index'])->name('logout.index');

//------------REGISTRATION SECTION-------------//
Route::get('/registration', [RegistrationController::class,'index'])->name('registration.index');
Route::get('/student/registration', [RegistrationController::class,'studentindex'])->name('student.registration.index');
Route::get('/instructor/registration', [RegistrationController::class,'instructorindex'])->name('instructor.registration.index');
Route::get('/moderator/registration', [RegistrationController::class,'moderatorindex'])->name('moderator.registration.index');
Route::post('/student/registration', [RegistrationController::class,'studentverify'])->name('student.registration.verify');
Route::post('/instructor/registration', [RegistrationController::class,'instructorverify'])->name('instructor.registration.verify');
Route::post('/moderator/registration', [RegistrationController::class,'moderatorverify'])->name('moderator.registration.verify');


//------------PROFILE SECTION-------------//
Route::get('/profile/{uname}', [UserController::class,'view'])->name('profile.view');
Route::group(['middleware' => ['general-login']], function () {
    Route::get('/profile/info/edit', [UserController::class,'edit'])->name('profile.edit');
    Route::post('/profile/info/edit', [UserController::class,'update'])->name('profile.edit.verify');
    //Route::post('/profile/info/edit', [UserController::class,'passupdate'])->name('profile.edit.passverify');
    Route::get('/posts/create', [PostController::class,'createview'])->name('posts.create.view');
    Route::post('/posts/create', [PostController::class,'create'])->name('posts.create.save');
    Route::get('/posts/{subcat}/{id}/edit', [PostController::class,'edit'])->name('posts.edit');
    Route::post('/posts/{id}/delete', [PostController::class,'delete'])->name('posts.delete');
    Route::post('/posts/{subcat}/{id}/edit', [PostController::class,'update'])->name('posts.update');
    Route::get('/posts/upvote/{post_id}/{user_id}', [VoteController::class, 'upVote'])->name('posts.upvote');
    Route::get('/posts/downvote/{post_id}/{user_id}', [VoteController::class, 'downVote'])->name('posts.downvote');
    //------------MSG SECTION-------------// Later
    Route::get('/msg/{uname}', [MsgController::class,'index'])->name('msg.view');
});

//------------POST SECTION-------------//
Route::get('/posts', [PostController::class,'viewall'])->name('posts.view.all');

Route::get('/posts/search/{text}', [PostController::class,'viewsearched'])->name('posts.view.search');

//Route::post('/posts/create/edit', [PostController::class,'edit'])->name('posts.edit.save');
Route::get('/posts/{subcat}', [PostController::class,'catwiseview'])->name('posts.view.cat');
Route::get('/posts/{subcat}/{id}', [PostController::class,'singleview'])->name('posts.view.single');
// Route::post('/', [PostController::class,'update'])->name('posts.update');



//------------ADMIN SECTION-------------//
Route::group(['middleware' => ['admin-panel']], function() {
    Route::get('/admin', [AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/admin/posts/all', [AdminController::class,'posts'])->name('admin.posts');
    Route::get('/admin/posts/create', [AdminController::class,'postscreate'])->name('admin.posts.create');
    Route::post('/admin/posts/create', [PostController::class, 'adminCreate'])->name('admin.posts.create-POST');
    Route::get('/admin/posts/delete/{id}', [PostController::class, 'delete'])->name('admin.posts.delete');
    Route::get('/admin/website-info', [AdminController::class,'webinfo'])->name('admin.web.info');
    Route::post('/admin/update/website-info', [AdminController::class, 'updateWebsiteInfo'])->name('admin.update.web-info');
    Route::get('/admin/categories', [AdminController::class,'categories'])->name('admin.categories');
    Route::get('/admin/categories/search/{keyword}', [Category::class, 'searchJSON'])->name('admin.categories.search');
    Route::get('/admin/categories/create', [AdminController::class,'categoriescreate'])->name('admin.categories.create');
    Route::post('/admin/categories/create', [CategoryController::class,'create'])->name('admin.categories.create');
    Route::get('/admin/categories/{id}', [CategoryController::class,'delete'])->name('admin.categories.delete');
    Route::get('/admin/categories/edit/{id}', [AdminController::class, 'categoriesedit'])->name('admin.categories.edit');
    Route::post('/admin/categories/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit-POST');
    Route::post('/admin/users/edit/type', [UserController::class, 'changeRole'])->name('admin.users.edit.type-POST');
    Route::get('/admin/users', [AdminController::class,'users'])->name('admin.users');
    Route::get('/admin/users/view/{id}', [AdminController::class, 'viewUser'])->name('admin.users.view');
    Route::get('/admin/users/delete/{id}', [UserController::class, 'delete'])->name('admin.users.delete');
    Route::get('/admin/users/ban/{id}', [UserController::class, 'ban'])->name('admin.users.ban');
    Route::get('/admin/users/unban/{id}', [UserController::class, 'unban'])->name('admin.users.unban');
    Route::get('/admin/moderator/request', [AdminController::class,'moderatorreq'])->name('admin.mod.req');
    Route::get('/admin/roles', [AdminController::class,'roles'])->name('admin.roles');
    Route::get('/admin/moderator/request', [AdminController::class,'moderatorRequest'])->name('admin.moderator.request');
    Route::get('/admin/moderator/approve/{id}', [AdminController::class, 'approveModerator'])->name('admin.moderator.approve');
    Route::get('/admin/moderator/decline/{id}', [AdminController::class, 'declineModerator'])->name('admin.moderator.decline');
});


//------------MODERATOR SECTION-------------//
// Route::get('/moderator', [ModeratorController::class,'index'])->name('moderator.dashboard');
// Route::get('/moderator/posts', [ModeratorController::class,'posts'])->name('moderator.posts');
// Route::get('/moderator/posts/create', [ModeratorController::class,'postscreate'])->name('moderator.posts.create');
// Route::get('/moderator/sub-categories', [ModeratorController::class,'subcategories'])->name('moderator.sub.categories');
// Route::get('/moderator/sub-categories/create', [ModeratorController::class,'subcategoriescreate'])->name('moderator.sub.categories.create');
// Route::get('/moderator/users', [ModeratorController::class,'users'])->name('moderator.users');
// // Route::get('/moderator/edit/{uname}', [ModeratorController::class,'useredit'])->name('moderator.user.edit');
// Route::get('/moderator/instructor/request', [ModeratorController::class,'instructorreq'])->name('moderator.mod.req');


Route::group(['middleware' => ['admin-panel-moderator']], function() {
    Route::get('/moderator', [moderatorController::class,'index'])->name('moderator.dashboard');
    Route::get('/moderator/posts/all', [moderatorController::class,'posts'])->name('moderator.posts');
    Route::get('/moderator/posts/create', [moderatorController::class,'postscreate'])->name('moderator.posts.create');
    Route::post('/moderator/posts/create', [PostController::class, 'create'])->name('moderator.posts.create-POST');

    Route::get('/moderator/categories', [moderatorController::class,'categories'])->name('moderator.categories');
    Route::get('/moderator/categories/search/{keyword}', [Category::class, 'searchJSON'])->name('moderator.categories.search');
    Route::get('/moderator/categories/create', [moderatorController::class,'categoriescreate'])->name('moderator.categories.create');
    Route::post('/moderator/categories/create', [CategoryController::class,'create'])->name('moderator.categories.create');
    Route::get('/moderator/categories/{id}', [CategoryController::class,'delete'])->name('moderator.categories.delete');
    Route::get('/moderator/categories/edit/{id}', [moderatorController::class, 'categoriesedit'])->name('moderator.categories.edit');
    Route::post('/moderator/categories/edit', [CategoryController::class, 'edit'])->name('moderator.categories.edit-POST');
    Route::post('/moderator/users/edit/type', [UserController::class, 'changeRole'])->name('moderator.users.edit.type-POST');
    Route::get('/moderator/users', [moderatorController::class,'users'])->name('moderator.users');
    Route::get('/moderator/users/view/{id}', [moderatorController::class, 'viewUser'])->name('moderator.users.view');

    Route::get('/moderator/users/ban/{id}', [UserController::class, 'ban'])->name('moderator.users.ban');
    Route::get('/moderator/users/unban/{id}', [UserController::class, 'unban'])->name('moderator.users.unban');
    Route::get('/moderator/moderator/request', [moderatorController::class,'moderatorreq'])->name('moderator.mod.req');
    Route::get('/moderator/instructor/request', [moderatorController::class,'instructorRequest'])->name('moderator.instructor.request');
    Route::get('/moderator/instructor/approve/{id}', [moderatorController::class, 'approveInstructor'])->name('moderator.instructor.approve');
    Route::get('/moderator/instructor/decline/{id}', [moderatorController::class, 'declineInstructor'])->name('moderator.instructor.decline');
    Route::post('/posts/{subcat}/{id}', [commentController::class,'insertComment'])->name('comment.add');

});


//------------INSTRUCTOR SECTION-------------//
Route::group(['middleware' => ['moderator-panel-instructor']], function() {
Route::get('/instructor', [InstructorController::class,'index'])->name('instructor.dashboard');
Route::get('/instructor/group/{gid}', [InstructorController::class,'groups'])->name('instructor.groups');
Route::get('/instructor/group/create', [InstructorController::class,'groupcreate'])->name('instructor.groups.create');
});
//------------STUDENT SECTION-------------//
Route::get('/student', [StudentController::class,'index'])->name('student.dashboard');
Route::get('/student/group/{gid}', [StudentController::class,'groups'])->name('student.groups');
