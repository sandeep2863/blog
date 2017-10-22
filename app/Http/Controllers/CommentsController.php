<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Comment;
class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>'store']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$post_id)
    {
        $this->validate($request,['name'=>'required|max:255',
            'email'=>'required|email|max:255',
            'comment'=>'required|min:10|max:500']);
        $post=Post::find($post_id);
        $comment=new Comment();
        $comment->name=$request->name;
        $comment->email=$request->email;
        $comment->comment=$request->comment;
        $comment->approved=true;
        $comment->post()->associate($post);
        $comment->save();
        Session::flash('success','comment was added successfully');
         return redirect()->route('blog.single',$post->slug);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment=Comment::find($id);
        return view('comments.edit',compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment=Comment::find($id);
        $this->validate($request,['comment'=>'required|max:500']);
        $comment->comment=$request->comment;
        $comment->save();
        Session::flash('success','Comment updated successfully');
        return redirect()->route('posts.show',$comment->post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment=Comment::find($id);
        $comment->delete();
        Session::flash('success','Comment deleted Successfully');
        return redirect()->route('posts.show',$comment->post->id);
    }
}
