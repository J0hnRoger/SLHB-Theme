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
