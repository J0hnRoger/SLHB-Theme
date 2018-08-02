<?php

namespace Theme\Models;

class NavigationModel {

    /**
     * Return a list of menu items.
     *
     * @return array
     */
    public static function all()
    {
        $query = new \WP_Query(array(
            'post_type'         => 'nav_menu_item'
        ));
        return $query->get_posts();
    }

    /**
     * Return the global menu with a material design HTML structure
     */
	public static function getMenuItems($menuName){

        if (($locations = get_nav_menu_locations()) && isset( $locations[$menuName]))
        {
            $menu = wp_get_nav_menu_object( $locations[$menuName]);
            return wp_get_nav_menu_items($menu->term_id);
        }
    }
}

