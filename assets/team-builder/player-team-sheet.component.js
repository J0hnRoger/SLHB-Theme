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
