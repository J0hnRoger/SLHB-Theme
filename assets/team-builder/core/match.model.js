'use strict';

angular
  .module('team-builder')
  .factory('Match', Match);

function Match() {
  
  var Match = function (data) {
    for(var prop in data)
     this[prop] = data[prop];
    this.teamSheet = this.players;
    this.friendlyMatchDate = moment(this.match_date);
    
    this.place = data.lieu == "activate" ? 'Domicile' : 'Exterieur';
  };

  Match.prototype.addPlayer = function (player){
    this.teamSheet.push(player);
  }

  Match.prototype.removePlayer = function(removedPlayer){
      for(var i = 0; i < this.teamSheet.length; i++) {
          var player = this.teamSheet[i];

          if(player.ID == removedPlayer.ID){
              this.teamSheet.splice(i, 1);
          }
      }
  }

  return Match;
}

