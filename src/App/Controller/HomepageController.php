<?php

namespace  App\Controller;
use Core\Controller\ControllerAbstract;

/**
 * Class HomepageController
 */
class HomepageController extends ControllerAbstract
{
    public function indexAction() {
        return 'some response';
    }

}