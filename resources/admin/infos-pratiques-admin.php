<?php

$infosPratiques = get_page_by_path('infos-pratiques');

if (isset($infosPratiques) && themosis_is_post($infosPratiques->ID))
{
    /*-----------------------------------------------------------------------*/
    // TEAM METABOX
    /*-----------------------------------------------------------------------*/
    Metabox::make('Infos pratiques', 'page')->set(array(
      Field::editor('slhb_after_trombi', ['title' => 'Texte affiché en dessous du trombinoscope'])
    ));
}
