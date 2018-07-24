'use strict';

angular
  .module('calendar')
  .controller('EventListCtrl', EventListCtrl);

EventListCtrl.$inject = ['CalendarService', '$location'];
function EventListCtrl(calendarService, $location) {
  var vm = this;
  vm.calendarService = calendarService;

  vm.details = function (eventId) {
    $location.path( '/' + eventId)
  }
}
