'use strict';

angular.module('appHand')
  .requires.push('week-planner'); 

angular
  .module('week-planner', [])
  .config(function($interpolateProvider){
    //Scoot Template has reserved the double curly brace, so we change the Angular markup
    $interpolateProvider.startSymbol('{[').endSymbol(']}');
});
