<?php
/*-----------------------------------------------------------------------*/
// Home/Front page.
/*-----------------------------------------------------------------------*/
$home = (int)get_option('page_on_front');

if (themosis_is_post($home))
{
    //params spécifiques pour la home
}

 /*-----------------------------------------------------------------------*/
 // Remove editor from home page.
 /*-----------------------------------------------------------------------*/
 add_action('init', function() use($home)
 {
     if (themosis_is_post($home))
     {
         remove_post_type_support('page', 'editor');
     }
 });
