/**
 * Top Level Controller - Load Ajax Informations
 */
'use strict';

angular
  .module('calendar')
  .controller('AgendaCtrl', AgendaCtrl);

AgendaCtrl.$inject = ['$scope', '$window', '$timeout', '$location', 'EventsFactory', 'CalendarService'];
function AgendaCtrl($scope, $window, $location, $timeout, EventsFactory, calendarService) {
  var vm = this;
  vm.direction = "";
  vm.events = [];

  activate();

  function activate() {
   EventsFactory.getEvents()
      .then(function(events){
        calendarService.addEvents(events);
        calendarService.bindEvents();
   });

   $scope.$on('$routeChangeSuccess', function(event, next, current) {
     if ($window.location.hash == '#/') {
       vm.direction = "right";
       vm.btnAnimation = "hide";
       vm.phoneCalendarClass = ""
     }
     else {
       vm.direction = "left";
       vm.phoneCalendarClass = "phone-calendar"
       vm.btnAnimation = "material--arrow";
     }
   });

   vm.go = function (path) {
     $window.location.href = path;
   }
  }
}
