<?php

namespace App\Model;


interface UserAdminVillageRoleRepositoryInterface {

    public function set ($userId, $data);

    public function get ($userId, $roleId);
}