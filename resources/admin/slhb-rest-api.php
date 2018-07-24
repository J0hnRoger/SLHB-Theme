<?php
/*-----------------------------------------------------------------------*/
// SLHB REST API
// Endpoint : http://<siteUrl>/wp-json/slhb/v1/<methodName>
/*-----------------------------------------------------------------------*/

/**
 * POST REST API
 */
 function my_rest_prepare_post( $data, $post, $request ) {
 	$_data = $data->data;
 	$_data['event_date'] = Meta::get($post->ID, 'eventDate');
    $_data['end_time'] = Meta::get($post->ID, 'eventStartTime');
    $_data['start_time'] = Meta::get($post->ID, 'eventEndTime');

    $_data['featured_image'] = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

    $_data['post_gallery'] = PostModel::getPostImagesUrl($post->ID);

 	$data->data = $_data;
 	return $data;
 }

add_filter( 'rest_prepare_post', 'my_rest_prepare_post', 10, 3 );

// Expose all users(not only the users that have published a post) in wp Rest api v2
add_filter( 'rest_user_query' , 'custom_rest_user_query' );
function custom_rest_user_query( $prepared_args, $request = null ) {
  unset($prepared_args['has_published_posts']);
  return $prepared_args;
}


/*-----------------------------------------------------------------------*/
// Players REST API
/*-----------------------------------------------------------------------*/
add_action( 'rest_api_init', function () {
    register_rest_route( 'slhb/v1', '/get-players-by-team', array(
        'methods' => 'GET',
        'callback' => 'get_players_by_team',
    ) );
});

// Return all players by team
function get_players_by_team(WP_REST_Request $request) {
  $teamName = $request->get_param( 'team_name' );
  $players = UserModel::getPlayersByTeam($teamName);
  return $players;
}

/*-----------------------------------------------------------------------*/
// Teams REST API
/*-----------------------------------------------------------------------*/
add_action( 'rest_api_init', function () {
    register_rest_route( 'slhb/v1', '/get-teams-by-coach', array(
        'methods' => 'GET',
        'callback' => 'get_teams_by_coach_id',
    ) );
} );

// Return all players by team
function get_teams_by_coach_id(WP_REST_Request $request) {
  $coachId = $request->get_param( 'coach_id' );

  $coach = new CoachModel($coachId);

  return $coach->trainedTeams;
}

/*-----------------------------------------------------------------------*/
// Match REST API
/*-----------------------------------------------------------------------*/
add_action( 'rest_api_init', function () {
    register_rest_route( 'slhb/v1', '/get-next-match-for-team', array(
        'methods' => 'GET',
        'callback' => 'get_next_match_for_team',
    ) );
} );

function get_next_match_for_team(WP_REST_Request $request) {
  $teamName = $request->get_param( 'team_name' );

  if ($teamName == null)
    throw new Exception("GET parameter 'team_name' is not defined");

  $nextMatch = MatchModel::getFullNextMatchForTeam($teamName);

  return $nextMatch;
}

add_action( 'rest_api_init', 'dt_register_team_hook' );
function dt_register_team_hook() {
    register_rest_field(
        'slhb_match',
        'slhb_match_meta',
        array(
            'get_callback'    => function ( $object, $field_name, $request ) {
                $pascal = $object["id"];
                $allMetas = Meta::get($pascal);

                $allMetas = sanitizeCTMetas($allMetas);
                //Special keys for players
                unset($allMetas['slhb_players']);

                if( isset($allMetas['match_date']) )
                  $allMetas['match_date'] = formatedDate($allMetas['match_date'][0]);
                return $allMetas;
            },
        )
    );
}

// Update only the slhb_players and slhb_coach metadata
// @match_id - The ID of the match team sheet
// @slhb_players - an array of player's IDs
// @slhb_coachs - an array of coach's IDs
add_action( 'rest_api_init', 'dt_register_updateTeamPlayer_hooks' );
function dt_register_updateTeamPlayer_hooks() {
    register_rest_route( 'slhb/v1', '/save_match', array(
        'methods' => 'POST',
        'callback' => 'save_match',
    ));
}
function save_match() {
    $jsonData = json_decode(file_get_contents('php://input'), true);
    $return = array();

    if (!isset($jsonData['match_id']) || !(isset($jsonData['slhb_players'])))
      return new WP_Error( 'cant-update', __( 'Il n\'y a pas de propriete match_id ou slhb_player dans les datas', 'text-domain'), array( 'status' => 500 ) );

    $match_id    = $jsonData['match_id'];
    $slhb_players    = $jsonData['slhb_players'];
    $slhb_coach    = $jsonData['slhb_coachs'];

    update_post_meta($match_id, 'slhb_players', $slhb_players);
    update_post_meta($match_id, 'slhb_coachs', $slhb_coach);

    $return[] = 'match players list updated: '.$match_id;

    $response = new WP_REST_Response( $return , 200);
    return $response;
}

add_action( 'rest_api_init', 'set_presential' );
function set_presential() {
    register_rest_route( 'slhb/v1', '/set-presential', array(
        'methods' => 'POST',
        'callback' => 'set_presential_for_current_user',
    ) );
}

function set_presential_for_current_user() {
    $jsonData = json_decode(file_get_contents('php://input'), true);
    $return = array();

    if (!isset($jsonData['present']) && !isset($jsonData['userId']))
      return new WP_Error( 'cant-update', __( 'Il n\'y a pas de propriete present dans les datas', 'text-domain'), array( 'status' => 500 ) );

    $is_present   = $jsonData['present'];
    $userId =  $jsonData['userId'];

    $user = User::get($userId);
    if (empty($is_present))
      $is_present = 0;
    update_user_meta( $user->ID, 'is_present', $is_present );
    $return[] = 'User updated: '.$user->ID;

    $response = new WP_REST_Response( $return , 200);
    return $response;
}


add_action( 'rest_api_init', 'get_presential' );
function get_presential() {
    register_rest_route( 'slhb/v1', '/get-presential', array(
        'methods' => 'GET',
        'callback' => 'get_presential_for_current_user',
    ) );
}

function get_presential_for_current_user(WP_REST_Request $request) {
    $userId = $request->get_param( 'userId' );
    $teams = get_user_meta($userId, 'slhb_teams')[0];
    
    $colleagues = [];
    foreach ($teams as $key => $team) {
        $colleagues = array_merge($colleagues, UserModel::getPlayersByTeam($team));
    }
    $colleagues = array_unique($colleagues, SORT_REGULAR);
    $participants = 0;
    foreach ($colleagues as $key => $player) {
        if($player->is_present)
            $participants++;
    }
    return $participants;
}

/**
 * Ajoute le champ slhb_players au CT slhb_match
 */
add_action( 'rest_api_init', 'dt_register_players_hook' );
function dt_register_players_hook() {
    register_rest_field(
        'slhb_match',
        'slhb_players',
        array(
            'get_callback'    => function ( $object, $field_name, $request ) {
                $players = Meta::get($object["id"], 'slhb_players');
                return $players;
            },
        )
    );
}

// Generic sanitize JSON method
function sanitizeCTMetas($metas){
  $excludeKeys = ['_edit_lock', '_edit_last'];
  $sanitizeMetas = [];

  foreach ($metas as $key => $value) {
    if (in_array($key, $excludeKeys)){
      unset($metas[$key]);
    }
  }

  return $metas;
}
