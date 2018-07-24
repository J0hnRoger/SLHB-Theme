angular.module('appHand.core')
  .factory('uniqIdFactory', UniqIdFactory);

function UniqIdFactory() {
var service = {
  getUniqId: getUniqId
};

return service;

function getUniqId() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
      .toString(16)
      .substring(1);
  }
  return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
}
}
