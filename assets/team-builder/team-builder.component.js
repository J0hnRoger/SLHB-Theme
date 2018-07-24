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
