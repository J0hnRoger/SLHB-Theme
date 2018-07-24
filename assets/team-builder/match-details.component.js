 (function() {
     'use strict';
 
     angular
         .module('team-builder')
         .component('matchDetails', {
               templateUrl : '/content/themes/SLHB/resources/assets/team-builder/match-details.html',
               bindings: {
                   match : '<' ,
                   showTooltip : '&'
               }   
          });
 
 })(); 