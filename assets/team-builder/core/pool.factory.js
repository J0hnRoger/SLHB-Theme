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