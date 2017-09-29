<?php

namespace App\Controller;

use Core\Controller\ControllerAbstract;

/**
 * Class HomepageController
 */
class HomepageController extends ControllerAbstract
{
    public function indexAction()
    {

        $context = [
            'first' => 'f',
            'second' => 's'
        ];
        return $this->render('Homepage/index.html.twig', $context);

    }

}