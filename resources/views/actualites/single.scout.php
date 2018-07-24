<?php
/*
  Use $actu variable for retrieve informations on the current Post
	ID
	post_author
	post_name
	post_type
	post_title
	post_date
	post_content
	post_status
	post_modified
	comment_count
*/
?>
@extends('layouts.main')

@section('facebook-meta')
<meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
<meta property="og:url"                content="{{ get_permalink() }}" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="{{ $actu->post_title }}" />
<meta property="og:description"        content="{{ $actu->excerpt }}" />
<meta property="og:image"              content="{{ $actu->featuredImg[0] or $logoUrl }}"/>
@stop

@section('main')
	@loop

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.6&appId=472946276083108";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<div class="details-actualite">
		<header>
			<h1>{{ $actu->post_title }}</h1>
			<div class="sub-infos">{{ $actu->formated_modified_date }}</div>
		</header>
		<section>
			{{ the_content() }}
		</section>
		<div class="fb-share-button"
			data-href="{{ get_permalink() }}"
			data-layout="button_count"
			data-mobile-iframe="true">
			<a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fslhb.dev%2F2016%2F05%2F03%2Freprise-des-entraiements-seniors%2F&amp;src=sdkpreparse">Partager</a>
		</div>
	</div>
	@section('bottom-banner')
	<div class="related">
		<div class="related-center">
			@if (!empty( $previous_post ))
			<a class="read-next-story" style="background: url({{ get_the_post_thumbnail_url($previous_post->ID, [330, 330]) }}) top / cover" href="{{ get_permalink($previous_post->ID) }}">
				<section class="post">
					<h2>{{$previous_post->post_title}}</h2>
					<p>{{ $previous_post->post_excerpt }}</p>
				</section>
			</a>
			@endif
			@if (!empty( $next_post ))
			<a class="read-next-story" style="background: url({{ get_the_post_thumbnail_url($next_post->ID, [330, 330]) }}) top / cover" href="{{ get_permalink($next_post->ID) }}">
				<section class="post">
						<h2>{{$next_post->post_title}}</h2>
						<p>{{ $next_post->post_excerpt }}</p>
				</section>
			</a>
			@endif
		</div>
	</div>
	@overwrite
	@endloop
@stop
