<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\tags\CreateTagRequest;
use App\Http\Requests\tags\UpdateTagRequest;
;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags.index')->with('tags', Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
        //
        $tag = new Tag();
        $tag->create([
            'name' => $request->name
        ]);

        session()->flash('success', 'Tag created successfully');
        return redirect(route('tags.index'));
        //     $db = new Tag();
        //     $db->name=$request->name;
        //    $db->save();
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
    public function edit(Tag $Tag)
    {
        return view('tags.create')->with('tag', $Tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $Tag)
    {
        $Tag->update([
            'name' => $request->name
        ]);
        // $Tag->name = $request->name;
        // $Tag->save();
        session()->flash('success', 'Tag updated successfully');
        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $Tag)
    {

        if($Tag->posts->count()>0)
         {
             session()->flash('error', 'Tags cannot be, as it\'s associated with posts');
             return redirect()->back();
         }

        $Tag->delete();

        session()->flash('success', 'Tag Deleted Successfully.');

        return redirect(route('tags.index'));
    }
}
