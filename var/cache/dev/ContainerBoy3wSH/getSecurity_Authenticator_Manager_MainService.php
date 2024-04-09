<?php

namespace ContainerBoy3wSH;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getSecurity_Authenticator_Manager_MainService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'security.authenticator.manager.main' shared service.
     *
     * @return \Symfony\Component\Security\Http\Authentication\AuthenticatorManager
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-http/Authentication/AuthenticatorManagerInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-http/Authentication/UserAuthenticatorInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-http/Authentication/AuthenticatorManager.php';

        $a = ($container->privates['App\\Security\\LoginAuthenticator'] ?? $container->load('getLoginAuthenticatorService'));

        if (isset($container->privates['security.authenticator.manager.main'])) {
            return $container->privates['security.authenticator.manager.main'];
        }
        $b = ($container->privates['security.authenticator.jwt.main'] ?? $container->load('getSecurity_Authenticator_Jwt_MainService'));

        if (isset($container->privates['security.authenticator.manager.main'])) {
            return $container->privates['security.authenticator.manager.main'];
        }
        $c = ($container->privates['security.authenticator.form_login.main'] ?? $container->load('getSecurity_Authenticator_FormLogin_MainService'));

        if (isset($container->privates['security.authenticator.manager.main'])) {
            return $container->privates['security.authenticator.manager.main'];
        }
        $d = ($container->privates['security.authenticator.json_login.main'] ?? $container->load('getSecurity_Authenticator_JsonLogin_MainService'));

        if (isset($container->privates['security.authenticator.manager.main'])) {
            return $container->privates['security.authenticator.manager.main'];
        }
        $e = ($container->privates['debug.security.event_dispatcher.main'] ?? self::getDebug_Security_EventDispatcher_MainService($container));

        if (isset($container->privates['security.authenticator.manager.main'])) {
            return $container->privates['security.authenticator.manager.main'];
        }

        return $container->privates['security.authenticator.manager.main'] = new \Symfony\Component\Security\Http\Authentication\AuthenticatorManager([$a, $b, $c, $d, ($container->privates['security.authenticator.remember_me.main'] ?? $container->load('getSecurity_Authenticator_RememberMe_MainService'))], ($container->privates['security.token_storage'] ?? self::getSecurity_TokenStorageService($container)), $e, 'main', ($container->privates['monolog.logger.security'] ?? self::getMonolog_Logger_SecurityService($container)), true, true, []);
    }
}
