<?php

namespace App\Model;


use Nette\Database\Context;
use Tracy\Debugger;

class VillageRepository implements VillageRepositoryInterface {

    private $database;

//    private $userAdminRepository;

    function __construct (Context $database)
    {
        $this->database = $database;
//        $this->userAdminRepository = $userAdminRepository;
    }

    public function getAllItems ()
    {
        return $this->database->table('village');
    }

}