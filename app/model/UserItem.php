<?php

namespace App\Model;


class UserItem {
    private $id;
    private $name;
    private $created_at;
    private $updated_at;

    /**
     * @param mixed $name
     * @return UserItem
     */
    public function setName ($name)
    {
        $this->name = $name;

        return $this;
    }

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
    public function getName ()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt ()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt ()
    {
        return $this->updated_at;
    }


}