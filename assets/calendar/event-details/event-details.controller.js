'use strict';

angular
  .module('calendar')
  .controller('EventCtrl', EventCtrl);

EventCtrl.$inject = ['EventsFactory', '$routeParams'];
function EventCtrl(eventsFactory, $routeParams) {
  var vm = this;
  eventsFactory.getEvent($routeParams.id).then(function (ev){
      vm.event = ev; 
  })
}
