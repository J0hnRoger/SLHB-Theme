'use strict';
angular.module('appHand')
  .requires.push('presential');

angular
  .module('presential', ['ngMaterial', 'appHand.core']);
