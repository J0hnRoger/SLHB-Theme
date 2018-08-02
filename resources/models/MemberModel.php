<?php

namespace Theme\Models;

class MemberModel {
  public $user;
  public $roles;

    function __construct($userId) {
        $this->user = get_user_by( 'id', $userId );
        $this->roles = get_user_meta($this->user->ID, 'slhb-responsibility');
    }
}

