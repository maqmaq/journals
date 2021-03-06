<?php

namespace Core\Renderable;

use Core\RenderableInterface;

/**
 * Class RenderableAwareTrait
 * @package Core\Renderer
 */
trait RenderableAwareTrait
{
    /**
     * @var RenderableInterface
     */
    protected $renderable;

    /**
     * @param RenderableInterface $renderable
     */
    public function setRenderable(RenderableInterface $renderable): void
    {
        $this->renderable = $renderable;
    }
}