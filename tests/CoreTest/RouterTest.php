<?php

namespace CoreTest;

use Core\Router;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * Class RouterTest
 * @package CoreTest
 */
class RouterTest extends TestCase
{
    /**
     * @param $inputRoutes
     * @dataProvider loadRouterRunsForAddRouteForEveryPassedRouteProvider
     */
    public function testLoadRouterRunsForAddRouteForEveryPassedRoute($inputRoutes, $expectedCalls)
    {

        // idk how to mock this one using phpspec prophesy
        // see https://github.com/phpspec/prophecy/issues/332

        $routerMock = $this->getMockBuilder(\Core\Router::class)
            ->setMethods(['addRoute'])
            ->getMock();

        $routerMock->expects($this->exactly($expectedCalls))
            ->method('addRoute');

        $routerMock->loadRoutes($inputRoutes);
    }

    /**
     * @return array
     */
    public function loadRouterRunsForAddRouteForEveryPassedRouteProvider()
    {
        return [
            [
                [

                    [
                        'GET',
                        '/',
                        'App\Controller\HomepageController::indexAction',
                        'homepage'
                    ],
                    // articles
                    [
                        'GET',
                        '/articles/list',
                        'Article\Controller\ArticleController::listAction',
                        'article_list'
                    ]
                ],
                2
            ]
        ];
    }

}