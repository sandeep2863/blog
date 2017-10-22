<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
//use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mews\Purifier\Facades\Purifier;
use Intervention\Image\Facades\Image;
class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post=Post::orderBy('id','desc')->paginate(4);
        return view('posts.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();
        return view('posts.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the data
        $this->validate($request,  ['body'=>'required',
            'slug'=>'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'=>'required|integer',
            'title'=>'required|max:255'

        ]);
        //store in db
        $post = new Post;
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id=$request->input('category_id');
        $post->body = Purifier::clean($request->input('body'));
        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $file_name=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/'.$file_name);
            Image::make($image)->resize(800,400)->Save($location);
            $post->image=$file_name;
        }
        $post->save();
        $post->tags()->sync($request->tags,false);
        //redirect to another page
        Session::flash('success','The post was succesfully submitted');
        return redirect()->route('posts.show',$post->id);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);

       return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        $categories=Category::all();

        $tags=Tag::all();
        return view('posts.edit',compact('post','categories','tags'));
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

        //validate the data'
        $post=Post::find($id);
        if($request->input('slug')==$post->slug)
        {
            $this->validate($request,  ['body'=>'required',
                'category_id'=>'required|integer',
                'title'=>'required|max:255'

            ]);
        }
        else{
            $this->validate($request,  ['body'=>'required',
                'slug'=>'required|alpha_dash|min:5|max:255|unique:posts,slug'
                ,'category_id'=>'required|integer',
                'title'=>'required|max:255'

            ]);
        }

        $post=Post::find($id);
        $post->title=$request->title;
        $post->slug = $request->slug;
        $post->category_id=$request->category_id;
        $post->body=Purifier::clean($request->body);
        $post->save();
        $post->tags()->sync($request->tags);
        Session::flash('success','Post Successfully updated');
        return redirect()->route('posts.show',$post->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $post->tags()->detach();
        $post->delete();
        Session::flash('success','Post deleted updated');
        return redirect()->route('po sts.index');
    }
}
