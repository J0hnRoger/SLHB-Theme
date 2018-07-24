<?php

namespace Theme\Controllers;

use Theme\Models\UserModel;
use Theme\Models\MatchModel;
use Theme\Models\PostModel;

class AgendaController extends BaseController
{
    public function index()
    {
        // admin/application.php or inside any controllers or route closure.
        add_filter('themosisGlobalObject', function($data)
        {
            // Add your data.
            $data['baseurl'] = get_template_directory_uri();
            return $data;
        });

        return \View::make('agenda.agenda-content')->with(array(
          'home_banner' =>  themosis_assets() . "/images/_Agenda_Header01.jpg"
        ));
    }
}

?>

