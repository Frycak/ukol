<?php

namespace App\Model;


interface UserAdminRepositoryInterface {
    public function save($item);

    public function getAllItems ();
}