<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use App\Http\Requests\posts;
use Illuminate\Http\Request;
use App\Http\Requests\posts\UpdatePostRequest;
use App\Http\Requests\posts\CreatePostsRequest;

class PostController extends Controller
{
    function __construct()
    {
      $this->middleware('verifyCatigoriesCount')->only(['create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Posts.create')->with('categories', Category::all())->with('tags', Tag::all());;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {



        $image=$request->image->store('posts');

      $post=  Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'image'=>$image,
            'published_at'=>$request->publishe_at,
            'category_id'=>$request->category,
            'user_id'=>auth()->user()->id,



        ]);

        if($request->tags)
        {
            $post->tags()->attach($request->tags);
        }


        session()->flash('success', 'post created successfully');

      return redirect(route('posts.index'));
            //  $posts = new Post();
            //  $posts->create([

            //   'title'=>$request->title,
            // 'description'=>$request->description,
            //   'content'=>$request->content,
            //   'image'=>$request->image

            //  ]);
            //  session()->flash('success','post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
     return view('posts.create')->withPost($post)->with('categories',Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //for hacker
        $data = $request->only(['title','description','published_at']);
        if($request->hasFile('image'))
        {
            $image=$request->image->store('posts');
            $post->deleteImage();
            $data['image']=$image;
        }
        $data['category_id']=$request->category;

        if($request->tags)
        {
            $post->tags()->sync($request->tags);
        }

        $post->update($data);
        session()->flash('success', 'updated successfully');
        return redirect(route('posts.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::withTrashed()->whereId($id)->first();
        if ($post->trashed()) {
            $post->deleteImage();
            $post->forceDelete();
        }
        else
            {
            $post->delete();
            }

        session()->flash('success', 'Post Deleted successfuly');
        return redirect(route('posts.index'));
    }

    public function trashed_post()
        {

            $trashed = Post::onlyTrashed()->get();
            return view('posts.index')->withPosts($trashed);
        }





public function restore($id)
    {

        $post = Post::withTrashed()->whereId($id)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Post Restore Successfully');

        return redirect()->back();

    }
}
