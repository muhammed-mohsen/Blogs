<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Category;
use App\Post;

class WelcomeController extends Controller
{
  public function index()
      {


        // $search = request()->query('search');
        // if($search)
        // {
        //     $post=Post::where('title','LIKE',"%{$search}%")->simplePaginate(3);
        // }
        // else {
        //     $post= Post::simplePaginate(3);
        // }

       return view('welcome')->with('tags',Tag::all())
       ->with('categories',Category::all())
       ->with('posts',Post::Searched()->simplePaginate(2));

      }
}
