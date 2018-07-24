'use strict';

angular.module('appHand')
  .requires.push('team-builder'); 

angular
  .module('team-builder', [])
  .config(function($interpolateProvider){
    //Scoot Template has reserved the double curly brace, so we change the Angular markup
    $interpolateProvider.startSymbol('{[').endSymbol(']}');
});
