<?php

namespace App\Model;


use Nette\Database\Context;
use Tracy\Debugger;

class UserAdminRepository implements UserAdminRepositoryInterface{

    private $database;
    private $adminVillageRole;

    function __construct (Context $database, UserAdminVillageRoleRepository $adminVillageRole)
    {
        $this->database = $database;
        $this->adminVillageRole = $adminVillageRole;
    }

//    pridani uzivatele do user_admin
    public function save ($item)
    {
        $user = $this->database->table('user_admin')->insert($item);
    }

    public function getAllItems()
    {
        return $this->database->table('user_admin');
    }

}