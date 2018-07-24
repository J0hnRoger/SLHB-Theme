@extends('layouts.main')
@section('main-wrapper')
<main id="profile" class="coach-profile">
<div class="mdl-grid">
  <aside class="mdl-cell mdl-cell--2-col profile-column">
    <h2>Mon profil</h2>
    <div class="avatar" style="background:url( {{ $currentCoach->user->profilePicture }}) center / cover">
    </div>
    <div class="infos"> 
  <h4>{{$currentCoach->user->display_name}}</h4>
    @if($currentCoach->trainedTeamsNames != '')
      @foreach($currentCoach->trainedTeamsNames[0] as $key => $team)
        <span class="label-pills">{{ $team }}</span>
      @endforeach
    @endif
    </div>
    <div class="player-presents">
      Joueurs présents à l'entrainement : <span class="label-pills">{{ count($playersPresents)}} </span>
      <ul>
      @foreach($playersPresents as $key => $player)
        <li>{{ $player->display_name }}</span>
      @endforeach
      </ul>
    </div>
  </aside>

  <div class="mdl-cell mdl-cell--8-col" >
    <md-tabs md-selected="selectedIndex" md-dynamic-height>
      <img ng-src="img/angular.png" class="centered">
      <md-tab>
        <md-tab-label>
          Prochains Matchs
        </md-tab-label>
        <md-tab-body>
          <team-builder></team-builder>
        </md-tab-body>
      </md-tab>
      <md-tab>
        <md-tab-label>
          Planning repas
        </md-tab-label>
        <md-tab-body>
          <ul>
            <li>bouffe 1</li>
            <li>bouffe 2</li>
            <li>bouffe 3</li>
            <li>bouffe 4</li>
            <li>bouffe 5</li>
            <li>bouffe 6</li>
            <li>bouffe 7</li>
            <li>bouffe 8</li>
            <li>bouffe 9</li>
            <li>bouffe 10</li>
            <li>bouffe 11</li>
            <li>bouffe 12</li>
            <li>bouffe 13</li>
            <li>bouffe 14</li>
            <li>bouffe 15</li>
            <li>bouffe 16</li>
            <li>bouffe 17</li>
            <li>bouffe 18</li>
            <li>bouffe 19</li>
            <li>bouffe 20</li>
          </ul>
        </md-tab-body>
      </md-tab>
      <md-tab>
        <md-tab-label>
          Arbitrage/Table/Bar
        </md-tab-label>
        <md-tab-body>
          <iframe width='100%' height='800px' frameborder='0'
              src='https://docs.google.com/spreadsheets/d/1uVbWy_Pg03BnxqZ9HMN63vYmsrM5EMP3ZSEQXw5WFIo/pubhtml'>
          </iframe>
        </md-tab-body>
      </md-tab>
    </md-tabs>
  </div>
</div>
</main>
@overwrite
