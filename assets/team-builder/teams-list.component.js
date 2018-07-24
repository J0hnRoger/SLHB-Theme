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
