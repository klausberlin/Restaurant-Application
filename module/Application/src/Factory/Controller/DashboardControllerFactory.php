<?php
/**
 * Created by PhpStorm.
 * User: Pawel_000
 * Date: 31.03.2017
 * Time: 21:50
 */

namespace Application\Factory\Controller;


use Application\Controller\DashboardController;
use Application\Model\DataModel;
use Application\Model\UserModel;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class DashboardControllerFactory implements FactoryInterface
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
        $AuthService = $serviceManager->get(UserModel::class);
        $dataModel = $serviceManager->get(DataModel::class);

        return new DashboardController($AuthService,$dataModel);
    }
}