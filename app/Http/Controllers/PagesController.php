<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public function getIndex()
    {
        $post=Post::orderBy('created_at','desc')->limit(4)->get();
        return view('pages.welcome',compact('post'));
    }
    public function getAbout()
    {
        $first="sandeep";
        $last="kumar";
        $name=$first." ".$last;
        $data['name']=$name;
        $data['email']="s@gmail.com";
        return view('pages.about')->withNull($data);
    }
    public function getContact()
    {
        return view('pages.contact');
    }
    public function postContact(Request $request)
    {
        $this->validate($request,['email'=>'required|email',
            'message'=>'min:10',
            'subject'=>'min:3']);

        $data= [
            'email'=>$request->email,
            'subject'=>$request->subject,
            'bodyMessage'=>$request->message
        ];
        Mail::send('emails.contact',$data,function ($message) use($data)
        {
            $message->from($data['email']);
            $message->to('sandeepyadav2863@gmail.com');
            $message->subject($data['subject']);
        });
        Session::flash('success','Your email was sent successfully');
        return view('pages.contact');
    }
}
