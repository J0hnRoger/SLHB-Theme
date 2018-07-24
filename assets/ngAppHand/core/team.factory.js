(function() {
'use strict';

    angular
        .module('appHand.core')
        .factory('TeamsFactory', TeamsFactory);

    // TeamsFactory.$inject = ['dependency1'];
    function TeamsFactory() {
        var service = {
            exposedFn:exposedFn
        };
        
        return service;

        ////////////////
        function exposedFn() { }
    }
})(); 