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