<?php

namespace CoreTest\Router;

use Core\Router\UriResolver;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * Class UriResolverTest
 * @package CoreTest\Router
 */
class UriResolverTest extends TestCase
{

    public function testFindURIReturnsRouterFindURI() {

        $name = 'name';
        $parameters = [];
        $expected = 'test';

        $uriResolver = $this->prophesize(UriResolver::class);
        $uriResolver->findURI(Argument::exact($name), Argument::exact($parameters))->shouldBeCalledTimes(1)->willReturn($expected);

        $userTokenStorage = new UriResolver($uriResolver->reveal());
        $actual = $userTokenStorage->findURI($name,
            $parameters);
        $this->assertSame($expected, $actual);

    }
}