<?php
use Theme\Models\TeamModel;
/*-----------------------------------------------------------------------*/
// Match Custom Post
/*-----------------------------------------------------------------------*/

$match = \PostType::make('slhb_match', 'Les matchs', 'match')->set(array(
    'public'        => true,
    'menu_position' => 20,
    'supports'      => false,
    'rewrite'       => false,
    'query_var'     => false,
    'show_in_rest'  => true,
    'labels' => [
        'add_new' => 'Ajouter un nouveau match',
        'add_item' => 'Ajouter un match',
        'all_items' => 'Tous les matchs',
        'edit_item' => 'Modifier un match'
      ],
      'has_archive' => true,
      'menu_icon' => 'dashicons-calendar-alt'
));

/*-----------------------------------------------------------------------*/

// Match informations

/*-----------------------------------------------------------------------*/

$propertiesRendezvous = [
            'features'  => ['title' => 'Heure du rendez-vous'],
            'attrs'      => array_merge(['class' => 'large-text'], ['class' => 'simple-text'], ['data-field' => 'text'], ['primaryColor' => '#1d3d86']),
            'name'      => 'match_team_time',
            'internal'  => 'match_team_time'
        ];

$propertiesMatchTime = [
            'features'  => ['title' => 'Heure du match'],
            'attrs'      => array_merge(['class' => 'large-text'], ['class' => 'simple-text'], ['data-field' => 'text']),
            'name'      => 'match_real_time',
            'internal'  => 'match_real_time'
        ];

$infos = Metabox::make('Informations du match', $match->get('name'))->set(array(
    Field::date('match_date', ['title' => 'Date du match']),
    Field::make('Addons\Fields\TimeField', $propertiesRendezvous),
    Field::make('Addons\Fields\TimeField', $propertiesMatchTime),
    Field::select('match_team_dom', TeamModel::getTeamsArray(), ['title' => 'Equipe Chavagnaise']),
    Field::text('match_team_ext', ['title' => 'Equipe à l\'exterieur'], ['class' => 'simple-text']),
    Field::number('score_dom', ['title' => 'Score de l\'équipe à domicile']),
    Field::number('score_ext', ['title' => 'Score de l\'équipe extérieur']),
    Field::checkbox('Lieu', ['activate' => 'Match à domicile'])
));

/*-----------------------------------------------------------------------*/
// Match Defaults Values
/*-----------------------------------------------------------------------*/

function slhb_set_title ( $post_id, $post , $update){

  if (isset($_POST['match_date'])
        && isset($_POST['match_team_dom'])
          && isset($_POST['match_team_ext'])){

    $title =  $_POST['match_date'];
    if (isset($_POST['Lieu'])) {
       $title .= ' - '. $_POST['match_team_dom'] . ' - '. $_POST['match_team_ext'];
    } else {
      $title .= ' - '. $_POST['match_team_ext'] . ' - '. $_POST['match_team_dom'];
    }

    $date = date($_POST['match_date']);

    //This temporarily removes filter to prevent infinite loops
    remove_action('save_post_slhb_match', __FUNCTION__ );

    wp_update_post( array('ID' => $post_id, 'post_title' => $title, 'match_date' => $date) );
    //TODO - CHeck if exist, update, if not, add
    //redo filter
    add_action('save_post_slhb_match', __FUNCTION__, 10, 3 );
  }
}

add_action( 'save_post_slhb_match', 'slhb_set_title', 10, 3 );

// Display only on CT Match
add_action( 'admin_head', 'is_ct_match_edit_page' );

function is_ct_match_edit_page()
{
    global $current_screen;
    global $post;

    // $players = get_post_meta($post->ID);
    // td($players);

    if( 'slhb_match' != $current_screen->post_type || $current_screen->action == 'add')
        return;
    add_action( 'post_submitbox_start', 'my_post_submitbox_misc_actions' );
}



function my_post_submitbox_misc_actions(){

  global $post;

  $id = $post->ID;
  $nonce = wp_create_nonce( 'wp_rest' );

  $actionUrl = "/team-builder?nonce=".$nonce."&match_id=".$id;
?>
  <div id="create-team-sheet-action" style="margin:10px 0; text-align:right">
		<a style="-webkit-appearance: button;-moz-appearance: button;appearance: button;text-decoration: none;" href="<?php echo $actionUrl;  ?>" name="createTeamSheet" id="createTeamSheet" class="button button-primary button-large">Créer / Editer la feuille de match</a> </div>
<?php

}

