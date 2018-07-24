(function() {
	'use strict';

	angular
		.module('team-builder')
		.component('teamSheet', {
			templateUrl : '/content/themes/SLHB/resources/assets/team-builder/team-sheet.html',
			bindings : {
				teamSheet : '<',
				onPlayerClicked : '&',
				edit : '@'
			},
			controller : function (slhbThemosis) {
					this.showControls = this.edit == 'true';
					this.currentUserId = slhbThemosis.userId;
			}
		});
})();
