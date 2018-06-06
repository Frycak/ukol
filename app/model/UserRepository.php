<?php

namespace App\Model;


use Nette\Database\Context;

class UserRepository implements UserRepositoryInterface {

    private $database;

    function __construct (Context $database)
    {
        $this->database = $database;
    }

    public function getAllItems ()
    {
        return $this->database->table('user');
    }

    public function save (UserItem $item)
    {
        $this->database->table('user')->insert($item);
    }
}