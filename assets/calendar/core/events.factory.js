/*
 *
*/

'use strict';

angular
  .module('calendar')
  .factory('EventsFactory', EventsFactory);

EventsFactory.$inject = ['Event', '$http', '$q'];
function EventsFactory(Event, $http, $q) {
  var events = null,
    promises= [];

  var wp_url = "/wp-json/wp/v2/posts";

  var service = {
    getEvents : GetEvents,
    getEvent : GetEvent
  };

  return service;

  function GetEvents() {
    var defer = $q.defer();

    if (promises.length > 0) {
        promises.push(defer);
      }
      else if(events === null){
        promises.push(defer);
        $http.get(wp_url).then(function (data){
          events = data.data.map( (jsonObject) => new Event(jsonObject) );
          while (promises.length) {
             promises.shift().resolve(events);
           }
        });
      }
      else{
        defer.resolve(events);
      }

    return defer.promise;
  }

  function GetEvent(id){
    var defer = $q.defer(); 

    if (promises.length > 0) {
        promises.push(defer);
    }
    else if(events === null){
      promises.push(defer);
      $http.get(wp_url).then(function (data){
        events = data.data.map( (jsonObject) => new Event(jsonObject) );
        event = events.find(ev => {ev.ID == +id });
        while (promises.length) {
           promises.shift().resolve(event);
         }
       });
      }
      else{
        var event = events.find(ev => {return (ev.ID == +id) });
        defer.resolve(event);
      }

    return defer.promise;
  }

}
