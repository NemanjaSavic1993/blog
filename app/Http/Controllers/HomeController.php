<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->roles->name == 'Administrator'){
            $users = User::query();

            if(isset(request()->search)){
                $users = User::where('name', 'like', '%'.request()->search.'%');
            }
                
            $users = $users->where('id', '<>', Auth::user()->id)->paginate(5);
            
            
            return view('admin.home', compact('users'));
        }elseif(Auth::user()->roles->name == 'Moderator'){
            $categories = Category::query();

            if(isset(request()->search)){
                $categories = Category::where('name', 'like', '%'.request()->search.'%');
            }
                
            $categories = $categories->where('id', '<>', Auth::user()->id)->paginate(5);
            
            
            return view('moderator.home', compact('categories'));
        }else{
            $posts = Post::query();

            if(isset(request()->search)){
                $posts = Post::where('title', 'like', '%'.request()->search.'%');
            }
                
            $posts = $posts->where('id', '<>', Auth::user()->id)->paginate(5);
            
            
            return view('user.home', compact('posts'));
        }
        
    }

    public function editUser($id){
        $user = User::find($id);
        $roles = Role::all();

        return view('admin.users', compact('user', 'roles'));
    }

    public function updateUser(Request $request){
        $banned = 0;
        $request->validate([
            'role' => ['required', 'in:1,2,3']
        ]);

        if(isset($request->banned) && $request->banned == 'on'){
            $banned = 1;
        }

        $user = User::find($request->user_id);

        $user->role_id = $request->role;
        $user->banned = $banned;

        $user->update();

        return redirect()->route('admin.home')->with('message', 'User has been updated');
    }

}
