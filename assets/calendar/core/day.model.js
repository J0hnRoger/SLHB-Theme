/*
 * Represente un jour de l'année, constitié d'une date et d'évènements
*/
'use strict';

angular
  .module('calendar')
  .factory('Day', Day); 

function Day() {

  var Day = function (myDate) {
    this.number = myDate.get('date');
    this.date = myDate.get();
    this.isToday = this.date.isSame(Date.now(), 'day');
    this.isPast =  this.date.isBefore(Date.now(), 'day');
    this.events = [];
    this.toString = function () {
      var eventsList = "<ul>";
      for (var i=0; i < this.events.length; i++) {
        eventsList += "<li>" + this.events[i] +"</li>";
      }
      eventsList += "</ul> \n";

      return "day : " + this.date.toString() + ' number : ' + this.number + '\n' +
            "events : " + eventsList;
    }
  }

  return Day;
}
