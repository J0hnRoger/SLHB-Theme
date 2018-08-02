<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Les news, les matchs,  les résultats du SLHB, club de handball de Chavagnes en Paillers ! ">
	<meta name="keywords" content="slhb, chavagnes, handball, sport, club">
	<link rel="shortcut icon" href="<?php echo themosis_assets() . "/images/favicon.ico"?>"  />
	<link rel="alternate" href="http://www.slhb.fr/" hreflang="fr" />
	<?php wp_head(); ?>
	@yield('facebook-meta')
	 <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Ne pas supprimer les marqueurs suivants ! Sinon Bower sera perdu -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/content/themes/SLHB/assets/getmdl-select/getmdl-select.min.css">
    <link rel="stylesheet" href="/content/themes/SLHB/assets/material-design-lite/material.min.css">
    <link rel="stylesheet" href="/content/themes/SLHB/assets/css/animate.css">
    <link rel="stylesheet" href="/content/themes/SLHB/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/content/themes/SLHB/assets/css/sass.css">
    <link rel="stylesheet" href="/content/themes/SLHB/assets/css/styles.css">
    <!-- endinject -->
</head>
<body ng-app="appHand">
<div class="mdl-layout mdl-js-layout mdl-grid--no-spacing">
	@section('header')
		@include('layouts.header-min')
	@show

  <div style="clear:both"></div>
	@section('main-wrapper')
  <main id="content" class="">
      @yield('main')
  </main>
	@show

	@section('bottom-banner')
  <section id="bottom-banner" class="">
		@include('layouts.bottom-banner')
	</section>
	@show
  <footer class="">
  @include('layouts.footer')
	</footer>
  @include('layouts.credits')
</div>
<?php wp_footer(); ?>
		<script src="/content/themes/SLHB/assets/doc-ready/doc-ready.js"></script>
		<script src="/content/themes/SLHB/assets/eventEmitter/EventEmitter.js"></script>
		<script src="/content/themes/SLHB/assets/eventie/eventie.js"></script>
		<script src="/content/themes/SLHB/assets/fizzy-ui-utils/utils.js"></script>
		<script src="/content/themes/SLHB/assets/get-size/get-size.js"></script>
		<script src="/content/themes/SLHB/assets/get-style-property/get-style-property.js"></script>
		<script src="/content/themes/SLHB/assets/getmdl-select/getmdl-select.min.js"></script>
		<script src="/content/themes/SLHB/assets/matches-selector/matches-selector.js"></script>
		<script src="/content/themes/SLHB/assets/material-design-lite/material.min.js"></script>
		<script src="/content/themes/SLHB/assets/moment/moment.js"></script>
		<script src="/content/themes/SLHB/assets/moment/moment.local.fr.js"></script>
</body>
</html>
