<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    //
    function apiGetAll()
    {
        $categories = category::all()->sortByDesc(function ($item) {
            return count($item->posts);
        })->values();
        return response()->json($categories, 200);
    }
    function create(Request $req)
    {
        $req->validate([
            'name' => 'required|max:30'
        ]);

        $category = new Category();
        $category->name = $req->input('name');
        $category->save();

        $req->session()->flash('success', 'Category name '.$category->name.' created successfully');

        return back();
    }
    function apiCreate(Request $req)
    {
        $req->validate([
            'name' => 'required|max:30'
        ]);

        $category = new Category();
        $category->name = $req->input('name');
        $category->save();

        return response()->json($category, 201);
    }
    function all()
    {
        return category::all();
    }
    function delete($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->route('moderator.categories');

    }
    function apiDelete($id)
    {
      $category = Category::find($id);
      if($category === null) {
        return response()->json('Category not found', 404);
      }

      $posts = Post::where('fr_category_id', $id)->get();
      if(count($posts) > 0) {
        foreach ($posts as $post) {
          $post->fr_category_id = 1;
          $post->save();
        }
      }

      $category->delete();

      return response()->json([
        'category' => $category,
        'effect_posts' => count($posts)
      ], 200);
    }
    function edit(Request $req)
    {
        $category = Category::where('id', $req->input('id'))->first();
        $category->name = $req->input('name');
        $category->update();

        return redirect()->route('moderator.categories');
    }
    function apiEdit(Request $req)
    {
        $category = Category::where('id', $req->input('id'))->first();
        $category->name = $req->input('name');
        $category->update();

        return response()->json($category, 200);
    }
    function searchJSON($keyword)
    {
        $category = Category::query()->whereLike('name', $keyword);
        return json_encode($category);
    }
}
