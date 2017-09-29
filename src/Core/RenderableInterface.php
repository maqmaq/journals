<?php

namespace Core;

/**
 * Interface RenderableInterface
 * @package Core
 */
interface RenderableInterface
{
    /**
     * Renders a template.
     *
     * @param string $name    The template name
     * @param array  $context An array of parameters to pass to the template
     *
     * @return string The rendered template
     *
     */
    public function render($name, array $context = array());

}