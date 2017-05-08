<?php
/**
 * User: Alice in wonderland
 * Date: 18.04.2017
 * Time: 21:34
 */

namespace Application\Factory\Model;


use Application\Model\DataModel;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class DataModelFactory implements FactoryInterface
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
        $dbAdapter = $sm->get('dbcon');
        return new DataModel($dbAdapter);
    }
}