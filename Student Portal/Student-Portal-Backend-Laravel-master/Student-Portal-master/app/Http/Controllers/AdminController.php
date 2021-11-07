<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Student;
use App\Models\Admin;
use App\Models\Moderator;

class AdminController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $students = Student::all();
        $instructors = Instructor::all();
        $categories = Category::with('posts')->get();
        $top_posts = Post::orderBy('views', 'DESC')->with('user')->paginate(3);
        $category_posts = [];
        $category_names = [];
        foreach ($categories as $category) {
            array_push($category_names, $category->name);
            array_push($category_posts, count($category->posts));
        }
        return view('admin.dashboard', [
            'posts' => $posts,
            'students' => $students,
            'instructors' => $instructors,
            'categories' => $categories,
            'top_posts' => $top_posts,
            'category_names' => $category_names,
            'category_posts' => $category_posts
        ]);
    }
    public function posts()
    {
        $posts = Post::with('user', 'category')->get();
        return view('admin.posts.all', ['posts' => $posts]);
    }
    public function postscreate()
    {
        $categories = Category::all();
        return view('admin.posts.create', ['categories' => $categories]);
    }
    public function webinfo()
    {
        $path = storage_path() . "\json\info.json";
        $info = json_decode(file_get_contents($path));
        return view('admin.websiteinfo', ['info' => $info]);
    }

    public function updateWebsiteInfo(Request $req)
    {
        $info = [
            "name" => $req->input('website-name'),
            "about" => $req->input('website-about'),
            "email" => $req->input('website-email')
        ];

        $path = storage_path() . "/json/info.json";
        file_put_contents($path, json_encode($info));

        return back();
    }
    public function categories()
    {
        $categories = Category::with('posts')->get();
        return view('admin.categories.all', ['categories' => $categories]);
    }
    public function categoriescreate()
    {
        return view('admin.categories.create');
    }
    public function categoriesedit($id)
    {
        $category = Category::where('id', $id)->first();
        return view('admin.categories.edit', ['category' => $category]);
    }
    public function subcategories()
    {
        return view('admin.sub-categories.all');
    }
    public function roles()
    {
        return view('admin.roles');
    }
    public function users()
    {
        $users = User::all();
        return view('admin.users.all', ['users' => $users]);
    }
    public function viewUser($id)
    {
        $user = User::where('id', $id)->with('posts', 'comments', 'admin', 'instructor', 'moderator', 'student')->first();
        return view('admin.users.view', ['user' => $user]);
    }
    public function moderatorRequest()
    {
        $users = User::where('type', 'moderator')->where('status', 4)->get();
        return view('admin.moderator-requests', ['users' => $users]);
    }
    public function apiModeratorRequests()
    {
        $users = User::where('type', 'moderator')->where('status', 4)->get();
        return response()->json($users, 200);
    }



    public function approveModerator($id)
    {
        $moderator = User::where('id', $id)->first();
        $moderator->status = 1;
        $moderator->timestamps = false;
        $moderator->update();

        return back();
    }
    public function apiApproveModerator($id)
    {
        $moderator = User::where('id', $id)->first();
        if ($moderator === null) return response()->json(false, 404);
        $moderator->status = 1;
        $moderator->timestamps = false;
        $moderator->update();

        return response()->json($moderator, 200);
    }



    public function apiDeclineModerator($id)
    {
        $moderator = User::where('id', $id)->first();
        if ($moderator === null) return response()->json(false, 404);
        $moderator->status = 2;
        $moderator->timestamps = false;
        $moderator->update();

        return response()->json($moderator, 200);
    }


    public function apiInstructorRequests()
    {
        $users = User::where('type', 'instructor')->where('status', 4)->get();
        return response()->json($users, 200);
    }

    public function apiApproveInstructor($id)
    {
        $instructor = User::where('id', $id)->first();
        if ($instructor === null) return response()->json(false, 404);
        $instructor->status = 1;
        $instructor->timestamps = false;
        $instructor->update();

        return response()->json($instructor, 200);
    }
    public function apiDeclineInstructor($id)
    {
        $instructor = User::where('id', $id)->first();
        if ($instructor === null) return response()->json(false, 404);
        $instructor->status = 2;
        $instructor->timestamps = false;
        $instructor->update();

        return response()->json($instructor, 200);
    }


    public function apiDashboardData()
    {
        $categories = category::all();

        $students = User::where('type', 'student')->get();
        $instructors = User::where('type', 'instructor')->get();
        $admins = User::where('type', 'admin')->get();
        $moderators = User::where('type', 'moderator')->get();

        $top_posts = Post::with('user', 'upvotes')->get()->sortByDesc(function ($p) {
            return count($p->upvotes);
        })->values()->take(3);

        $top_posts_final = [];
        foreach ($top_posts as $index => $post) {
            if ($post->user->type === "admin") {
                $userDetails = Admin::where('fr_user_id', $post->user->id)->first();
            } else if ($post->user->type === "moderator") {
                $userDetails = Moderator::where('fr_user_id', $post->user->id)->first();
            } else if ($post->user->type === "instructor") {
                $userDetails = Instructor::where('fr_user_id', $post->user->id)->first();
            } else if ($post->user->type === "student") {
                $userDetails = Student::where('fr_user_id', $post->user->id)->first();
            }
            array_push($top_posts_final, [
                'id' => $post->id,
                'title' => $post->title,
                'uname' => $post->user->uname,
                'user_avatar' => url('/') . '/upload/' . $userDetails->image
            ]);
        }
        $student_count = count($students);
        $instructor_count = count($instructors);
        $admin_count = count($admins);
        $moderator_count = count($moderators);

        $category_data = [];
        foreach ($categories as $cat) {
            array_push($category_data, [
                'name' => $cat->name,
                'post_count' => count($cat->posts)
            ]);
        }

        $data = [
            "student_count" => $student_count,
            "instructor_count" => $instructor_count,
            "admin_count" => $admin_count,
            "moderator_count" => $moderator_count,
            "category_data" => $category_data,
            "students" => $students,
            "instructors" => $instructors,
            "top_posts" => $top_posts_final
        ];
        return response()->json($data, 200);
    }
}
