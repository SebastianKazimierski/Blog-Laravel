@extends('layouts.layout')

@section('banner')
<h1>my blog</h1>
@endsection

@section('content')
@foreach ($posts as $post)
            <article>
                <a href="/posts/<?= $post->slug;?>">
               <h1>{{$post->title; }}</h1>
                </a>
               <div>{{ $post->excerpt; }}</div>
            </article>
       @endforeach
@endsection
