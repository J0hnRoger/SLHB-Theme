'use strict';

angular.module('appHand')
  .requires.push('team-builder'); 

angular
  .module('team-builder', [])
  .config(function($interpolateProvider){
    //Scoot Template has reserved the double curly brace, so we change the Angular markup
    $interpolateProvider.startSymbol('{[').endSymbol(']}');
});

 (function() {
     'use strict';
 
     angular
         .module('team-builder')
         .component('matchDetails', {
               templateUrl : '/content/themes/SLHB/resources/assets/team-builder/match-details.html',
               bindings: {
                   match : '<' ,
                   showTooltip : '&'
               }   
          });
 
 })(); 
(function() {
	'use strict';

	angular
		.module('team-builder')
		.component('playerTeamSheet', {
			template : '<div class="convoc"> <match-details ng-hide="$ctrl.noMatch" match="$ctrl.match"></match-details><team-sheet team-sheet="$ctrl.match.teamSheet" edit="false"></team-sheet></div>',
			bindings : {
				team : '<'
			},
			controller : function (MatchesFactory) {
        var $ctrl = this;
        MatchesFactory.getNextMatch("Equipe 1")
          .then(function(wpMatch){
            $ctrl.match = wpMatch;
            $ctrl.noMatch = false;
          },
          function(){
            $ctrl.noMatch = true;
          });
			}
		});
})();

(function() {
	'use strict';

	angular
		.module('team-builder')
		.component('playersPicker', {
			templateUrl : '/content/themes/SLHB/resources/assets/team-builder/players-picker.html',
			bindings : {
				pool : '<',
				onPlayerClicked : '&'
			},
			controller : 'PlayersPickerController' 
		});
})();

(function() {
'use strict';

    angular
        .module('team-builder')
        .controller('PlayersPickerController', PlayersPickerController);

    function PlayersPickerController() {
        var ctrl = this;

        ctrl.onClick = function(player){
            ctrl.onPlayerClicked({$event : { player : player }});
        }
    }
})();
(function() {
	'use strict';

	angular
		.module('team-builder')
		.component('teamBuilder', {
			templateUrl : '/content/themes/SLHB/resources/assets/team-builder/team-builder.html',
			controllerAs : 'root',
			controller : 'TeamBuilderController'
		});
})();

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

(function() {
	'use strict';

	angular
		.module('team-builder')
		.component('teamSheet', {
			templateUrl : '/content/themes/SLHB/resources/assets/team-builder/team-sheet.html',
			bindings : {
				teamSheet : '<',
				onPlayerClicked : '&',
				edit : '@'
			},
			controller : function (slhbThemosis) {
					this.showControls = this.edit == 'true';
					this.currentUserId = slhbThemosis.userId;
			}
		});
})();


(function() {
	'use strict';

	angular
		.module('team-builder')
		.component('teamsList', {
			templateUrl : '/content/themes/SLHB/resources/assets/team-builder/teams-list.html',
			controller : 'TeamsListController',
			bindings : {
				teams : '<',
				onTeamSelected : '&'
			}
		});
})();

(function() {
'use strict';

    angular
        .module('team-builder')
        .controller('TeamsListController', TeamsListController);

    function TeamsListController() {
        var ctrl = this;
        
        ctrl.$onChanges = function(changesObj) {
          if (changesObj.teams.currentValue)
            selectTeam(ctrl.teams[0]); 
        }
        
        ctrl.onClick = function(team){
            selectTeam(team);
        }
        
        function selectTeam(selectedTeam){
            for (var index = 0; index < ctrl.teams.length; index++) {
                var element = ctrl.teams[index];
                element.selected = false;
            }
            
            ctrl.onTeamSelected({$event : { team : selectedTeam }});

            selectedTeam.selected = true;
        }  
    }
})();
'use strict';

angular
  .module('team-builder')
  .factory('Match', Match);

function Match() {
  
  var Match = function (data) {
    for(var prop in data)
     this[prop] = data[prop];
    this.teamSheet = this.players;
    this.friendlyMatchDate = moment(this.match_date);
    
    this.place = data.lieu == "activate" ? 'Domicile' : 'Exterieur';
  };

  Match.prototype.addPlayer = function (player){
    this.teamSheet.push(player);
  }

  Match.prototype.removePlayer = function(removedPlayer){
      for(var i = 0; i < this.teamSheet.length; i++) {
          var player = this.teamSheet[i];

          if(player.ID == removedPlayer.ID){
              this.teamSheet.splice(i, 1);
          }
      }
  }

  return Match;
}


'use strict';

angular
  .module('team-builder')
  .factory('MatchesFactory', MatchesFactory);

MatchesFactory.$inject = ['Match', '$http', '$q'];
function MatchesFactory(Match, $http, $q) {
  var wp_url = "/wp-json/wp/v2/slhb_match/";
  var customApiUrl = "/wp-json/slhb/v1/get-next-match-for-team?team_name=";

  var service = {
    getMatch : GetMatch,
    getMatchsByDate : GetMatchsByDate,
    savePlayers : SavePlayers,
    getNextMatch : GetNextMatch
  };

  return service; 

  function GetNextMatch (teamId){
    var defer = $q.defer();
    $http.get(customApiUrl + teamId).then(function (data){
      if (data.data)
        defer.resolve(new Match(data.data));
      else 
        defer.reject("Pas de match de planifié");
    }); 
    return defer.promise;
  }

  function GetMatchsByDate(date){

  }

  function SavePlayers(match) {
    var defer = $q.defer();
    $http.post('/wp-json/slhb/v1/save_match' ,
      JSON.stringify({
      	'match_id' : match.ID,
        'slhb_players' : match.teamSheet,
        'slhb_coachs' : themosis.userId
      })
    ).then(function (data){
      console.log(data);
    });
    return defer.promise;
  }

  function GetMatch(matchId) {
    var defer = $q.defer();
    $http.get(wp_url + matchId).then(function (data){
      defer.resolve(data.data);
    });
    return defer.promise;
  }
}

