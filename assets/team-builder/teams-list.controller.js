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