<?php

namespace User\Controller;

use Core\Authentication\AuthenticatorInterface;
use Core\Authentication\AuthentizationService;
use Core\Controller\ControllerAbstract;

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
    public function loginAction()
    {
        /** @var AuthenticatorInterface $authenticator */
        $authenticator = $this->getContainer()->get('core_authentication_service');
        if ($authenticator->hasIdentity()) {
//             @todo redirect
//            $this->redirectToRoute('homepage');
        }

        // @todo
        // create form
        // check if form has been sent
        // validate
        // if valid then call authentication servie
        // if not valid then show errors


    }
}