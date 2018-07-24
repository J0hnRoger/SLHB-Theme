'use strict';

angular.module('appHand')
  .requires.push('week-planner'); 

angular
  .module('week-planner', [])
  .config(function($interpolateProvider){
    //Scoot Template has reserved the double curly brace, so we change the Angular markup
    $interpolateProvider.startSymbol('{[').endSymbol(']}');
});

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