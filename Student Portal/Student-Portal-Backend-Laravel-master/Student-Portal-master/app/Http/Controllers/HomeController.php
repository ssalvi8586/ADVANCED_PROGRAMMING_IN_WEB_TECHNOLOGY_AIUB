<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(){
        $notifs = Notification::with('userNotifier','user')
                        ->where('fr_notifier_user_id',session()->get('id'))
                        ->orderBy('created_at','desc')
                        ->limit(5)
                        ->get();
                        //dd($notifs);
        $posts = PostController::all()->take(6);
        session()->put('notifs', $notifs);
        return view('home')->with('posts',$posts);
    }
    public function search(Request $req){
        return redirect()->route('posts.view.search',$req->search);
    }
    public function blog(Request $req){
        $catid = Category::where('name', '=', 'blogs')->first()->id;
        $posts = Post::with('category', 'user')
            ->where('fr_category_id', '=', $catid)
            ->orderBy('id', 'desc')
            ->paginate(5);
        // return view('posts.catview')->with('category', 'chemistry')
        //                                 ->with('posts', $posts);
        return view('blog')->with('posts',$posts);
    }
}
