@extends('layouts.main')
@section('main')

<h1>Team Builder</h1>
<div class="mdl-demo team-builder" ng-controller="TeamBuilderCtrl as vm" ng-cloak>
  <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp" >
    <div class="mdl-card mdl-cell mdl-cell--6-col">
      <div class="mdl-card__supporting-text mdl-grid mdl-grid--no-spacing">
        <h4 class="mdl-cell mdl-cell--12-col">Joueurs Dispos en <b>{[vm.playersFactory.match.match_team_dom[0]]}</b>:</h4>
        <!--  Starting Template -->
        <!-- NgMaterial -->
        <md-list-item ng-repeat="player in vm.playersFactory.freePlayers track by $index"  class="animated bounceIn">
          <md-list>
           <img alt="{[player.data.user_login]}" ng-src="{[player.data.profilePicture]}" class="md-avatar" />
           <div>{[player.data.user_login]}
             <span class="label-pills" ng-repeat="position in player.data.positions"> {[position]}</span>
           </div>
           <md-checkbox class="md-secondary" ng-click="vm.playersFactory.addPlayer(player)"></md-checkbox>
        </md-list-item> 
      </md-list>
      </div>
    </div>

    <div class="mdl-card mdl-cell mdl-cell--6-col mdl-badge" data-badge="{[vm.playersFactory.match.players.length]}">
      <div class="mdl-card__supporting-text mdl-grid mdl-grid--no-spacing" >
        <h4 class="mdl-cell mdl-cell--12-col">Feuille de match du </br> <b>{[vm.playersFactory.match.match_date]}</b></h4>
        <h6 class="mdl-cell--12-col">Adversaire : {[vm.playersFactory.match.match_team_ext[0]]}</h6>
        <h6 class="mdl-cell--12-col">Rendez-vous : {[vm.playersFactory.match.match_team_time[0]]} </h6>
        <div class="mdl-cell mdl-cell--12-col mdl-grid mdl-grid--no-spacing section__text animated bounceIn" ng-repeat="player in vm.playersFactory.match.players track by $index">
          <div class="section__circle-container mdl-cell mdl-cell--4-col mdl-cell--1-col-phone">
            <div class="section__circle-container__circle mdl-color--primary" >
              <img src="{[player.data.profilePicture]}" />
            </div>
          </div>
          <div class="section__text mdl-cell mdl-cell--8-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
            <h5>{[player.data.user_login]}</h5>
            <span class="label-pills" ng-repeat="position in player.data.positions">{[position]}</span>
            <button class="mdl-button mdl-js-button" ng-click="vm.playersFactory.removePlayer(player)">
              <i class="material-icons">clear</i>
            </button>
          </div>
        </div>
      </div>
      <div class="mdl-card__actions">
        <a href="#" class="mdl-button" ng-click="vm.save()">Enregistrer la feuille de match</a>
      </div>
    </div>
  </section>
</div>
@stop
