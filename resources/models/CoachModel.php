<?php

class CoachModel {

  public $user;
  public $trainedTeams = [];
  public $trainedTeamsNames;

  function __construct($coachId) {
    $this->user = get_user_by( 'id', $coachId );
    if (!UserModel::hasTheRole($this->user->ID, 'slhb_coach'))
      throw new Exception("The user is not a coach");

    $this->trainedTeamsNames = get_user_meta($this->user->ID, 'slhb_trained_teams');
      for ($i=0; $i < count($this->trainedTeamsNames); $i++) {
        $this->trainedTeams[] = TeamModel::getTeam($this->trainedTeamsNames[0][$i])[0];
      }
    }
}
