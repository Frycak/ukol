<?php


namespace App\Model;

use App\Exceptions\UserAdminVillageRoleException;
use Nette\Database\Context;
use Nette\InvalidArgumentException;
use Tracy\Debugger;
use Nette\Utils\Arrays;

class UserAdminVillageRoleRepository implements UserAdminVillageRoleRepositoryInterface {

    private $database;
    private $villageRepository;
    private $roleRepository;
    private $userRepository;

    function __construct (VillageRepository $villageRepository, RoleRepository $roleRepository,
                          UserRepository $userRepository, Context $database)
    {
        $this->villageRepository = $villageRepository;
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
        $this->database = $database;
    }

//       [ addressbook => [ 1 = > true, 2 => false ], search => [ 1 => false, 2 => false] ]
//       [ role_ID [ village_ID => valid, village_ID => valid], role_ID => [ village_ID => valid, village_ID => valid] ]
    public function set ($userId, $data)
    {
        $roleItems = $this->roleRepository->getAllItems(); // vsechny typy prav

        foreach ($roleItems as $roleItem) // addressbook & search + pripadne budouci nove prava
        {
            $flag = $this->checkFormDataRights($data, $roleItem); // zkontroluje, zda se ma uzivatelovi nastavit absolutni pravo

            if ($flag===false)
            { // nastavi vsechna prava
                foreach ($data[$roleItem->id] as $villageId => $valid) // Brno => false / true
                {
                    $updateItem = $this->database->table('user_admin_village_role')
                        ->get($this->getItemIdByForeignKeys($userId, $roleItem->id, $villageId));

                    if(!$updateItem) { // item v databazi jeste neni
                        $this->insertItem($userId, $roleItem->id, $villageId, 1);
                    } else {
                        $this->updateItem($updateItem, 1);
                    }
                }
            } else
            { // nastavi upravena prava
                foreach ($data[$roleItem->id] as $villageId => $valid) // Brno => false ( $villageId => $valid )
                {
                    $updateItem = $this->database->table('user_admin_village_role')
                        ->get($this->getItemIdByForeignKeys($userId, $roleItem->id, $villageId));

                    if(!$updateItem) { // item v databazi jeste neni
                        $this->insertItem($userId, $roleItem->id, $villageId, $valid);
                    } else {
                        $this->updateItem($updateItem, $valid);
                    }
                }
            }
        }
    }

    public function get ($userId, $roleId)
    {
        $villageItems = $this->villageRepository->getAllItems();

        $userAdminVillages = $this->database->table('user_admin_village_role')
            ->where('user_id = ? AND role_id = ? AND village_id IN ?', $userId, $roleId, $villageItems);

        return $userAdminVillages;
    }

    public function getAllItems ()
    {
        $items = $this->database->table('user_admin_village_role');

        return $items;
    }

    private function getItemIdByForeignKeys ($userId, $roleId, $villageId)
    {
        $item = null;
        try
        {
            $item = $this->database->table('user_admin_village_role')
                ->select('id')
                ->where('user_id = ? AND role_id = ? AND village_id = ?', $userId, $roleId, $villageId);
        } catch (UserAdminVillageRoleException $e)
        {
//                ERROR
        }

        return $item;
    }

    private function checkFormDataRights ($data, $roleItem)
    {
        $flag = false;

        foreach ($data[$roleItem->id] as $villageId => $valid)// zjisti, zda je cele pole Address/search nevyplnene
        {
            if ($valid)
            { // pokud nalezne nejakou hodnotu, ktera je true, tak je aspon 1 zaskrtnute
                $flag = true;
            }
        }

        return $flag;
    }

    private function updateItem ($item, $valid)
    {
        $item->update([
            'updated_at' => date("Y-m-d H:i:s"),
            'valid'      => $valid
        ]);
    }

    private function insertItem($userId, $roleId, $villageId, $valid) {
        $this->database->table('user_admin_village_role')->insert([
            'user_id' => $userId,
            'role_id' => $roleId,
            'village_id' => $villageId,
            'created_at' => date("Y-m-d H:i:s"),
            'valid' => $valid
        ]);

    }

}