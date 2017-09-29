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
     * @param RenderableInterface $renderer
     */
    public function setRenderable(RenderableInterface $renderable)
    {
        $this->renderable = $renderable;
    }
}