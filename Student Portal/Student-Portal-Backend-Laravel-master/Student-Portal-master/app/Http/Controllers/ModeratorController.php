<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Moderator;
use App\Models\Instructor;
use App\Models\User;
use App\Models\Post;
use App\Models\Student;
use Illuminate\Http\Request;

class ModeratorController extends Controller
{




    public function store(Request $req)
    {

        Moderator::insert([
            'name' => $req->fullName,
            'email' => $req->email
        ]);
    }




    public function index() {
        $posts = Post::all();
        $students = Student::all();
        $instructors = Instructor::all();
        $categories = Category::with('posts')->get();
        $top_posts = Post::orderBy('views', 'DESC')->with('user')->paginate(3);
        $category_posts = [];
        $category_names = [];
        foreach($categories as $category) {
            array_push($category_names, $category->name);
            array_push($category_posts, count($category->posts));
        }
        return view('moderator.dashboard', [
            'posts' => $posts,
            'students' => $students,
            'instructors' => $instructors,
            'categories' => $categories,
            'top_posts' => $top_posts,
            'category_names' => $category_names,
            'category_posts' => $category_posts
        ]);
    }
    public function posts() {
        $posts = Post::with('user')->get();
        return view('moderator.posts.all', ['posts' => $posts]);
    }
    public function postscreate(){
        $categories = Category::all();
        return view('moderator.posts.create', ['categories' => $categories]);
    }



    public function categories(){
        $categories = Category::with('posts')->get();
        return view('moderator.categories.all', ['categories' => $categories]);
    }
    public function categoriescreate(){
        return view('moderator.categories.create');
    }
    public function categoriesedit($id) {
        $category = Category::where('id', $id)->first();
        return view('moderator.categories.edit', ['category'=>$category]);
    }
    public function subcategories(){
        return view('moderator.sub-categories.all');
    }

    public function users(){
        $users = User::all();
        return view('moderator.users.all', ['users' => $users]);
    }
    public function viewUser($id) {
        $user = User::where('id', $id)->with('posts', 'comments', 'moderator', 'instructor', 'moderator', 'student')->first();
        return view('moderator.users.view', ['user' => $user]);
    }

    public function instructorRequest()
    {
        $users = User::where('type', 'instructor')->where('status', 4)->get();
        return view('moderator.instructor-request', ['users' => $users]);
    }
    public function approveInstructor($id)
    {
        $instructor = User::where('id', $id)->first();
        $instructor->status = 1;
        $instructor->timestamps = false;
        $instructor->update();

        return back();
    }
    public function declineinstructor($id)
    {
        $instructor = User::where('id', $id)->first();
        $instructor->status = -1;
        $instructor->timestamps = false;
        $instructor->update();

        return back();
    }
}
