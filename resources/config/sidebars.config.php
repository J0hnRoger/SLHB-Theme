<?php

return [

    /**
     * Edit this file to add widget sidebars to your theme.
     * Place WordPress default settings for sidebars.
     * Add as many as you want, watch-out your commas!
     */
    array(
		'name'			=> "Team Widget Zone",
		'id'			=> 'team-widgets',
		'description'	=> "Zone de Widget en dessous de la description d'équipe",
		'before_widget'	=> '<div class="team-widget-zone">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2>',
		'after_title'	=> '</h2>'
	),
	array(
		'name'			=> "Footer Widget Zone",
		'id'			=> 'footer-widgets',
		'description'	=> "Zone de Widget du footer",
		'before_widget'	=> '<div class=\"footer-widget-zone\">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2>',
		'after_title'	=> '</h2>')
];
