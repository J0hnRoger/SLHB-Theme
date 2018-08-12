  <style>

  /** Hack - change color of the md hamburger on home **/

  .mdl-layout__drawer-button {
    color : grey;
  }

  </style>



  <header class="mdl-layout__header--scroll">

    <div class="mdl-layout__header-row">

      <div class="mdl-layout-title mdl-cell--2-col mdl-cell--1-col-phone">
        <img class="logo" src="{{ $logoUrl }}" alt="">
      </div>

      <div id="widget-last-results" class="mdl-cell--3-col mdl-cell--2-col-phone">

        <h3>Derniers résultats</h3>
          @if(isset($last_match))
          <span class="results">{{$last_match->match_team_dom}}
            <b>{{$last_match->score_dom}}</b>
              -
            <b>{{$last_match->score_ext}}</b> {{$last_match->match_team_ext}}</span>
            @else
            <span class="results">L'important, c'est de participer...</span>
            @endif
      </div>

        @if($currentUser->user_login != false)
        <div id="login" class="login mdl-cell mdl-cell--6-col mdl-cell--hide-phone mdl-grid">
          <div class="user-information">
            <h5>Bonjour {{ $currentUser->user_login }}</h5>
              <a href="/my-profile">Accéder à votre compte </a>
             @if($currentUser->isPlayer)
              @if (!empty($currentUser->nextMatch))
            <a href="/my-profile"><div id="ttPlay" class="animated bounceIn icon material-icons">announcement</div></a>
            <div id="play" class="mdl-tooltip mdl-tooltip--large" for="ttPlay">
              Tu joues le {{$currentUser->nextMatch->match_date}} contre {{ $currentUser->nextMatch->match_team_ext }}!
            </div>
              @endif
            <div  ng-app="presential" class="presential">
              <is-present init="{{ $currentUser->is_present }}" parent-container="#login"></is-present>
            </div>
            @endif

          </div>

          <div class="photo mdl-cell mdl-cell--1-col-phone">

            <div class="avatar" style="background:url( {{ $currentUser->profilePicture }}) center / cover" ></div>
          </div>

        </div>

        @else

        <div id="login" class="login mdl-cell mdl-cell--4-col mdl-cell--1-col-phone mdl-grid">
          <a id="login-link" class="mdl-cell--3-col-phone " href="{{$login_url}}/cms/wp-login.php?redirect_to={{ $login_url }}">

             <i class="fa fa-sign-in"></i><span class="mdl-cell--hide-phone">Connectez-vous avec votre compte SLHB</span>

         </a>

         <div id="login-popin" class="mdl-tooltip mdl-tooltip--large mdl-layout--small-screen-only" for="login-link">

           Connectez-vous avec votre compte SLHB

         </div>

        </div>

      @endif

      </div>

     <div id="menu" class="mdl-layout__header-row mdl-layout--large-screen-only">

      <nav class="mdl-navigation mdl-layout--large-screen-only">

      @foreach((array)$headerMenu as $key => $menuItem)

        <a class="mdl-navigation__link" href="{{$menuItem->url}}">{{$menuItem->title}}</a>

      @endforeach

      </nav>

    </div>

    @if($currentUser->user_login != false )

  <div class="placeholder mdl-cell--hide-tablet	mdl-cell--hide-desktop">

      <div id="phone-login" class="animated slideInLeft phone-login mdl-grid">

          <div class="user-information">

            <h5>Bonjour {{ $currentUser->user_login }}</h5>

            <a href="/my-profile">Accéder à votre compte </a>

            @if($currentUser->isPlayer)

              @if (!empty($currentUser->nextMatch))

            <a href="/my-profile">

              <div id="ttPlay" class="animated bounceIn icons material-icons match-flag ">

                <i class="fa fa-exclamation-circle" aria-hidden="true"></i>

              </div>

            </a>

            <div id="play" class="mdl-tooltip mdl-tooltip--large" for="ttPlay">

              Tu joues le {{$currentUser->nextMatch->match_date}} contre {{ $currentUser->nextMatch->match_team_ext }}!

            </div>

              @endif

            <div class="presential">

              <is-present init="{{ $currentUser->is_present }}" parent-container="#phone-login"></is-present>

            </div>

            @endif

          </div>

          <div class="trap-avatar" style="background:url( {{ $currentUser->profilePicture }}) center / cover">

          </div>

      </div>

    </div>

    @endif

      <div id="banner" class="mdl-cell mdl-cell--12-col" style="background : url(<?php echo $home_banner ?>) top / cover;">

        <div class="overlay">

          <div class="container">

            <ul class="events">

              @if(isset($next_match[0]))

              <li class="event">

                <div class="label">Prochain match</div>

                <span></span>

                <h2>{{$next_match[0]->match_team_dom}} - {{$next_match[0]->match_team_ext}}</h2>

                <span class="date">

                  {{ $next_match[0]->match_date }}

                </span>

              </li>

              @endif

              @if(isset($next_match[1]))

              <li class="event">

                <div class="label">Prochain match</div>

                <h2>{{$next_match[1]->match_team_dom}} - {{$next_match[1]->match_team_ext}}</h2>

                <span class="date">

                  {{ $next_match[1]->match_date }}

                </span>

              </li>

              @endif

            </ul>

          </div>

        </div>

      </div>

  </header>

  <div class="mdl-layout__drawer mdl-layout--small-screen-only">

    <span class="mdl-layout-title phone-menu">

      <img class="phone-menu__logo-phone" src="{{ $logoUrl }}" alt="">

      {{ get_bloginfo('name') }}

    </span>

    <nav class="mdl-navigation">

      @foreach((array)$headerMenu as $key => $menuItem)

        <a class="mdl-navigation__link" href="{{$menuItem->url}}">{{$menuItem->title}}</a>

      @endforeach

      <a class="mdl-navigation__link mdl-navigation__disconnect" href="<?php echo wp_logout_url(); ?>">Se déconnecter</a>

    </nav>

  </div>

