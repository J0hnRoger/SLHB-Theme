<?php



/**

 * application.php - Write your custom code below.

 */



function formatedDate($date){

  setlocale (LC_TIME, 'fr_FR.utf8','fra');

  $date = DateTime::createFromFormat("Y-m-d", $date);

  return strftime("%A %d %B %Y", $date->getTimestamp());

}



/**

 * User Capabilities

 */



//Allow Contributors to Add Media

if ( current_user_can('contributor') && !current_user_can('upload_files') )

add_action('admin_init', 'upgrade_contributor_roles');



function upgrade_contributor_roles() {

   $contributor = get_role('contributor');

   $contributor->add_cap('upload_files');

   $contributor->add_cap( 'edit_published_posts' );

}



//Disable admin Bar for no contributors

if (!current_user_can('edit_posts')) {

	add_filter('show_admin_bar', '__return_false');

}



//TODO - Authentification/redirect class

//Redirect simple users on home

function only_admins_login_area( $redirect_to, $request, $user ) {

    //hack for redirect function

    $wpadminUrl =  $redirect_to . '/cms/wp-admin/';



    $autorizedRoles = ['administrator', 'contributor'];

    if (can_access_to_wpadmin($user)){

      return $wpadminUrl;

    }



    return home_url();

}



add_filter( 'login_redirect', 'only_admins_login_area', 10, 3 );



//... and hide wp-admin for those who can' access

function redirect_user_on_role()

{

    $current_user = User::current();

    if (!can_access_to_wpadmin($current_user)){

      wp_redirect( home_url() ); exit;

    }

}



function can_access_to_wpadmin($user){

  $redirect = false;

  $autorizedRoles = ['administrator', 'contributor'];

  //If login user role is Subscriber

  if ( isset( $user->roles ) && is_array( $user->roles ) )

  {

      foreach ($autorizedRoles as $role) {

        if(in_array($role, $user->roles))

            $redirect = true;

      }

  }

  return $redirect;

}



add_action('admin_init', 'redirect_user_on_role');

// remove unwanted dashboard widgets for relevant users

function remove_dashboard_widgets() {

    $user = wp_get_current_user();

    if ( ! $user->has_cap( 'manage_options' ) ) {

        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );

        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );

        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );

        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );

        remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );

        remove_meta_box( 'dashboard_right_now', 'dashboard', 'side' );

        remove_meta_box( 'dashboard_activity', 'dashboard', 'side' );



    }

}

add_action( 'admin_init', 'remove_dashboard_widgets' );

