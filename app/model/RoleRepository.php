<?php


namespace App\Model;

use Nette\Database\Context;

class RoleRepository implements RoleRepositoryInterface {

    private $database;

    function __construct (Context $database)
    {
        $this->database = $database;
    }

    public function getAllItems ()
    {
        return $this->database->table('role');
    }



}