<?php

namespace ContainerBoy3wSH;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getApiPlatform_SwaggerUi_ProcessorService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'api_platform.swagger_ui.processor' shared service.
     *
     * @return \ApiPlatform\Symfony\Bundle\SwaggerUi\SwaggerUiProcessor
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/State/ProcessorInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/OpenApi/Serializer/NormalizeOperationNameTrait.php';
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/core/src/Symfony/Bundle/SwaggerUi/SwaggerUiProcessor.php';

        $a = ($container->privates['twig'] ?? self::getTwigService($container));

        if (isset($container->privates['api_platform.swagger_ui.processor'])) {
            return $container->privates['api_platform.swagger_ui.processor'];
        }
        $b = ($container->services['router'] ?? self::getRouterService($container));

        if (isset($container->privates['api_platform.swagger_ui.processor'])) {
            return $container->privates['api_platform.swagger_ui.processor'];
        }

        return $container->privates['api_platform.swagger_ui.processor'] = new \ApiPlatform\Symfony\Bundle\SwaggerUi\SwaggerUiProcessor($a, $b, ($container->privates['debug.serializer'] ?? self::getDebug_SerializerService($container)), ($container->privates['api_platform.openapi.options'] ?? $container->load('getApiPlatform_Openapi_OptionsService')), ($container->privates['api_platform.swagger_ui.context'] ?? $container->load('getApiPlatform_SwaggerUi_ContextService')), $container->parameters['api_platform.docs_formats'], '', '', false);
    }
}
