<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function saveImages($images, $post){
        foreach($images as $img){
            $path = $img->store('images', 'public');

            Image::create([
                'path' => $path,
                'post_id' => $post
            ]);
        }
    }

    public function deleteImages($post){
        Image::where('post_id', $post)->delete();
    }

    public function getImage($post){
        return Image::where('post_id', $post)->get();
    }
}
