<header class="mini-header mdl-layout__header--scroll">
  <div id="menu" class="mdl-layout__header-row">
    <a class="mini-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="{{ $logoMinUrl }}" alt="slhb" /></a>
    <nav class="mdl-navigation mdl-layout--large-screen-only">
    @foreach((array)$headerMenu as $key => $menuItem)
      <a class="mdl-navigation__link" href="{{$menuItem->url}}">{{$menuItem->title}}</a>
    @endforeach
    </nav>
      @if($currentUser->user_login != false )
      <div id="min-login-menu" class="min-login-menu"> 
        <div class="min-login-menu__btns">
          <button id="login-menu" class="mdl-button mdl-js-button mdl-button--icon">
            <i class="material-icons">more_vert</i>
          </button>
          <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
              for="login-menu">
            <li class="mdl-menu__item"><a href="/my-profile">Accéder à votre compte</a></li>
            <li class="mdl-menu__item"><a href="<?php echo wp_logout_url(); ?>">Se déconnecter</a></li>
          </ul>
        </div>
        <div class="avatar" style="background:url( {{ $currentUser->profilePicture }}) center / cover">
        </div>
      </div>
    @endif
  </div>
    <div id="banner" class="mdl-cell mdl-cell--12-col" style="background : url(<?php echo $home_banner ?>) top / cover;">

    </div>
</header>
<div class="mdl-layout__drawer mdl-layout--small-screen-only">
  <span class="mdl-layout-title">{{ get_bloginfo('name') }}</span>
  <nav class="mdl-navigation">
    @foreach((array)$headerMenu as $key => $menuItem)
      <a class="mdl-navigation__link" href="{{$menuItem->url}}">{{$menuItem->title}}</a>
    @endforeach
  </nav>
</div>
