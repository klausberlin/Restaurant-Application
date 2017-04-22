<?php

namespace Application\Factory\Adapter;




use Interop\Container\ContainerInterface;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as AuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * The factory responsible for creating of authentication service.
 */
class AuthenticationServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {
        //get the db
        $dbAdapter = $sm->get('dbcon');

        //set new Authentication adapter
        $authAdapter = new AuthAdapter(
                $dbAdapter,
                'users',
                'name',
                'password'
        );

        //create the service and inject dependencies into its constructor
        return new AuthenticationService(null, $authAdapter);
    }
}