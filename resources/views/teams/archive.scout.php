<?php
/*
  Use $team variable for retrieve informations on the current team
*/
?>
@extends('layouts.main')
@section('main')

<h1>Nos équipes</h1>
<ul class="all-teams">
@foreach($teams as $i => $team)
  <li><a href="{{ get_permalink($team->ID) }}"> {{$team->post_title}}</a></li>
@endforeach
</ul>
@stop
