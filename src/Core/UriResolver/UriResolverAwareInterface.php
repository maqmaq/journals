<?php

namespace Core\UriResolver;

/**
 * Interface UriResolverAwareInterface
 * @package Core\UriResolver
 */
interface UriResolverAwareInterface
{
    /**
     * @return \Core\Router\UriResolverInterface
     */
    public function getUriResolver(): \Core\Router\UriResolverInterface;

    /**
     * @param \Core\Router\UriResolverInterface $uriResolver
     */
    public function setUriResolver(\Core\Router\UriResolverInterface $uriResolver): void;
}