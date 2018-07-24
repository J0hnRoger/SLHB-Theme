'use strict';

angular.module('appHand')
  .requires.push('calendar');

angular
  .module('calendar', ['ngRoute', 'ngSanitize',  'ngAnimate'])
  .config(function($interpolateProvider, $routeProvider){
    //Scoot Template has reserved the double curly brace, so we change the Angular markup
    $interpolateProvider.startSymbol('{[').endSymbol(']}');

    $routeProvider.
       when('/:id', {
         templateUrl: themosis.baseurl + '/resources/assets/calendar/event-details/event-details.html',
         controller: 'EventCtrl',
         controllerAs : 'vm'
       }).
       otherwise({
         templateUrl: themosis.baseurl + '/resources/assets/calendar/events-list/events-list.html',
         controller: 'EventListCtrl',
         controllerAs : 'vm'
       });


});
