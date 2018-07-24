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