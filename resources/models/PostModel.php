<?php
namespace Theme\Models;

class PostModel {



    /**

     * Return a list of all published posts.

     *

     * @return array

     */

    public static function all()

    {

        $query = new \WP_Query(array(

            'post_type'         => 'post',

            'posts_per_page'    => -1,

            'post_status'       => 'publish'

        ));



        return $query->get_posts();

    }



    public static function getLastPosts($limit)

    {



        $query = new \WP_Query(array(

            'post_type'         => 'post',

            'posts_per_page'    => $limit,

            'post_status'       => 'publish',

            'order'             => 'DESC',

            'meta_key'          => 'eventDate',

            'orderby'           => 'meta_value'

        ));

        $posts = $query->get_posts();



        foreach ($posts as $key => $post) {

          $postId = $post->ID;

          $post->eventDate = Meta::get($postId, 'eventDate');

          $post->isEvent = Meta::get($postId, 'isEvent');

          $post->post_excerpt =  wp_trim_words($post->post_content, 25);

        }

        return $posts;

    }



    public static function getEventPosts($limit)

    {

        $query = new \WP_Query(array(

            'post_type'         => 'post',

            'posts_per_page'    => $limit,

            'post_status'       => 'publish',

            'meta_key'          => 'isEvent',

            'meta_value'        => 0

        ));



        $events =  $query->get_posts();

        foreach ($events as $key => $event) {

          $eventId = $event->ID;

          $event->eventDate = Meta::get($eventId, 'eventDate');

          $event->isEvent = Meta::get($eventId, 'isEvent');

        }

        return $events;

    }



    public static function getCurrent()

    {

      $post = get_queried_object();

      $post->formated_modified_date = get_the_date('j F Y', $post->ID);



      $excerpt = strip_tags($post->post_content);

      $excerpt = str_replace("", "'", $excerpt);

      $post->post_excerpt = $excerpt;



      if (has_post_thumbnail( $post->ID )) {

        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

        $post->featuredImg = $image;

      }

      return $post;

    }



    public static function getPostImagesUrl($postId){

      $imageUrls = [];

      $imageIds = Meta::get($postId, 'post_gallery');

      if (empty($imageIds))

        return $imageUrls;



      foreach ($imageIds as $imageId) {

        array_push($imageUrls, wp_get_attachment_url($imageId));

      }



      return $imageUrls;

    }



}

