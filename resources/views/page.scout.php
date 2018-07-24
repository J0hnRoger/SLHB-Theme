<?php
/*
  Use $page variable for retrieve informations of the current page
*/
?>

@extends('layouts.main')

@section('main')
    <h1>{{ $page->post_title }}</h1>
    <article>{{  apply_filters('the_content', $page->post_content) }}</article>
    <ul class="comments">
    @foreach($page->comments as $comment)
      <li>{{ $comment->comment_author }} :  {{ $comment->comment_content }}.</p>
    @endforeach
    </ul>
@stop
