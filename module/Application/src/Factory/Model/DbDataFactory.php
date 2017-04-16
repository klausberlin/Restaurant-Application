<?php
/**
 * User: Alice in wonderland
 * Date: 31.03.2017
 * Time: 23:03
 */

namespace Application\Factory\Model;


use Application\Model\UserModel;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class DbDataFactory implements FactoryInterface
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
    public function __invoke(ContainerInterface $serviceManager, $requestedName, array $options = null)
    {
        $dbAdapter = $serviceManager->get('dbcon');
        return new UserModel($dbAdapter);
    }
}