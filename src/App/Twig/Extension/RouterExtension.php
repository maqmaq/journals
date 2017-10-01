<?php

namespace App\Twig\Extension;

use Core\Router\UriResolverInterface;
use Twig_Extension;
use Twig_Function;

/**
 * Class RouterExtension
 * @package App\Twig\Extension
 */
class RouterExtension extends Twig_Extension
{
    /**
     * @var UriResolverInterface
     */
    protected $uriResolver;

    /**
     * RouterExtension constructor.
     * @param UriResolverInterface $uriResolver
     */
    public function __construct(UriResolverInterface $uriResolver)
    {
        $this->uriResolver = $uriResolver;
    }

    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return array(
            new Twig_Function('generateUrlForRoute', [$this->uriResolver, 'findURI']),
        );
    }

}