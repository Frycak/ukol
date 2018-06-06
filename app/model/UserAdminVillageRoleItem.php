<?php

namespace App\Model;


class UserAdminVillageRoleItem {
    private $id;
    private $userId;
    private $villageId;
    private $roleId;
    private $valid;

    /**
     * @return mixed
     */
    public function getValid ()
    {
        return $this->valid;
    }
    private $created_at;
    private $updated_at;

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
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getVillageId ()
    {
        return $this->villageId;
    }

    /**
     * @return mixed
     */
    public function getRoleId ()
    {
        return $this->roleId;
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