<?php

use Theme\Models\TeamModel;
use Theme\Models\UserModel;
/*

  Add SLHB Custom fields on profil page

*/

$user = User::addSections([

    Section::make('slhb-section', 'SLHB'),

]);



$user->addFields([

    'slhb-section'  => [

        Field::checkbox('slhb_role', [ 'slhb_player' => 'Joueur', 'slhb_direction' => 'Bureau', 'slhb_referee' => 'Arbitre', 'slhb_coach' => 'Coach'], ['title' => 'Rôle dans le club :']),

        Field::text('slhb-phone', ['title' => 'Téléphone : '], ['class' => 'regular-text'])

    ]

]);



$userId = isset($_REQUEST["user_id"]) ? $_REQUEST["user_id"] : "";



if(empty($userId))

  $userId = User::current()->ID;



if ($userId != "")

{

  $teams = TeamModel::getTeams();

  // Display Player Fields only if the user is in the direction

  if (UserModel::hasTheRole($userId, 'slhb_coach'))

  {

      User::addFields([

      Field::checkbox('slhb_trained_teams',

        $teams,

        ['title' => 'Equipes entrainée:'])

      ]);

  }



  if (UserModel::hasTheRole($userId, 'slhb_player'))

  {

      User::addFields([

        Field::checkbox('slhb_teams',

          $teams,

          ['title' => 'Equipes :']),

        Field::checkbox('slhb_positions',

            [

              'Arrière Gauche' => 'Arrière Gauche',

              'Arrière Droit' => 'Arrière Droit',

              'Aillier Gauche' => 'Aillier Gauche',

              'Aillier Droit' => 'Aillier Droit',

              'Pivot' => 'Pivot',

              'Demi-Centre' => 'Demi-Centre',

              'Gardien' => 'Gardien'

            ],

          ['title' => 'Postes joués :']),

      ]);

  }



  // Display Responsibility Field only if the user is in the direction

  if(UserModel::hasTheRole($userId, 'slhb_direction'))

  {

    User::addFields([

          Field::select('slhb-responsibility', [

            [

                'Président' => 'Président',

                'Vice-Président' => 'Vice-Président',

                'Secrétaire' => 'Secrétaire',

                'Secrétaire Adjoint' => 'Secrétaire Adjoint',

                'Trésorier' => 'Trésorier',

                'Trésorier Adjoint' => 'Trésorier Adjoint',

                'Correspondant loisirs' => 'Correspondant loisirs',

                'Correspondant arbitrage' => 'Correspondant arbitrage',

                'Correspondant technique' => 'Correspondant technique',

                'Responsable bar' => 'Responsable bar',

                'Responsable jeunes' => 'Responsable jeunes',

                'Planning bar et arbitrage' => 'Planning bar et arbitrage',

                'Responsable animation' => 'Responsable animation',

                'Responsable matériel' => 'Responsable matériel',

                'Membre' => 'Membre',

            ]

        ], ['title' => 'Responsabilité dans le club :'])

    ]);

  }

}



User::addFields([

  Field::checkbox('is_present', 'true')

]);

