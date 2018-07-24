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
