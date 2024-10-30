<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends ImageController
{
    public function index(){
        $categories = Category::where('valid', '1')->get();

        $posts = Post::query();

        if(isset(request()->search)){
            $posts = Post::where('title', 'like', '%'.request()->search.'%');
        }

        if(isset(request()->category)){
            $posts = $posts->whereHas('category', function($query){
                $query->whereName(request()->category);
            });
        }

        $posts = $posts->where('published','1')->paginate(5);

        return view('welcome', compact('categories', 'posts'));
    }

    public function addPost(){
        $categories = Category::where('valid','=','1')->get();

        return view('user.addPost', compact('categories'));
    }

    public function storePost(){
        request()->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'imgages' => 'mimes:jpeg,jpg,png',
            'category' => 'required'
        ]);

        $published = 0;

        if(isset(request()->published) && request()->published == 'on'){
            $published = 1;
        }

        $post = Post::create([
            'title' => request()->title,
            'body' => request()->body,
            'user_id' => Auth::user()->id, // auth()->id
            'category_id' => request()->category,
            'published' => $published
        ]);

        if(request()->hasFile('images')){
            $this->saveImages(request()->images, $post->id);
        }

        return redirect()->route('admin.home')->with('message', 'Post has been created');
    }

    public function editPost($id){
        $post = Post::find($id);
        $categories = Category::where('valid','=','1')->get();

        return view('user.editPost', compact('post', 'categories'));
    }

    public function updatePost(){
        request()->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'imgages' => 'mimes:jpeg,jpg,png',
            'category' => 'required'
        ]);

        $published = 0;

        if(isset(request()->published) && request()->published == 'on'){
            $published = 1;
        }

        $post = Post::where('id', request()->post_id)->update([
            'title' => request()->title,
            'body' => request()->body,
            'category_id' => request()->category,
            'published' => $published
        ]);

        if(request()->hasFile('images')){
            $this->deleteImages(request()->post_id);
            $this->saveImages(request()->images, request()->post_id);
        }

        return redirect()->route('admin.home')->with('message', 'Post has been updated');
    }

    public function showPost($id){
        $post = Post::find($id);
        $images = $this->getImage($id);

        return view('post', compact('post','images'));
    }

    public function banPost($id){
        $post = Post::find($id);

        $post->published = false;

        $post->update();

        return redirect()->route('welcome')->with('message', 'Post has been banned');
    }
}
