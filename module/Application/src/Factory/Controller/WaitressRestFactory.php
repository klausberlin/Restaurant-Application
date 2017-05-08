<?php
/**
 * User: Alice in wonderland
 * Date: 05.04.2017
 * Time: 16:15
 */

namespace Application\Factory\Controller;


use Application\Controller\WaitressRestController;
use Application\Model\DataInterface;
use Application\Model\DataModel;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class WaitressRestFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {
        $sm = $sm->get(DataInterface::class);

        return new WaitressRestController($sm);
    }
}