<?php

namespace App\Presenters;

use App\Exceptions\RoleException;
use App\Exceptions\UserException;
use App\Exceptions\VillageException;
use App\Model\RoleRepository;
use App\Model\UserAdminRepository;
use App\Model\UserAdminVillageRoleRepository;
use App\Model\UserItem;
use App\Model\UserRepository;
use App\Model\VillageRepository;
use Nette;
use Nette\Application\UI\Form;
use Tracy\Debugger;


class HomepagePresenter extends Nette\Application\UI\Presenter
{
    /** @var UserAdminVillageRoleRepository @inject */
    public $userAdminVillageRoleRepository;

    /** @var VillageRepository @inject */
    public $villageRepository;

    /** @var  UserRepository @inject */
    public $userRepository;

    /** @var RoleRepository @inject */
    public $roleRepository;

    /** @var UserAdminRepository @inject */
    public $userAdminRepository;

    public function renderDefault(){
//        try {
            $this->template->users = $this->userRepository->getAllItems();
            $this->template->villages = $this->villageRepository->getAllItems();
            $this->template->roles = $this->roleRepository->getAllItems();
            $this->template->userAdminVillageRole = $this->userAdminVillageRoleRepository->getAllItems();
            $this->template->userAdmin = $this->userAdminRepository->getAllItems();

            $this->userAdminVillageRoleRepository->get(5,2);
    }

    public function createComponentClick ()
    {
        $form = new form();

        $form->addSubmit('send', 'Magic CLICK');

        $form->onSuccess[] = [$this, 'clickSucceeded'];

        return $form;
    }

    public function clickSucceeded ($form, $values)
    {
        $values = [[], []];

        //simulace pridani osoby do user_admina a nastaveni prav
//        $this->userAdminRepository->save(["user_id" => '6']);
//        $this->userAdminVillageRoleRepository->set(5, [ 1 => [ 1 => true, 2 => true ] , 2 => [ 1 => true, 2 => true ] ]);

        $values =  [ 1 => [ 1 => true, 2 => true ] , 2 => [ 1 => true, 2 => true ] ];

        $this->userAdminVillageRoleRepository->set(6, $values);
    }
}
