 (function() {
     'use strict';
 
     angular
         .module('week-planner')
         .component('weekPlanner', {
               templateUrl : '/content/themes/SLHB/resources/assets/week-planner/week-planner.html',
               bindings: {
                   match : '<' ,
                   showTooltip : '&'
               }   
          });
 
 })(); 