'use strict';

angular
  .module('team-builder') 
  .controller('TeamBuilderController', TeamBuilderController);
 
TeamBuilderController.$inject = ['TeamsFactory', 'MatchesFactory', 'Pool'];
function TeamBuilderController (TeamsFactory, MatchesFactory, Pool){
  var root = this; 
  root.pool = Pool;

  this.$onInit = function(){
    TeamsFactory.getTeamsByCoachId(themosis.userId)
      .then(function(teams){
        root.teams = teams;
        
        for (var i = 0; i < root.teams.length; i++) {
          root.teams[i].getPlayers()
              .then(function(players){
                Pool.addPlayers(players);
              });
        }
      });
  }

  root.loadNextMatch = function(team){
    root.team = team;
    MatchesFactory.getNextMatch(team.post_title)
      .then(function(wpMatch){
        root.match = wpMatch;
        root.noMatch = false;
      }, 
      function(){
        root.noMatch = true; 
      });
  }

  root.addPlayerToTeamSheet = function (player){
    Pool.removePlayer(player);
    root.match.addPlayer(player);
  }

  root.removePlayerToTeamSheet = function (player){
    Pool.addPlayer(player);
    root.match.removePlayer(player);
  }

  root.saveTeamSheet = function (player){
    MatchesFactory.savePlayers(root.match);
  }
}

TeamBuilderCtrl.$inject = ['PlayersFactory', 'MatchsFactory', '$location'];
function TeamBuilderCtrl(PlayersFactory, MatchsFactory, $location) {
  var vm = this;
  vm.playersFactory = PlayersFactory;
  vm.match;

  activate();

  function activate() {
    // TODO - Ugly ... use $location
    var matchId = location.search.split('=')[location.search.split('=').length - 1];

    MatchsFactory.getMatch(matchId).then(function (match){
      PlayersFactory.setMatch(match);
      PlayersFactory.loadFreePlayers();
    });
  }

  vm.save = function () {
    MatchsFactory.savePlayers(PlayersFactory.match)
  }
}