(function() {
'use strict';

    angular
        .module('team-builder')
        .factory('Player', Player);

    // Player.$inject = [''];
    function Player() {
        var Player = function () {
        };
        
        return new Player;

        ////////////////
    }
})();
'use strict';

angular
  .module('team-builder')
  .factory('PlayersFactory', PlayersFactory);

PlayersFactory.$inject = ['$http', '$q'];
function PlayersFactory($http, $q) {
  var customApiUrl = "/wp-json/slhb/v1/get-players-by-team";
  var match = null;
  var freePlayers = [];

  var service = {
    getPlayersInTeam : GetPlayersInTeam,
    loadFreePlayers : LoadFreePlayers,
    setMatch : SetMatch,
    addPlayer : AddPlayer,
    removePlayer :RemovePlayer
  };

  return service;

  function GetPlayersInTeam(teamName){
    var defer = $q.defer();
    $http.get(customApiUrl + "?team_name=" + teamName)
      .then(function (data){
        defer.resolve(data.data);
      });
    return defer.promise;
  }

  function AddPlayer(player) {
    this.match.players.push(player);
    removeObject(player, this.freePlayers);
  }

  function RemovePlayer(rmPlayer) {
    this.freePlayers.push(rmPlayer);
    removeObject(rmPlayer, this.match.players);
  }

  function SetMatch(match) {
    this.match = match.slhb_match_meta;
    this.match.id = match.id;
    this.match.players = match.slhb_players.length > 0 ? match.slhb_players : [];
  }

  function LoadFreePlayers() {
    var defer = $q.defer();
    var that = this;
    $http.get(wp_url + "?team_name=" + this.match.match_team_dom[0]).then(function (data){
      that.freePlayers = [];
      for (var key in data.data) {
        if (!containsId(that.match.players, data.data[key].ID))
          that.freePlayers.push(data.data[key]);
      }
      defer.resolve(that.freePlayers);
    });
    return defer.promise;
  }

  // Internal Function
  function removeObject(obj, array) {
    for(var i = 0; i < array.length; i++) {
      var player = array[i];

      if(player.ID == obj.ID){
          array.splice(i, 1);
      }
    }
  }

  function containsId(objects, id) {
      for (var i = 0; i < objects.length; i++) {
          if (objects[i].ID == id) {
              return true;
          }
      }
      return false;
  }
}

(function() {
'use strict';

    angular
        .module('team-builder')
        .factory('Pool', Pool);

    // Pool.$inject = ['dependency1'];
    function Pool() {
        var pool = [];
        var service = {
            removePlayers : RemovePlayers,
            addPlayers :  AddPlayers,            
            addPlayer :  AddPlayer,
            removePlayer : RemovePlayer,
            pool : pool
        };
        
        return service;

        ////////////////
        function RemovePlayers() { }

        function RemovePlayer(removedPlayer) {  
            for(var i = 0; i < pool.length; i++) {
                var player = pool[i];

                if(player.ID == removedPlayer.ID){
                    pool.splice(i, 1);
                }
            }
        }
        
        function GetPool(){
            return pool;
        }

        function AddPlayers (players) {
            angular.merge(pool, players);
        }

        function AddPlayer (player) {
            pool.push(player);
        }
    }
})();
(function() {
'use strict';

    angular
        .module('team-builder')
        .factory('Team', Team);

    Team.$inject = ['$q', 'PlayersFactory'];
    function Team($q, PlayersFactory) {

        var Team = function (data) {
            for(var prop in data)
                this[prop] = data[prop];
        };

        Team.prototype.getPlayers = function () {
            var defer = $q.defer();
            PlayersFactory.getPlayersInTeam(this.post_title)
                .then(function(wpPlayers){
                    
                    var players = $.map(wpPlayers, function(wpPlayer){
                        return wpPlayer.data;
                    });
                    defer.resolve(players);
                });
            return defer.promise;
        }

        Team.prototype.getMatchs = function (date){
            
        }
        return Team;

        ////////////////
    }
})();
(function() {
'use strict';

    angular
        .module('team-builder')
        .factory('TeamsFactory', TeamsFactory);

    TeamsFactory.$inject = ['$q', '$http', 'Team'];    
    function TeamsFactory($q, $http, Team) {
        var customApiUrl = "/wp-json/slhb/v1/get-teams-by-coach?coach_id=";
        var wp_api = "/wp-json/wp/v2/slhb_team/";

        var service = {
           getTeamsByCoachId : GetTeamsByCoachId
        };

        return service;

        ////////////////

        function GetTeamById(teamId) {
          var defer = $q.defer();
          $http.get(webApiUrl + teamId)
            .then(function (data){
              defer.resolve(data.data);
            });
          return defer.promise;
        }
        /**
         * Get full teams for the coach Id
         */
        function GetTeamsByCoachId(coachId) {
          var defer = $q.defer();
          $http.get(customApiUrl + coachId)
            .then(function (data){
              var teams = data.data.map(function(wpTeam){
                 return new Team(wpTeam); 
              });
              defer.resolve(teams);
            });
          return defer.promise;
        }
    }
})();
