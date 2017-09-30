<?php

namespace Core;

use Core\Exception\ObjectNotFoundException;
use Core\Router\RouterInterface;
use Psr\Container\ContainerInterface;
use QuimCalpe\Router\Dispatcher\DispatcherInterface;
use QuimCalpe\Router\Exception\MethodNotAllowedException;
use QuimCalpe\Router\Exception\RouteNotFoundException;
use RuntimeException;
use Maghead\Runtime\Config\FileConfigLoader;
use Maghead\Runtime\Bootstrap;

/**
 * Class Application
 * @package Core
 */
class Application
{
    /**
     * @var array
     */
    protected $config;
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var DispatcherInterface
     */
    protected $dispatcher;

    /**
     * Application constructor.
     * @param array $config
     * @param ContainerInterface $containerInterface
     */
    public function __construct(array $config, ContainerInterface $containerInterface)
    {
        $this->config = $config;
        $this->container = $containerInterface;
    }

    /**
     * Initializes app
     */
    public function init()
    {
        $this->initEnvironment();
        $this->initRouter();
        $this->initDispatcher();
        $this->initDatabase();
    }

    /**
     * Initialized env
     */
    protected function initEnvironment()
    {
        ini_set('display_errors', $this->config['env'] !== ENV_PROD);
        ini_set('error_reporting', E_ALL);
    }

    /**
     * Initializes router and load routes
     */
    protected function initRouter()
    {
        $this->router = $this->container->get('core_router');
        $this->router->loadRoutes($this->config['routes']);
    }

    /**
     * Initializes dispatcher
     */
    protected function initDispatcher()
    {
        $this->dispatcher = $this->container->get('core_dispatcher');
    }

    /**
     * Initializes database
     */
    protected function initDatabase()
    {

        $config = FileConfigLoader::load($this->config['db']['config']['file']);
        Bootstrap::setup($config);  // true -> prepare connection only
    }


    /**
     * Runs applictation
     */
    public function run()
    {
        try {
            // Match routes
            $route = $this->router->parse($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
            // Dispatch route
            $response = $this->dispatcher->handle($route);

        } catch (MethodNotAllowedException $e) {
            header('HTTP/1.0 405 Method Not Allowed');
            // exception message contains allowed methods
            header('Allow: ' . $e->getMessage());
            exit;

        } catch (RouteNotFoundException|ObjectNotFoundException $e) {
            header('HTTP/1.0 404 Not Found');
            // not found....
            exit;

        } catch (RuntimeException|\Exception $e) {
            header('HTTP/1.0 500 Internal Server Error');
            // internal server error
            exit;
        }

        // if everything is fine just print response
        echo $response;
    }


}