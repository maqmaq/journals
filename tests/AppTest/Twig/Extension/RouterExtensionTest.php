<?php

namespace AppTest\Twig\Extension;

use App\Twig\Extension\RouterExtension;
use Core\Router\UriResolverInterface;
use Twig_Function;

/**
 * Class RouterExtensionTest
 * @package AppTest\Twig\Extension
 */
class RouterExtensionTest extends \PHPUnit\Framework\TestCase
{

    public function testGetFunctionsReturnsArryWithUriResolverExtension() {

        $uriResolverInterface = $this->prophesize(UriResolverInterface::class);

        $routerExtension = new RouterExtension($uriResolverInterface->reveal());
        $functions = $routerExtension->getFunctions();

        $expectedName = 'generateUrlForRoute';
        $expectedCallable = [
            $uriResolverInterface,
            'findURI'
        ];

        /** @var Twig_Function $function */
        $function = reset($functions);

        $this->assertSame($expectedName, $function->getName());

        // @todo any idea for assertion below?
        $this->assertTrue(is_array ($function->getCallable()));
    }
}