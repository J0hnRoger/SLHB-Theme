<?php

namespace Theme\Controllers;
use Theme\Models\UserModel;
use Theme\Models\TeamModel;

class TeamController extends BaseController
{
    public function index()
    {
        return  \View::make('teams.archive')->with(array(
          'teams' =>  TeamModel::all(),
          'home_banner' =>  themosis_assets() . "/images/_Equipes_Header01.jpg"
        ));
    }

    function getSingle(){

      $team =  TeamModel::getCurrent();
      $nextMatch = MatchModel::getFullNextMatchForTeam($team->post_title);

      if (isset($nextMatch->match_date))
        $nextMatch->formatedDate = "Le ".formatedDate($nextMatch->match_date);

      if (isset($nextMatch->match_real_time)
          && !empty($nextMatch->match_real_time))
        $nextMatch->formatedDate .=  " à " . $nextMatch->match_real_time;

      $options = array(
        'team' => $team,
        'coaches' => UserModel::getCoachsByTeam($team->post_title),
        'next_match' => $nextMatch
        );

      if (isset($team->banner))
        $options["home_banner"] = $team->banner;
      else
        $options["home_banner"] =  themosis_assets() . "/images/_Equipes_Header01.jpg";

      return \View::make('teams.single')->with($options);
    }
}



?>

