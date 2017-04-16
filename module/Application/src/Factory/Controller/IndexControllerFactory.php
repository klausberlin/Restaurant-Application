<?php
/**
 * Created by PhpStorm.
 * User: Pawel_000
 * Date: 17.03.2017
 * Time: 10:32
 */


namespace Application\Factory\Controller;


use Application\Controller\IndexController;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;

class IndexControllerFactory implements FactoryInterface {

    /**
     * Create an object
     *
     * @param  ContainerInterface $sm
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     */
    public function __invoke(ContainerInterface $serviceManager, $requestedName, array $options = null)
    {
        /** var authentication service */
        $authServiceFactory = $serviceManager->get('authentication');
        return new IndexController($authServiceFactory);

    }
}