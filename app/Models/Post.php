<?php

namespace App\Models;

use Illuminate\Support\Facades\File;

class Post
{
public static function all(){
    $files = File::files(resource_path("posts/"));

    return array_map(fn($file) => $file->getContents(), $files);
}



 public static function find($slug){

    // if doesn't exist, redirect to main page
    if (!file_exists($path = resource_path("posts/{$slug}.html"))){
        throw new ModelNotFoundException();
    }

    // remember the page for 5 seconds to avoid spam
    return cache()->remember("posts.{$slug}", 5, function() use ($path){
        //get content of the post
         return file_get_contents($path);
    });
    //get content of the post

 }
}

