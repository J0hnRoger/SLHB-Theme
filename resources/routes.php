<?php
/*
 * Define your routes and which views to display
 * depending of the query.
 *
 * Based on WordPress conditional tags from the WordPress Codex
 * http://codex.wordpress.org/Conditional_Tags
 *
 */

use Theme\Models\NavigationModel;
use Theme\Models\UserModel;
use Theme\Models\PageModel;

//  /*Layouts Data - Header */

 View::share(array(

   'logoUrl' =>     themosis_assets().'/images/slhb-logo.png',

   'logoMinUrl' =>     themosis_assets().'/images/white_logo.png',

   'logoFb' =>     themosis_assets().'/images/logo-fb.png',

   'logoGMap' =>     themosis_assets().'/images/logo-gmap.png',

   'footerImage' => themosis_assets(). '/images/image-footer-2015.png',

   'defaultAvatar' => themosis_assets(). '/images/slhb-default-avatar.png',

   'currentUser' => UserModel::getCurrentUser(),

   'headerMenu' =>  NavigationModel::getMenuItems("header-nav"),

   'home_banner' =>  themosis_assets() . "/images/banner.jpg"

 ));


 /*Page d'accueil */

 Route::any('front', 'HomeController@index');


 /* Page Toutes les équipes */
 Route::get('postTypeArchive', ['slhb_team', 'uses' => 'TeamController@index']);


 /* Page de détails d'une équipes */
 Route::get('singular', ['slhb_team', 'uses' => 'TeamController@getSingle']);


/*Page de détails d'une actualité */
Route::get('singular', array('post', 'uses' => 'HomeController@getSingleActualite'));


/* Page Calendrier */
Route::get('template', array('calendar-template', 'uses' => 'AgendaController@index'));

/* Page Infos pratiques */
Route::get('template', array('infos-pratiques-template', 'uses' => 'InfosPratiquesController@index'));


/* Page Team Builder */
Route::get('template', array('team-sheet-builder-template', 'uses' => 'TeamSheetBuilderController@index'));

/* Page Boutique */

Route::get('page', ['boutique-officielle', function()
{

  return View::make('page')->with(array(
    'page' =>  PageModel::getCurrentPage(),
    'home_banner' =>  themosis_assets() . "/images/_Boutique_Header01.jpg"
  ));

}]);


/* Page Historique */

Route::get('page', ['historique', function()

{

  return View::make('page')->with(array(

    'page' =>  PageModel::getCurrentPage(),

    'home_banner' =>  themosis_assets() . "/images/_Historique_Header01.jpg"

  ));

}]);



/* Page Contact */

Route::get('page', ['contact', function()

{

  return View::make('page')->with(array(

    'page' =>  PageModel::getCurrentPage(),

    'home_banner' =>  themosis_assets() . "/images/_Contact_Header01.jpg"

  ));

}]);



/* Page Profil  */

Route::get('template', array('profile-template', 'uses' => 'ProfileController@index'));

/*Page par défaut*/

Route::get('page', function (){

  return View::make('page')->with(array(

    'page' =>  PageModel::getCurrentPage()

  ));

});



Route::post('page', function (){

  return View::make('page')->with(array(

    'page' =>  PageModel::getCurrentPage()

  ));

});

/* Page 404 */

Route::any('404', function()
{

    return 'Perdu?';

});

