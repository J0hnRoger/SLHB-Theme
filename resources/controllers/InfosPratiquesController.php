<?php

class InfosPratiquesController extends BaseController
{
    public function index()
    {
      $page_id = get_queried_object_id();
        return View::make('infos-pratiques.infos-content')->with(array(
            'direction_members' => UserModel::getDirectionMembers(),
            'infos_after_trombi' => Meta::get($page_id, 'slhb_after_trombi'),
            'home_banner' =>  themosis_assets() . "/images/_InfosPra_Header01.jpg"
        ));
    }
}

?>
