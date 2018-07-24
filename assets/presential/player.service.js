'use strict';

angular
  .module('presential')
  .factory('PlayersService', PlayersService);

PlayersService.$inject = ['$q', '$http'];
function PlayersService($q, $http) {
  var url = '/wp-json/slhb/v1/set-presential';
  var getUrl = '/wp-json/slhb/v1/get-presential';
  var partners = null;

  var service = {
    setPresential : SetPresential,
    getPresentials : GetPresentials
  };

  return service;

  function SetPresential(userId, isPresent) {
    var defer = $q.defer();
    $http.post(url ,
      JSON.stringify({
        'present' : isPresent,
        'userId' : userId
      })
    ).then(function (data){
      defer.resolve(data);
    });
    return defer.promise;
  }

  function GetPresentials(userId) {
      var defer = $q.defer();
      if (partners != null) {
        defer.resolve(partners);
      }
      else {
      $http.get(getUrl + '?userId=' + userId)
        .then(function (data){
          partners = data.data; 
          defer.resolve(partners);
        });
      }
      return defer.promise;
    }
}
