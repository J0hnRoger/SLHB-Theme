<?php
namespace Theme\Controllers;

use Theme\Models\UserModel;
use Theme\Models\MatchModel;
use Theme\Models\MemberModel;

class ProfileController extends BaseController
{
    public function index()
    {
      $currentUser = UserModel::getCurrentUser();
      if (!$currentUser->exists())
        return "<h1> Access Denied - Merci de vous authentifier avant d'accéder à cette page </h1>";

      UserModel::LoadNextMatch($currentUser);
      // admin/application.php or inside any controllers or route closure.
      add_filter('themosisGlobalObject', function($data)
      {
          $user = \User::current();
          // Add your data.
          $data['userId'] = $user->ID;
          return $data;
      });

      if ($currentUser->isPlayer)
        return  \View::make('profile.player-profile')->with(array(
          'home_banner' =>  themosis_assets() . "/images/_Profil_Header01.jpg",

          'currentPlayer' => $currentUser

        ));

      else if ($currentUser->isCoach) {

        $currentCoach = new CoachModel($currentUser->ID);

        return  \View::make('profile.coach-profile')->with(array(
          'home_banner' =>  themosis_assets() . "/images/_Profil_Header01.jpg",
          'currentCoach' => $currentCoach,
          'playersPresents' => UserModel::getPlayersByPresential()
        ));
      }

      else {
        $currentMember = new MemberModel($currentUser->ID);
        return  \View::make('profile.member-profile')->with(array(
          'home_banner' =>  themosis_assets() . "/images/_Profil_Header01.jpg",
          'currentMember' => $currentMember
        ));
      }
    }
}
?>

