<?php
/**
 * Created by PhpStorm.
 * User: Pawel_000
 * Date: 13.03.2017
 * Time: 15:53
 */

namespace Application\Factory;




use Interop\Container\ContainerInterface;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as AuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Session\SessionManager;
use Zend\Session\Storage\SessionStorage;

/**
 * The factory responsible for creating of authentication service.
 */

class AuthenticationServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {
        //get the db
        $dbAdapter = $sm->get(AdapterInterface::class);

        //set new Authentication adapter
        $authAdapter = new AuthAdapter(
                $dbAdapter,
                'users',
                'name',
                'password'
        );

//        $sessionManager = $sm->get(SessionManager::class);
//        $authStorage = new SessionStorage('Zend_Auth', 'session', $sessionManager);

        //create the service and inject dependencies into its constructor
        return new AuthenticationService(null, $authAdapter);
    }
}