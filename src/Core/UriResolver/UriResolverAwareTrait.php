<?php

namespace Core\UriResolver;

/**
 * Class UriResolverAwareTrait
 * @package Core\UriResolver
 */
trait UriResolverAwareTrait
{

    /**
     * @var \Core\Router\UriResolverInterface
     */
    protected $uriResolver;

    /**
     * @return \Core\Router\UriResolverInterface
     */
    public function getUriResolver(): \Core\Router\UriResolverInterface
    {
        return $this->uriResolver;
    }

    /**
     * @param \Core\Router\UriResolverInterface $uriResolver
     */
    public function setUriResolver(\Core\Router\UriResolverInterface $uriResolver): void
    {
        $this->uriResolver = $uriResolver;
    }


}