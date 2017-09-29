<?php

namespace Core\Renderable;

use Core\RenderableInterface;

/**
 * Interface RenderableAwareInterface
 * @package Core\Renderer
 */
interface RenderableAwareInterface
{
    /**
     * @param RenderableInterface $renderable
     * @return mixed
     */
    public function setRenderable(RenderableInterface $renderable);
}