<?php

namespace App\Model;


class UserAdminItem {
    private $id;
    private $user_id;
    private $created_at;

    /**
     * @return mixed
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUserId ()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt ()
    {
        return $this->created_at;
    }


}