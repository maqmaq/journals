<?php

namespace User\Controller;

use Core\Authentication\AuthenticationStatus;
use Core\Authentication\AuthenticatorInterface;
use Core\Authentication\AuthenticationService;
use Core\Authentication\Manager\AuthenticationManagerInterface;
use Core\Controller\ControllerAbstract;
use Core\Exception\ObjectNotFoundException;
use User\Interactor\User\GetById;
use User\Model\User;

/**
 * Class AuthenticationController
 * @package User\Controller
 */
class AuthenticationController extends ControllerAbstract
{

    /**
     * Login action
     * @return string
     */
    public function loginAction(): string
    {
        /** @var AuthenticatorInterface $authenticator */
//        $authenticator = $this->getContainer()->get('core_authentication_service');
//        if ($authenticator->hasIdentity()) {
//            $this->redirectToRoute('homepage');
//        }

        // @todo
        // create form
        // check if form has been sent
        // validate
        // if valid then call authentication service
        // if not valid then show errors

        return $this->render('Authentication/login.html.twig');
    }

    /**
     * @param $params
     * @return string
     * @throws ObjectNotFoundException
     */
    public function simpleLoginAction($params): string
    {
        $userId = $params['id'];

        /** @var AuthenticatorInterface $authenticationService */
        $authenticationService = $this->getContainer()->get('core_authentication_service');
        if ($authenticationService->hasIdentity()) {
            $context = [
                'status' => AuthenticationStatus::STATUS_ALREADY_AUTHENTICATED
            ];
            return $this->render('Authentication/simple_login.html.twig', $context);
        }

        /** @var GetById $getByIdInteractor */
        $getByIdInteractor = $this->getContainer()->get('user_interactor_get_by_id');
        $user = $getByIdInteractor->execute($userId);

        if ($user === false) {
            throw new ObjectNotFoundException();
        }

        /** @var User $user */
        $context = [
            'user' => $user
        ];

        /** @var AuthenticationManagerInterface $authenticationManager */
        $authenticationManager = $this->getContainer()->get('core_authentication_manager');
        $authenticationStatus = $authenticationManager->logInUser($user);

        $context['status'] = ($authenticationStatus) ? AuthenticationStatus::STATUS_AUTHENTICATION_SUCCESSFUL : AuthenticationStatus::STATUS_AUTHENTICATION_FAILED;

        return $this->render('Authentication/simple_login.html.twig', $context);
    }
}