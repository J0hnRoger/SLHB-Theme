<?php

class TeamSheetBuilderController extends BaseController
{
    public function index()
    {
      if (!UserModel::hasTheRole(User::current()->ID, 'slhb_coach'))
        return "<h1> Access Denied - Vous n'êtes pas notre coach! </h1>";

      return  View::make('coach.team-sheet-builder')->with(array(
        ));
    }
}

?>
