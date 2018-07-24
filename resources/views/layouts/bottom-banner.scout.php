<?php $facebookUrl = Option::get('section-slhb-options', 'facebook_url');
      $gmapUrl = Option::get('section-slhb-options', 'gmap_url');
?>
<ul class="social">
  <li>
    <a href="{{$facebookUrl}}" target="_blank">
      <img src="{{$logoFb}}" alt="" />
        <div class="">Suivez nous sur Facebook</div>
    </a>
  </li>
  <li>
    <a href="{{$gmapUrl}}" target="_blank">
      <img src="{{$logoGMap}}" alt="" />
      <div>Trouvez-nous facilement. <span class="mdl-layout--large-screen-only">Plan détaillé et informations utiles</span></div>
    </a>
  </li>
</ul>
<div id="banner-image" class="mdl-layout--large-screen-only">
  <!-- <img src="{{$footerImage}}" alt="" /> -->
</div>
