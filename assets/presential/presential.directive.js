
'use strict';

angular
  .module('presential')
  .directive('isPresent', isPresent);

function isPresent() {
  var directive = {
    restrict: 'EA',
    templateUrl: '/content/themes/SLHB/resources/assets/presential/presential.html',
    scope: {
      init : '=',
      parentContainer : '@'
    },
    controller: IsPresentCtrl,
    controllerAs: 'vm',
    bindToController: true
  };

  return directive;
}

IsPresentCtrl.$inject = ['$element', 'PlayersService', '$mdToast', 'uniqIdFactory', '$timeout'];
function IsPresentCtrl($element, PlayersService, $mdToast, uniqIdFactory, $timeout) {
  var vm = this;
  vm.toastContainer = vm.parentContainer || "#phone-login";

  vm.isPresent = (parseInt(vm.init) == 0) ? false : true;
  
  PlayersService.getPresentials(themosis.userId)
    .then(function(data){
      vm.partners = data; 
    });
  
  if (vm.isPresent)
    $element.find('#presential-switch').click();

  vm.uniqId = uniqIdFactory.getUniqId();

  vm.label = ((vm.isPresent) ? "Présent" : "Absent" );
  

  vm.changeLabel = function () {
    PlayersService.setPresential(themosis.userId, vm.isPresent)
      .then(function (){
        vm.label = ((vm.isPresent) ? "Présent" : "Absent" );
        $mdToast.show(
         $mdToast.simple()
           .textContent(vm.label + ' à l\'entrainement.')
           .parent(vm.toastContainer)
           .hideDelay(1500)
         );
         if (vm.isPresent)
          vm.partners++;
        else
          vm.partners--;          
      })
  }
}
