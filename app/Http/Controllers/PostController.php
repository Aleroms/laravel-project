<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\SendNewPostEmail;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function search($term){
        $posts = Post::search($term)->get();
        $posts->load('user:id,username,avatar');
        return $posts;
    }
    public function actuallyUpdate(Post $post, Request $request){
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);
        return back()->with('success', 'Post successfully updated.');
    }
    public function showEditForm(Post $post){
        return view('edit-post',['post' => $post]);
    }
    public function delete(Post $post){
        //routes file handles middleware to check if can delete post
        $post->delete();
        return redirect('/profile/' . auth()->user()->username)->with('success', 'Post sucessfully deleted');
    }
    public function deleteAPI(Post $post){
        //routes file handles middleware to check if can delete post
        $post->delete();
        return 'blue label de johnny walker';
    }
    public function viewSinglePost(Post $post){
        $ourHTML = strip_tags(Str::markdown($post->body),'<p><ul><ol><strong><em><h3><br>');
        $post['body'] = $ourHTML;
        return view('single-post',['post'=>$post]);
    }
    public function showCreateForm(){
        return view('create-post');
    }

    public function storeNewPost(Request $request){
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        $newPost = Post::create($incomingFields);

        //sending email
        dispatch(new SendNewPostEmail([
            'sendTo' => auth()->user()->email,
            'name' => auth()->user()->username,
            'title' => $newPost->title
        ]));
        
        return redirect("/post/{$newPost->id}")->with('success',  'New post sucessfully created');
    }
    public function storeNewPostAPI(Request $request){
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        $newPost = Post::create($incomingFields);

        //sending email
        dispatch(new SendNewPostEmail([
            'sendTo' => auth()->user()->email,
            'name' => auth()->user()->username,
            'title' => $newPost->title
        ]));
        
        return $newPost->id;
    }
}
