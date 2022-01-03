<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{

    public function __construct(public $title,public $excerpt,public $body,public $date, public $slug){
        $this -> title = $title;
        $this -> excerpt = $excerpt;
        $this -> body = $body;
        $this -> date = $date;
        $this -> slug = $slug;
    }
    //get all posts
    public static function all(){
        return collect(File::files(resource_path("posts")))
        ->map(fn($file)=>YamlFrontMatter::parseFile($file))
        ->map(fn($document)=>new Post(
      $document->title,
      $document->excerpt,
      $document->body(),
      $document->date,
      $document->slug
      ))->sortByDesc('date');

    }
    public static function find($slug)
        {
            return static::all()->firstWhere('slug', $slug);
        }
}
