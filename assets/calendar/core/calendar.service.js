'use strict';

angular
  .module('calendar') 
  .factory('CalendarService', CalendarService);

CalendarService.$inject = ['Day', '$http', '$q'];
function CalendarService(Day, $http, $q) {
  var selectedEvents = [];

  var self = {
    weeks : [],
    events : [],
    addEvents : addEvents,
    set : set,
    bindEvents : bindEvents,
    goToNextMonth : goToNextMonth,
    goToPreviousMonth : goToPreviousMonth,

    getSelectedEvents : getSelectedEvents,
    setSelectedEvents : setSelectedEvents
  };
  self.now = moment().date();

  function set(dateInterval) {
    if (dateInterval.year == undefined || dateInterval.month == undefined)
       throw new Error("An object formated like : { year : 2016, month : 04} is expected in parameter.");

    self.month = dateInterval.month;
    self.year = dateInterval.year;
    var objDate = new Date();
    objDate.setMonth(dateInterval.month);
    var locale = "fr-FR";
    self.monthName = objDate.toLocaleString(locale, { month: "long" });

    self.date = moment([dateInterval.year, dateInterval.month]);

    //Get the first monday of the month
    self.firstMondayOfTheMonth = moment(self.date.day(1));

    //generate new instance of moment's date for each Day instance.
    for (var weekIdx = 0; weekIdx < 5; weekIdx++) {
      self.weeks[weekIdx] = [];
      for(var i = 0; i < 7; i++){
        self.weeks[weekIdx][i] = new Day(moment(self.firstMondayOfTheMonth));
        self.weeks[weekIdx][i].notThisMonth = self.weeks[weekIdx][i].date.month() != dateInterval.month;
        self.firstMondayOfTheMonth.add(1, 'days');
      }
    }
    bindEvents();
  }

  function addEvents (events) {
    self.events = self.events.concat(events);
  }

  function bindEvents(){
    selectedEvents = self.events.filter(function (event) {
      return event.date.month() == self.month
        && event.date.year() == self.year;
    });

    for(var i = 0; i < selectedEvents.length; i++){
      for (var weekIdx in self.weeks){
        var eventDay = self.weeks[weekIdx].find(function (day) {
          return day.date.isSame(selectedEvents[i].date, 'days');
        });
        if (eventDay != undefined)
          eventDay.events.push(selectedEvents[i]);
      }

    }
  }

  function goToNextMonth() {
    self.month++;
    set({ month : self.month, year : self.year });
  }

  function goToPreviousMonth(){
    self.month--;
    set({ month : self.month, year : self.year });
  }

  function setSelectedEvents(events) {
    selectedEvents = events;
  }

  function getSelectedEvents() {
    return selectedEvents;
  }

  return self;
}
