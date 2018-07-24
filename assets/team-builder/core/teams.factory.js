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
