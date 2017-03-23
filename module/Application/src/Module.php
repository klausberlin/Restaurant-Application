<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Factory\AuthenticationServiceFactory;
use Zend\Authentication\AuthenticationService;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements ConfigProviderInterface
{
    const VERSION = '3.0.2dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig() {

        return [
            'factories' => [
                'authentication' => AuthenticationServiceFactory::class,
            ],
        ];
    }
//    public function onBootstrap(EventInterface $e) {
//        /** @var MvcEvent $e */
//        $application = $e->getApplication();
//        $application->getEventManager()->attach(MvcEvent::EVENT_DISPATCH, function(MvcEvent $e) use ($application) {
//            /** @var AuthenticationService $authService */
//            $authService = $application->getServiceManager()->get('authentication');
//            $hasIdentity = $authService->hasIdentity();
//            $identity = $authService->getIdentity();
//            return;
//        }, 100);
//        return;
//    }

}
