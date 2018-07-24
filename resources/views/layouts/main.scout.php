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
    <link rel="stylesheet" href="/content/themes/SLHB/assets/angular-material/angular-material.css">
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
    <!-- Ne pas supprimer les marqueurs suivants ! Sinon Bower sera perdu -->
    <!-- inject:js -->
		<script src="/content/themes/SLHB/assets/jquery/dist/jquery.js"></script>
		<script src="/content/themes/SLHB/assets/angular/angular.js"></script>
		<script src="/content/themes/SLHB/assets/angular-animate/angular-animate.js"></script>
		<script src="/content/themes/SLHB/assets/angular-aria/angular-aria.js"></script>
		<script src="/content/themes/SLHB/assets/angular-material/angular-material.js"></script>
		<script src="/content/themes/SLHB/assets/angular-messages/angular-messages.js"></script>
		<script src="/content/themes/SLHB/assets/angular-route/angular-route.js"></script>
		<script src="/content/themes/SLHB/assets/angular-sanitize/angular-sanitize.js"></script>
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

		<script src="/content/themes/SLHB/assets/ngAppHand/appHand.module.js"></script>
		<script src="/content/themes/SLHB/assets/calendar/calendar.module.js"></script>
		<script src="/content/themes/SLHB/assets/presential/presential.module.js"></script>

		<script src="/content/themes/SLHB/assets/calendar/agenda.controller.js"></script>
		<script src="/content/themes/SLHB/assets/calendar/calendar.directive.js"></script>
		<script src="/content/themes/SLHB/assets/presential/player.service.js"></script>
		<script src="/content/themes/SLHB/assets/presential/presential.directive.js"></script>
		<script src="/content/themes/SLHB/assets/calendar/core/calendar.service.js"></script>
		<script src="/content/themes/SLHB/assets/calendar/core/day.model.js"></script>
		<script src="/content/themes/SLHB/assets/calendar/core/event.model.js"></script>
		<script src="/content/themes/SLHB/assets/calendar/core/events.factory.js"></script>
		<script src="/content/themes/SLHB/assets/calendar/event-details/event-details.controller.js"></script>
		<script src="/content/themes/SLHB/assets/calendar/events-list/events-list.controller.js"></script>
		<script src="/content/themes/SLHB/assets/ngAppHand/core/appHand.core.js"></script>
		<script src="/content/themes/SLHB/assets/ngAppHand/core/uniqId.factory.js"></script>
		<script src="/content/themes/SLHB/assets/ngAppHand/core/appHand.constants.js"></script>
		<script src="/content/themes/SLHB/assets/team-builder/dist/team-builder-min.js"></script>
		<script src="/content/themes/SLHB/assets/week-planner/dist/week-planner-min.js"></script>
		<!-- endinject -->
</body>
</html>
