<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Carbon;


use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index(){
        return view('instructor.index');
    }

    public function postsave(Request $req){
        dd($req);
        // Post::insert([
        //     'title' => $req->title,
        //     'fr_user_id' => $req->session()->get('id'),
        //     'fr_category_id' => $req->category,
        //     'pbody' => $req->decription,
        //     'views' => 1,
        //     'status' => 1,
        //     'created_at' => Carbon::now()

        // ]);
        // return view('instructor.create-post');
    }
}
