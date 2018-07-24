<?php
namespace Theme\Models;

class MatchModel {

    /**
     * Return a list of all matchs.
     *
     * @return array
     */
    public static function all()
    {
        $query = new \WP_Query(array(
            'post_type'         => 'slhb_match',
            'posts_per_page'    => -1,
            'post_status'       => 'publish'
        ));

        return $query->get_posts();
    }

    /**
     * Return only the matchs wich are played, ordered by the most recent match_date
     * to the older.
     *
     * @return array
     */
    public static function getLastResults($limit)
    {
        $query = new \WP_Query(array(
            'post_type'       => 'slhb_match',
            'posts_per_page'  => $limit,
            'post_status'     => 'publish',
            'meta_query'   => array
  					(
  						array
  						(
  							'key'     => 'match_date',
  							'value'   => date("Y-m-d"),
  							'type'    => 'DATE', // TRIED: DATE, SIGNED, NUMBER
  							'compare' => '<'
  						)
  					),
            'orderby'         => 'match_date',
            'order'           => 'DESC'
        ));

        $matchs = $query->get_posts();

        return $matchs;
    }

    /**
     * Return only the last match played, with additional informations (teams and scores included)
     *
     * @return Match Object
     */
    public static function getLastResult()
    {
        $match = null;
        $matchs = MatchModel::getLastResults(1);

        if (count($matchs) == 1) {
          $match = $matchs[0];
          $matchId = $match->ID;

          $match->match_date = Meta::get($matchId, 'match_date');
          $match->match_team_dom = Meta::get($matchId, 'match_team_dom');
          $match->match_team_ext = Meta::get($matchId, 'match_team_ext');
          $match->score_dom = Meta::get($matchId, 'score_dom');
          $match->score_ext = Meta::get($matchId, 'score_ext');
        }

        return $match;

    }



    /**

     * Return the next matchs wich are not playing yet

     *

     * @return Match Object

     */

    public static function getNextMatchs($limit)

    {

        $query = new \WP_Query(array(

            'post_type'       => 'slhb_match',

            'posts_per_page'  => $limit,

            'post_status'     => 'publish',

            'meta_query'   => array

  					(

  						array

  						(

  							'key'     => 'match_date',

  							'value'   => date("Y-m-d"),

  							'type'    => 'DATE', // TRIED: DATE, SIGNED, NUMBER

  							'compare' => '>'

  						)

  					),

            'orderby'         => 'match_date',

            'order'           => 'ASC'

        ));

        $matchs = $query->get_posts();



        $filledMatchs = [];

        foreach ($matchs as $key => $match) {



          $matchId = $match->ID;

          $match->match_date = Meta::get($matchId, 'match_date');



          $match->match_date = "Le ".formatedDate($match->match_date);



          $match->match_team_dom = Meta::get($matchId, 'match_team_dom');

          $match->match_team_ext = Meta::get($matchId, 'match_team_ext');

          array_push($filledMatchs, $match);

        }

        return $matchs;

    }



    /**

     * Return only the next match

     *

     * @return Match Object

     */

    public static function getNextMatch()

    {

        $matchs = MatchModel::getNextMatchs(1);

        if (count($matchs) == 1) {

          $match = $matchs[0];

          $matchId = $match->ID;



          $match->match_date = Meta::get($matchId, 'match_date');

          $match->match_team_dom = Meta::get($matchId, 'match_team_dom');

          $match->match_team_ext = Meta::get($matchId, 'match_team_ext');

          return $match;

        }

    }



    /**

     * Return only the next match with the list of players on the Team Sheet

     *

     * @return Match Object

     */

    public static function getFullNextMatch()

    {

        $matchs = MatchModel::getNextMatchs(1);



        if (count($matchs) == 1) {

          $match = $matchs[0];

          $matchId = $match->ID;



          $match->match_date = Meta::get($matchId, 'match_date');

          $match->match_team_dom = Meta::get($matchId, 'match_team_dom');

          $match->match_team_ext = Meta::get($matchId, 'match_team_ext');



          $match->match_team_time = Meta::get($matchId, 'match_team_time');

          $match->match_real_time = Meta::get($matchId, 'match_real_time');

          $match->players = [];



          //TODO - Modify this hack and correct the problem at this root (save/get in team builder)

          $players = get_post_meta($matchId, 'slhb_players');



          if (count($players) > 0)

          {

            foreach($players[0] as $key => $player)

            {

              $match->players[] = $player['data'];

            }

          }

          return $match;

        }

    }



    public static function getFullNextMatchForTeam($teamName)

    {

        $query = new \WP_Query(array(

            'post_type'       => 'slhb_match',

            'posts_per_page'  => 1,

            'post_status'     => 'publish',

            'meta_query'   => array

            (

            'relation' => 'AND',

            array(

              'key'       => 'match_team_dom',

              'value'     => $teamName,

              'compare'   => '=',

            ),

              array

              (

                'key'     => 'match_date',

                'value'   => date("Y-m-d", strtotime("-1 day")),

                'type'    => 'DATE', // TRIED: DATE, SIGNED, NUMBER

                'compare' => '>'

              )

            ),

            'orderby'         => 'match_date',

            'order'           => 'ASC'

        ));



        $matchs = $query->get_posts();

        if (count($matchs) == 1) {



          $match = $matchs[0];

          $matchId = $match->ID;



          $match->match_date = Meta::get($matchId, 'match_date');

          $match->match_team_dom = Meta::get($matchId, 'match_team_dom');

          $match->match_team_ext = Meta::get($matchId, 'match_team_ext');

          $match->players = [];

          $match->lieu = Meta::get($matchId, 'Lieu');

          $match->match_team_time = Meta::get($matchId, 'match_team_time');

          $match->match_real_time = Meta::get($matchId, 'match_real_time');

          //TODO - Modify this hack and correct the problem at this root (save/get in team builder)

          $players = get_post_meta($matchId, 'slhb_players');



          if (count($players) > 0)

          {

            foreach($players[0] as $key => $player)

            {

              $match->players[] = $player;

            }

          }

          return $match;

        }

    }



    public static function containsPlayer ($team, $playerId)

    {

      for ($i=0; $i < count($team->players); $i++)

      {

        if ($team->players[$i]['ID'] == $playerId)

          return true;

      }

      return false;

    }



    //Todo - compare date instead of strings

    public static function CompareTwoString($a,  $b){

      return strcmp($a->match_date, $b->match_date);

    }



    public static function SortMatchsByDescendingDate($matchs)

    {

      usort($matchs, ["MatchModel", "CompareTwoString"]);

      return $matchs;

    }

}

