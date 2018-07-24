<?php

$team = PostType::make('slhb_team', 'Les équipes', 'équipe')->set(array(

    'public'        => true,
    'menu_position' => 20,
    'supports'      => array('title', 'editor', 'revisions'),
    'rewrite'       => false,
    'query_var'     => false,
    'show_in_rest'  => true,
    'labels' => [
        'add_new_item' => 'Ajouter une nouvelle équipe',
        'add_new' => 'Ajouter une équipe',
        'add_item' => 'Ajouter une équipe',
        'all_items' => 'Toutes les équipes',
        'edit_item' => 'Modifier une équipe'
      ],
      'menu_icon' => 'dashicons-groups'
));

/*-----------------------------------------------------------------------*/
// Team informations
/*-----------------------------------------------------------------------*/
$infos = Metabox::make('Informations sur l\'équipe', $team->get('name'))->set(array(
  Field::media('profile', ['title' => 'Photo de groupe de l\'équipe ']),
  Field::select('Niveau', [
  [
      'Excellence Région',
      'Honneur Région',
      'Pré-Région',
      'Deuxième division',
      'Région',
      'Poule Haute Departementale',
      'Poule Basse Departementale',
      'Départementale',
      'Honneur départementale'
  ]
], ['title' => 'Quelle division?']),
  Field::collection('gallery')
));
