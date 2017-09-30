<?php


namespace User\Controller;


use Core\Controller\ControllerAbstract;

class UserController extends ControllerAbstract
{
    /** List action
     * @return string
     */
    public function listAction()
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