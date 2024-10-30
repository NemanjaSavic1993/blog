<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(){
        return view('moderator.addCategory');
    }

    public function storeCategory(){
        $valid = 0;
        request()->validate([
            'name' => 'required|max:255'
        ]);

        if(isset(request()->valid) && request()->valid == 'on'){
            $valid = 1;
        }

        $category = new Category();
        $category->name = request()->name;
        $category->valid = $valid;

        $category->save();

        return redirect()->route('admin.home')->with('message', 'Category has been created.');
    }

    public function editCategory($id){
        $category = Category::find($id);

        return view('moderator.editCategory', compact('category'));
    }

    public function updateCategory(){
        $valid = 0;
        request()->validate([
            'name' => 'required|max:255'
        ]);

        if(isset(request()->valid) && request()->valid == 'on'){
            $valid = 1;
        }

        $category = Category::find(request()->category_id);
        $category->name = request()->name;
        $category->valid = $valid;

        $category->update();

        return redirect()->route('admin.home')->with('message', 'Category has been updated.');
    }
}
