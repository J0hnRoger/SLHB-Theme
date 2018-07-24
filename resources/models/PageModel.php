<?php
namespace Theme\Models;

class PageModel {


    /**
     * Return a list of all published pages.
     *
     * @return array
     */
    public static function all()
    {
        $query = new \WP_Query(array(
            'post_type'         => 'page',
            'posts_per_page'    => -1,
            'post_status'       => 'publish'
        ));
        return $query->get_posts();
    }

    public static function getCurrentPage()

    {

      $page = get_queried_object();

      #add custom properties

      $page->author = get_the_author_meta( "user_nicename", $page->post_author );

      $page->comments = get_comments(

        array(

          'post_id' => $page->ID

        )

      );

      return $page;

    }

}

