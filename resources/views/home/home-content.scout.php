@extends('layouts.main')


@section('facebook-meta')
<meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
<meta property="og:url"                content="http://www.slhb.fr" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="SLHB : Le club de hand de Chavagnes en Paillers" />
<meta property="og:description"        content="Les news, les matchs,  les résultats du SLHB, club de handball de Chavagnes en Paillers !" />
<meta property="og:image"              content="/content/themes/SLHB/resources/assets/images/fb_slhb.jpg"/>
@stop

@section ('header')
	@include('layouts.header')
@overwrite

@section('main')
<h1>Actualités</h1>
<div class="actualites clearfix">
@foreach($actus as $i => $actu)
	<article class="actualite">
		@if (has_post_thumbnail($actu->ID))
		{{  get_the_post_thumbnail($actu->ID) }}
		@else
		<img src="{{  $actu_default_image }}" alt="" />
		@endif
		<div class="actualite-content">
			<h2 >{{$actu->post_title}}</h2>
			<div class="excerpt">
				{{ $actu->post_excerpt }}
			</div>
			<a href="{{ get_permalink($actu->ID) }}" class="read-more" ><span>Lire la suite</span> <i class="material-icons">add_circle</i></a>
		</div>
	</article>
@endforeach
</div>
@stop
