<?php

namespace App\Controller;

use Core\Controller\ControllerAbstract;

/**
 * Class HomepageController
 */
class HomepageController extends ControllerAbstract
{
    /**
     * Index action
     * @return string
     */
    public function indexAction()
    {
        return $this->render('Homepage/index.html.twig', []);
    }

}