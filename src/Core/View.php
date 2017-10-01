<?php

namespace Core;

use Twig_Environment;

/**
 * Class View
 * @package Core
 */
class View implements RenderableInterface
{

    /**
     * @var Twig_Environment
     */
    protected $renderer;

    /**
     * View constructor.
     * @param Twig_Environment $renderer
     */
    public function __construct(Twig_Environment $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Renders a template.
     *
     * @param string $name The template name
     * @param array $context An array of parameters to pass to the template
     *
     * @return string The rendered template
     *
     */
    public function render($name, array $context = array()): string
    {
        return $this->renderer->render($name, $context);
    }
}