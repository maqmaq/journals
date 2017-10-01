<?php


namespace User\Controller;


use Core\Controller\ControllerAbstract;
use User\Interactor\User\GetList;

/**
 * Class UserController
 * @package User\Controller
 */
class UserController extends ControllerAbstract
{
    /** List action
     * @return string
     */
    public function listAction(): string
    {
        /** @var GetList $getListInteractor */
        $getListInteractor = $this->getContainer()->get('user_interactor_get_list');
        $users = $getListInteractor->execute();

        $context = [
            'users' => $users
        ];

        return $this->render('User/list.html.twig', $context);
    }

}